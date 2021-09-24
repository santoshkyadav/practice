<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;
class StudioForgetpasswordController extends Controller {

	public function index(){
		return view('Auth.studioforgetPassword');
	}

	public function changePassword(Request $request){
		$Validator = Validator::make($request->all(),[
			'mobile_no'=> 'required|numeric|digits:10']);
		if($Validator->fails()){
			$failedRules = $Validator->getMessageBag();
			return redirect()->back()->withErrors($failedRules);
		}else{
			$user = User::where('mobile_no', '=', $request->mobile_no)
			->get()
			->toArray();
			if(!empty($user)){
				return redirect('resetpassword');
			} else{
				$errors = "We can't find a user with that mobile number.";
				return redirect()->back()->with('error', $errors);
			}
		}	
	}

}