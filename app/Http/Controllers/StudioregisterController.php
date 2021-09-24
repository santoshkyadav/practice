<?php
namespace App\Http\Controllers;

use App\User;
use App\distributormodel;
use App\PaymentdetailModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;
use DB;


class StudioregisterController extends Controller
{
             /**
             * Create a new controller instance.
             *
             * @return void
             */
             public function __construct() {
        //$this->middleware('auth');
             }

            /**
             * Show the application dashboard.
             *
             * @return \Illuminate\Http\Response
             */

            public function index() {
               $users= distributormodel::all();
                return view('auth.studioregister',compact(['users']));
            }

            public function mobileChangepage() {
                return view('changeMobile');
            }
            public function backtoOtp() {
                $session = Session::all();
                return view('otp');
            }

            protected function create(Request $request)
            {


                $Validator =  Validator::make($request->all(), [
                    'studio_name'=> 'required',
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required|min:3|confirmed',
                    'mobile_no'=> 'required|numeric|digits:10|unique:studio',
                    'city'=>'required|alpha',
                    'state'=>'required|alpha',
                    'distributor'=>'required',
                    'software'=>'required',
                    'collectedby'=>'required',
                    
                    'amount'=>'required',
                ],
                [
                    'mobile_no.unique' => 'The mobile number is already exist. Please try with another number or go to Login page.'
                ]);
                if($Validator->fails()){
                    $failedRules = $Validator->getMessageBag();
                    return redirect()->back()->withInput()->withErrors($failedRules);
                    // return view('auth.studioregister')->with('errors', $failedRules);
                }
                else
                {
                    $StartingDate = date('Y-m-d H:m:s', strtotime('+1 years'));  // todays date as a timestamp
                    // print_r($StartingDate); die();
                    $otp = rand(1000, 9999);
                    session([
                        'otp'=> $otp,
                        'mobile'=> $request->mobile_no,
                        'studio_name'=> $request->studio_name
                    ]); 
                    
                    $user =  User::create([
                        'studio_name'=> $request->studio_name,
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => $request->password,
                        'mobile_no'=> $request->mobile_no,
                        'distributor'=> $request->distributer,
                        'address'=> $request->address,
                        'city'=> $request->city,
                        'state'=> $request->state,
                    ]);
                    
                    if($user){
                        $studio_data = User::where('mobile_no', $request->mobile_no)->get();
                        $payment = new PaymentdetailModel;
                            $payment->Studio_id = $studio_data[0]->id;
                            $payment->SubscriptionTenure = 'trial period';
                            $payment->ExpiryDate = $StartingDate;
                            $payment->PaymentMethord = 3;
                            $payment->AmountPaid = $request->amount;
                            
                            $payment->StudioMobileNumber = $request->mobile_no;
                            $payment->CollectionPlace = $request->distributer;
                            $payment->AmountPaidFor = $request->software;
                            
                           echo  $payment->CollectedBy = $request->collectedby;
                            $payment->Remark = $request->remark;
                            //$payment->save();
                        
                        $this->sendSMS($request,$otp);

                        return redirect('otp')->with('status', 'Your One Time Passcode has been sent to ');
                    }
                    
                }
                

            }

            public function sendSMS($request, $otp){
                $isError = 0;
                $errorMessage = true;
                if(!empty($request)){

                    $name = $request->name;
                    $mobile_number = $request->mobile_no;
                    
                    $message= "Dear User your OTP for verification of PAMS account is " .$otp.".";
                //Preparing post parameters
                    $postData = array(
                        'user' => 'elation', 
                        'password' => '8853997700',
                        'msisdn' => $mobile_number,
                        'sid' => 'EFBOOK',
                        'msg' => $message,
                        'fl' => 0,
                        'gwid' => 2
                    );

                    $url = "http://smsstore.elationsoft.net/vendorsms/pushsms.aspx";

                    $ch = curl_init();
                    curl_setopt_array($ch, array(
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POST => true,
                        CURLOPT_POSTFIELDS => $postData
                    ));


                //Ignore SSL certificate verification
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


                //get response
                    $output = curl_exec($ch);

                //Print error if any
                    if (curl_errno($ch)) {
                        $isError = true;
                        $errorMessage = curl_error($ch);
                    }
                    curl_close($ch);
                    if($isError){
                        return array('error' => 1 , 'message' => $errorMessage);
                    }else{
                     return $output;
                 }
             }
         }

