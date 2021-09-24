<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;
class StudioresetPasswordController extends Controller {

	public function index(){
		return view('Auth.studiopasswordreset');
	}

	public function passwordReset(Request $request){
		$Validator = Validator::make($request->all(),[
			'mobile_no'=> 'required|numeric|digits:10',
			'password' => 'required|confirmed|min:6'	
		]);
		if($Validator->fails()){
			$failedRules = $Validator->getMessageBag();
			return redirect()->back()->withErrors($failedRules);
		}else{
			$password = $request->password;
			$user = User::where('mobile_no', '=', $request->mobile_no)
			->update(['password' => bcrypt($password)]);
			if($user){
				return redirect('studio_Login')->with('success', 'Success! Your Password has been changed.');
			}else{
				return redirect()->back()->with('error', 'Please enter a valid mobile number.');
			}

		}
	}
}
