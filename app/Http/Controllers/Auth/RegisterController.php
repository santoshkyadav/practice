<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/otp';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    /**
 * Handle a registration request for the application.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function register(Request $request)
{
    $this->validator($request->all())->validate();

    event(new Registered($user = $this->create($request->all())));

    return redirect($this->redirectPath())->with('message', 'Your message');
}

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'studio_name'=> 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'mobile_no'=> 'required|numeric|digits:10|unique:users',
            'city'=>'required|alpha',
            'state'=>'required|alpha',
        ]);
    }
      
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    { 
        return  User::create([
            'studio_name'=> $data['studio_name'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'mobile_no'=> $data['mobile_no'],
            'alternate_mobile'=> $data['Alt_mobile_no'],
            'user_type'=>'2',
            'city'=> $data['city'],
            'state'=> $data['state'],
        ]);

       
    }

       public function sendSMS(Request $request){
        $isError = 0;
        $errorMessage = true;
print_r($request); die;
$name = $request->name;
$mobile_number = $request->mobile_no;
$message= "Dear ABC your Login Detail for Uploaded Album history, visit www.efotobook.in with username: 8853997700 and password : 123";

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
           return (json_encode(array('status' => 'success', 'message' => 'Data Submitted Successfully', 'result' => $output)));
            
        }
    }
    public function otp(){
        return view('otp');
    }
}
