<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;
use Hash;
class StudioLoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */


      protected function index(){
      	return view('auth.studioLogin');

      }
      protected function loginStudio(Request $request){
      	$Validator = Validator::make($request->all(),[
      		'mobile_no'=> 'required|numeric|digits:10',
      		'password'=> 'required|string']);

      	if($Validator->fails()){
      		$failedRules = $Validator->getMessageBag();
      		return redirect()->back()->withErrors($failedRules);
      	}else{
      		$user = User::where('mobile_no', '=', $request->mobile_no)
      		->get()
      		->toArray();

      		if(!empty($user)){
      			if($request->password === $user[0]['password']){
                              
      				$verified = $user[0]['status'];
      				$studio = $user[0]['studio_name'];
      				$studio_id = $user[0]['id'];
      				$studio_mob = $user[0]['mobile_no'];
      				if($verified == 1 || $verified == 2 || $verified == 5){

      					session(['studio_name'=> $studio,
      						'studio_id'=> $studio_id,
      						'mobile'=> $studio_mob]);
                 return $this->expireStudio($studio_id);
      					// return view('userDashboard');
      				}elseif($verified == 3){
                return redirect('studio_Login')->with('error', 'Studio is Expired!');
              }elseif($verified == 4){
                return redirect('studio_Login')->with('error', 'Studio is Blocked!');             }else {
      					$otp = rand(1000, 9999);
      					session(['mobile'=> $studio_mob, 
      						'otp'=> $otp]);
      					return redirect('studio_Login')->with('status', 'Mobile number is not verified. Do you want to verify your number now ?');
      				}
      			} else {
      				return redirect('studio_Login')->with('password', 'Password incorrect!');
      			}
      		}else{
      			return redirect('studio_Login')->with('error', 'Mobile number and Password incorrect!');
      		}

      	}

      }

      public function expireStudio($studio_id){
        // print_r($studio_id); die;
        try{
        $expire_studio = User::where('id','=', $studio_id)->get()->toArray();
    // print_r($expire_functionname); die;
        if(!empty($expire_studio)){
        $current_date = date('Y-m-d H:i:s');
        $exstudio = new User();
        $expire_users = $exstudio::where([
            ['ExpiredStudio', '<', $current_date],
            ['id','=', $studio_id],
        ])->get()->toArray();
        // print_r($expire_users[0]['id']); die;
        if(!empty($expire_users)){

            $expire_std = User::where('id','=', $expire_users[0]['id'])->update(['status'=> '3']);
           // print_r($expire_functionname); die;
            if($expire_std){
                return redirect('studio_Login')->with('error', 'Mobile Number and Password was Expired!');
                die;
            }
        }else{
                return view('userDashboard');
                    // print_r($functiondetail); die;
              } 
    
      }else{
             return redirect('studio_Login')->with('error', 'Enter a valid mobile no. and Password!');
          }
  }catch(QueryException $ex){
    if( $ex instanceof \Illuminate\Session\TokenMismatchException ){

            return redirect('studio_Login');
        }
        return redirect('studio_Login')->with($ex->getMessage());
}
}

      public function user_dashboard()
      {
      	$session= Session::all();
            if(array_key_exists('mobile', $session)){
              return view('userDashboard');    
        }else{
            return redirect('studio_Login')->with('error', 'Your Session Expired!');
        }
      	
      }

      public function studioLogout()
      {
      	Session::flush();
      	return redirect('studio_Login');

      }

      public function verifyStudio(Request $request){
      	$session = Session::all();
      	$isError = 0;
      	$errorMessage = true;
      	$otp = $session['otp'];
      	$mobile_number = $session['mobile'];
      	

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
        	// print_r($output); die;
      		return $output;

      	}
      }

  }