         public function verifyOtp(Request $request){
            $Validator = Validator::make($request->all(), [
                'otp'=> 'required']);
            if($Validator->fails()){
                $failedRules = $Validator->getMessageBag();
                    // $message = $failedRules['otp'][0];
                    // print_r($failedRules['otp']); die;
                return view('otp')->with('errors', $failedRules);
            }else{

                $otp = $request->otp;
                $session = Session::all();
                $otp_check = $session['otp'];
                if($otp == $otp_check){
                    $mobile = $session['mobile'];
                    $res =  User::where('mobile_no', '=', $mobile)->update(['status' => '1']); 
                    return view('auth.studioLogin');
                }else{

                    $isError = 0;
                    $errorMessage = true;
                    $otp = rand(1000, 9999);
                    $mobile_number = $session['mobile'];                    
                    $message= "Dear User your OTP for verification of PAMS account is " .$otp.".";
                    $postData = array(
                        'user' => 'elation', 
                        'password' => '8853997700',
                        'msisdn' => $mobile_number,
                        'sid' => 'EFBOOK',
                        'msg' => $message,
                        'fl' => 0,
                        'gwid' => 2
                    );

                    $url = "http://smsstore.elationsoft.net/vendorsms/pushsms.aspx";

                    $ch = curl_init();
                    curl_setopt_array($ch, array(
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POST => true,
                        CURLOPT_POSTFIELDS => $postData
                    ));


                //Ignore SSL certificate verification
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


                //get response
                    $output = curl_exec($ch);

                //Print error if any
                    if (curl_errno($ch)) {
                        $isError = true;
                        $errorMessage = curl_error($ch);
                    }
                    curl_close($ch);
                    if($isError){
                        return array('error' => 1 , 'message' => $errorMessage);
                    }else{
                        Session::put('otp',  $otp);
                 return redirect('otp')->with('error', 'Your OTP is incorrect. Plese renter the new OTP.');
             } 
             } 
         }
     }

     public function resendOtp(){
        $session = Session::all();
        $isError = 0;
        $errorMessage = true;
        $otp = $session['otp'];
        $mobile_number = $session['mobile'];
                    // print_r($otp); die;

        $message= "Dear User your OTP for verification of PAMS account is " .$otp.".";
                //Preparing post parameters
        $postData = array(
            'user' => 'elation', 
            'password' => '8853997700',
            'msisdn' => $mobile_number,
            'sid' => 'EFBOOK',
            'msg' => $message,
            'fl' => 0,
            'gwid' => 2
        );

        $url = "http://smsstore.elationsoft.net/vendorsms/pushsms.aspx";

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));


                //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


                //get response
        $output = curl_exec($ch);

                //Print error if any
        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
        curl_close($ch);
        if($isError){
            return array('error' => 1 , 'message' => $errorMessage);
        }else{
         return $output;
     }

 }

 public function changeMobile(Request $request){
   $session = Session::all();
   $mobile = $session['mobile'];
   $Validator = Validator::make($request->all(),['new_mobile'=> 'required']);

   if($Validator->fails()){
    $failedRules= $Validator->getMessageBag()->toArray();
    $errormsg = $failedRules['new_mobile']['0'];
    return (json_encode(array('status'=> 'error', 'message'=>$errormsg)));
}else{
    $new_mobile= $request->new_mobile;

    $mobile_exist = User::select('mobile_no')->where('mobile_no', '=', $new_mobile)->first();

    if(!empty($mobile_exist)){
        return (json_encode(array('status' => 'error', 'message'=> 'Mobile number is alredy exist. Please try with another number or go to login page')));
    }else{

        $res =  User::where('mobile_no', '=', $mobile)->update(['mobile_no' => $new_mobile ]);
        if($res){
            Session::put('mobile',  $new_mobile);
            return (json_encode(array('status' => 'success', 'message'=> 'Mobile number is Updated. Click on resend OTP to get the OTP', 'result' => $res)));
        }

    }

}
}

}
