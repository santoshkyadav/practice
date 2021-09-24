<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Response;
use Illuminate\Database\QueryException;
use DB;
use App\User;
use App\PaymentdetailModel;

class UserController extends Controller {

    public function __construct() {
        //$this->middleware('guest');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                        'studio_name' => 'required',
                        'name' => 'required',
                        'email' => 'required|email',
                        'password' => 'required|min:6|confirmed',
                        'mobile_no' => 'required|numeric|digits:10|unique:users',
                        'city' => 'required|alpha',
                        'state' => 'required|alpha',
            ]);
            if ($validator->fails()) {
                $errorMsg = $validator->getMessageBag()->toArray();
                return Response::json(array('status' => 'error', 'message' => $errorMsg))->withHeaders([
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                ]);
            } else {
                $user_data = User::create([
                            'studio_name' => $request->studio_name,
                            'name' => $request->name,
                            'email' => $request->email,
                            'password' => $request->bcrypt(password),
                            'mobile_no' => $request->mobile_no,
                            'alternate_mobile' => $request->Alt_mobile_no,
                            'user_type' => '2',
                            'city' => $request->city,
                            'state' => $request->state,
                ]);

                return Response::json(array('status' => 'success', 'message' => 'You are successfully registerd'))->withHeaders([
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                ]);
            }
        } catch (QueryException $ex) {
            return Response::json(array('status' => 'error', 'message' => $ex->getMessage()))->withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
            ]);
        }
    }

    public function login(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                        'mobile_no' => 'required|numeric',
                        'password' => 'required',
            ]);
            if ($validator->fails()) {
                $errorMsg = $validator->getMessageBag()->toArray();
                return Response::json(array('status' => 'error', 'message' => $errorMsg))->withHeaders([
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                ]);
            } else {
                if (Auth::attempt(['mobile_no' => request('mobile_no'), 'password' => request('password')])) {
                    $user = Auth::user();
                    return Response::json(['status' => 'success', 'message' => 'Logged Successfully', 'data' => $user])->withHeaders([
                                'Content-Type' => 'application/json',
                                'Accept' => 'application/json',
                    ]);
                } else {
                    return Response::json(['error' => 'Unauthorized', 'message' => 'Please check credentials'], 401)->withHeaders([
                                'Content-Type' => 'application/json',
                                'Accept' => 'application/json',
                    ]);
                }
            }
        } catch (QueryException $ex) {
            return Response::json(array('status' => 'error', 'message' => $ex->getMessage()))->withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
            ]);
        }
           
    }

    public function save_login(Request $request) {

        $mobile_no = 1234567890;
        $password = 'zxcvbnm';
        $user = DB::table('login_save_data')->insert(
                ['mobile_no' => $mobile_no, 'password' => $password]
        );

        return Response::json(['status' => 'success', 'message' => 'Logged Successfully', 'data' => $user])->withHeaders([
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
        ]);
        
    }

    public function Payment(Request $request){
        try{
             $Validator = Validator::make($request->all(),[
            'amountpaid'=> 'required|string',
            'mobile_no' => 'required|numeric|digits:10'
        ]);
        if($Validator->fails()){
            $errorMsg = $Validator->getMessageBag()->toArray();
            return Response::json(array('status' => 'error', 'message' => $errorMsg))->withHeaders([
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                ]);
        } else{
           // $session = Session::all();
           //  return print_r($session); die();
            $studio =User::where('mobile_no', $request->mobile_no)->get()->toArray();
            if(!empty($studio)){
                 $paymentTable = new PaymentdetailModel;
                   $paymentTable->SubscriptionTenure = $request->payment_tenure;
                   $paymentTable->PaymentMethord = $request->paymentmethod;
                   $paymentTable->AmountPaid = $request->amountpaid;
                   $paymentTable->Studio_id = $studio[0]['id'];
                   $paymentTable->StudioMobileNumber = $request->mobile_no;

                    $paymentTable->save();
                    if ($paymentTable) {
                        return Response::json(['status' => 'success', 'message' => 'Logged Successfully', 'data' => $paymentTable])->withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ]);
                    }else{
                        return Response::json(array('status'=> 'error', 'message' => 'Payment is not saved.'))->withHeader([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
                    }
            }else{
                 return Response::json(array('status'=> 'error', 'message' => 'mobile number is not valid.'))->withHeader([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);

            }
              
            }
              

        }catch(QueryException $ex){
            return Response::json(array('status'=> 'error', 'message' => $ex->getMessage()))->withHeader([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
        }
    }

    public function studioVerify(Request $request){
        try{
            $Validator = Validator::make($request->all(),[
                'mobile_no' => 'required|numeric|digits:10'
            ]);

            if($Validator->fails()){
                $errorMsg = $Validator->getMessageBag()->toArray();
            return Response::json(array('status' => 'error', 'message' => $errorMsg))->withHeaders([
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                ]);
        }else{
            $studio = User::where('mobile_no', $request->mobile_no)->get()->toArray();
            if(!empty($studio)){
                    $isError = 0;
                    $errorMessage = true;
                    $otp =rand(1000, 9999);
                    // $user = User::where('id', $data['studio_id'])->get();
                    // print_r($studio[0]->mobile_no); die;
                    $mobile_number = $studio[0]['mobile_no'];
                                     // $mobile_number = 8052222355;
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
                        return Response::json(['status' => 'success', 'message' => 'User data', 'data' => $studio, 'otp' => $otp])->withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ]);
                     // return $output;
                    }
                
            }else{
                 return Response::json(array('status'=> 'error', 'message' => 'User not Exist.'))->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
            }
        }
        }catch(QueryException $ex){
            return Response::json(array('status'=> 'error', 'message' => $ex->getMessage()))->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
        }

    }

    public function StudioComputerDetails(Request $request){
        try{
            $Validator = Validator::make($request->all(),[
                'mobile_no' => 'required|numeric|digits:10',
                'hdd_sno' => 'required',
                'mac_no' => 'required',
                'model_no' => 'required'
                ]);

            if($Validator->fails()){
                $errorMsg = $Validator->getMessageBag()->toArray();
            return Response::json(array('status' => 'error', 'message' => $errorMsg))->withHeaders([
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                ]);
            }else{
            $studio = User::where('mobile_no', $request->mobile_no)->get()->toArray();
            if(!empty($studio)){
                $update_system = User::where('mobile_no', $request->mobile_no)->update([
                    'Hdd_sno' => $request->hdd_sno,
                    'MAC_no' => $request->mac_no,
                    'model_no' => $request->model_no,
                ]);
                if($update_system){
                   return Response::json(['status' => 'success', 'message' => 'System details Updated.'])->withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ]); 
                }else{
                    return Response::json(array('status'=> 'error', 'message' => 'User Computer details not Updated.'))->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
                }
                 
            }else{
                // return print_r($studio); die;
                 return Response::json(array('status'=> 'error', 'message' => 'User not Exist.'))->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
            }
        }
        }catch(QueryException $ex){
            return Response::json(array('status'=> 'error', 'message' => $ex->getMessage()))->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
        }

    }
    
    public function save_userUrl(Request $request) {

       try{
            $Validator = Validator::make($request->all(),[
                'username' => 'required',
                ]);

            if($Validator->fails()){
                $errorMsg = $Validator->getMessageBag()->toArray();
            return Response::json(array('status' => 'error', 'message' => $errorMsg))->withHeaders([
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                ]);
            }else{
            $studio = DB::table('user_url')->where('name', $request->username)->get()->toArray();
            if(!empty($studio)){
                
                   return Response::json(['status' => 'success', 'message' => 'System details Updated.', 'data' => $studio])->withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ]); 
                
                 
            }else{
                // return print_r($studio); die;
                 return Response::json(array('status'=> 'error', 'message' => 'User not Exist.'))->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
            }
        }
        }catch(QueryException $ex){
            return Response::json(array('status'=> 'error', 'message' => $ex->getMessage()))->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
        }
        
    }
    

}
