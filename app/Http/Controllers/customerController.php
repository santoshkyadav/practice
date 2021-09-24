<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\CustomerloginModel;
use App\CustomerModel;
use Validator;
use DB;

class customerController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('customer_login');
    }

    public function customer_login(Request $request) {
        try{
        $validator = Validator::make($request->all(), [
            'Cust_Username' => 'required|numeric|digits:10',
            'Cust_Password' => 'required',
        ]);
        // print_r($request); die;
        $allcustomer = new CustomerloginModel();
        $allcustomers = $allcustomer::where(['Cust_Username' => $request->Cust_Username, 'Cust_Password' => $request->Cust_Password ])->first();
// print_r($allcustomers['status']); die;
        if (!empty($allcustomers)) {
            if($allcustomers['status'] === '1'){

            session([
                'customer_id' => $allcustomers->Customer_id,
                'username' => $allcustomers->Cust_Username,
                'studio_id' => $allcustomers->studio_id,
            ]);
// print_r($allcustomers->Customer_id); die;
                return $this->expireCustomer($allcustomers->Customer_id, $allcustomers->studio_id);
           }else{
                return redirect('customer')->with('error', 'You are not a Active user. Contact your studio for activation.');
           } 
        }else{
            return redirect('customer')->with('error', 'Username and Password not matched.');
        }
    }catch(QueryException $ex){
         if( $ex instanceof \Illuminate\Session\TokenMismatchException ){

            return redirect('customer');
        }
        return redirect('customer')->with($ex->getMessage());
    }
}

    public function expireCustomer($id, $studio_id){
        // print_r($studio_id); die;
        try{
    $customer_id = $id;
    $studio_id = $studio_id;
    $expire_functionname = DB::table('mstfunction')->where('customer_id','=', $customer_id)->get()->toArray();
    // print_r($expire_functionname); die;
    if(!empty($expire_functionname)){
    if($expire_functionname[0]->status == 1){
     return redirect('customer')->with('error', 'Mobile Number and Password was Expired!');
     die;
    }else{
        $current_date = date('Y-m-d H:i:s');
        $expireCustomer = new CustomerModel();
        $expire_users = $expireCustomer::where([
            ['ExpiryDate', '<', $current_date],
            ['customer_id','=', $customer_id],
        ])->get()->toArray();
        // print_r($expire_users[0]['id']); die;
        if(!empty($expire_users)){

            $expire_functionname = DB::table('mstfunction')->where('customer_id','=', $expire_users[0]['customer_id'])->update(['status'=> '1']);
           // print_r($expire_functionname); die;
            if($expire_functionname){
                return redirect('customer')->with('error', 'Mobile Number and Password was Expired!');
                die;
            }
        } else{
            $functiondetail = DB::table('mstfunction')
            ->where(['Customer_id' => $customer_id,
             'Studio_Id' => $studio_id])
            ->get()->toArray();
            if(!empty($functiondetail)){
                    return view('customer_guide', compact(['functiondetail']));
            }else{
                return redirect('customer')->with('error', 'Function does not exist. Please contact to your Studio.');
            }
                    // print_r($functiondetail); die;
        } 
    }
}else{
     return redirect('customer')->with('error', 'Function does not exist.');
}
}catch(QueryException $ex){
    if( $ex instanceof \Illuminate\Session\TokenMismatchException ){

            return redirect('customer');
        }
        return redirect('customer')->with($ex->getMessage());
}
}

    public function show(){
        $data = Session::all();
        if(array_key_exists('username', $data)){ 
         return view('customer');
     }else{
        return redirect('customer')->with('error', 'Your session expired!');
    }
}

    public function functionPhotos(Request $request) {
    $data = Session::all();
    $customer_id = $data['customer_id'];
    $studio_id = $data['studio_id'];
    $rules = array(
        'event_name' => 'required',
    );
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        $failedRules = $validator->getMessageBag()->toArray();
        $errorMsg = "";
        if (isset($failedRules['event_name'])) {
            $errorMsg = $failedRules['event_name'][0] . "\n";
            return (json_encode(array('status' => 'error', 'message' => "Event Name not matched")));
        }
    } else {
        $name = $request->event_name;
        $function = DB::table('mstfunction')
        ->where(['Customer_id' => $customer_id, 'Studio_Id' => $studio_id])
        ->ORDERBY('FunctionDate', 'DESC')
        ->first();
        // print_r($function);
        //    die;
        $allPhotos = DB::table('tblfunctiondetail')->where([['FolderName', $name], ['Customer_id', $customer_id], ['Studio_Id', $studio_id],['Function_id', $function->id]])->get()->toArray();
//            print_r($allPhotos);
//            die;
        if (!empty($allPhotos)) {
            return (json_encode(array('status' => 'success', 'message' => '', 'result' => $allPhotos)));
        } else {
            return (json_encode(array('status' => 'error', 'message' => 'No Photos Found')));
        }
    }
}

    public function customer_function_update(Request $request) {
    $data = Session::all();
    $customer_id = $data['customer_id'];
    $function_date = $request->function_date;
    $function_type = $request->function_type;
    $function_name = $request->function_name;
    $other_remark = $request->other_remark;
    $function_id = $request->function_id;

    $update_function = DB::table('mstfunction')
    ->where(['customer_id' => $customer_id, 'id' => $function_id])
    ->update(['FunctionDate' => $function_date, 'FunctionType' => $function_type, 'AlbumName' => $function_name, 'Remark' => $other_remark]);
    // print_r($request); die;
    if ($update_function === 1) {

        $get_updated_function = DB::table('mstfunction')
        ->where('customer_id', $customer_id)->get();

        return (json_encode(array('status' => 'success', 'message' => 'Data Submitted Successfully', 'result' => $get_updated_function)));
    } else {
        return (json_encode(array('status' => 'error', 'message' => 'Data Not Correct')));
    }
}

    public function Comment_photo(Request $request) {
    $rules = array(
        'id' => 'required',
    );
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        $failedRules = $validator->getMessageBag()->toArray();
        $errorMsg = "";
        if (isset($failedRules['id']))
            $errorMsg = $failedRules['id'][0] . "\n";
        return (json_encode(array('status' => 'error', 'message' => "Please enter Comment")));
    }
    else {
        $result = DB::table('tblfunctiondetail')
        ->where('ImageId', $request->id)
        ->update(['Comment'=> $request->comment,
                    'Status' => '1']);
        if ($result) {
            return (json_encode(array('status' => 'success', 'message' => 'successfully commented')));
        } else {
            return (json_encode(array('status' => 'error', 'message' => 'No comment found')));
        }
    }
}

    public function Select_photo(Request $request) {
    $rules = array(
        'id' => 'required',
    );
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        $failedRules = $validator->getMessageBag()->toArray();
        $errorMsg = "";
        if (isset($failedRules['id']))
            $errorMsg = $failedRules['id'][0] . "\n";
        return (json_encode(array('status' => 'error', 'message' => "Event Id not matched")));
    }
    else {
        if (\DB::table('tblfunctiondetail')->where('ImageId', $request->id)->where('status', '1')->exists()) {
            $data = array(
                'status' => '0',
            );
            $result = \DB::table('tblfunctiondetail')->where('ImageId', $request->id)->update($data);
            if ($result) {
                return (json_encode(array('status' => 'warning', 'message' => 'Image removed from selected list', $result)));
            } else {
                return (json_encode(array('status' => 'error', 'message' => 'No Image found')));
            }
        } else {
            $data = array(
                'status' => '1',
            );
            $result = \DB::table('tblfunctiondetail')->where('ImageId', $request->id)->update($data);
            if ($result) {
                return (json_encode(array('status' => 'success', 'message' => 'Photo Selected')));
            } else {
                return (json_encode(array('status' => 'error', 'message' => 'No Photo found')));
            }
        }
    }
}

    public function logout(Request $request) {
//        Auth::logout();
    Session::flush();
    return redirect('customer');
}

//     public function finalsubmitmsg(Request $request){
//     $data =Session::all();
//     $isError = 0;
//     $errorMessage = true;
//     $mobile_number = $data['username'];
//                      // $mobile_number = 8052222355;
//     $message= "Dear User your OTP for verification of PAMS account is 2301.";
//                 //Preparing post parameters
//     $postData = array(
//         'user' => 'elation', 
//         'password' => '8853997700',
//         'msisdn' => $mobile_number,
//         'sid' => 'EFBOOK',
//         'msg' => $message,
//         'fl' => 0,
//         'gwid' => 2
//     );

//     $url = "http://smsstore.elationsoft.net/vendorsms/pushsms.aspx";

//     $ch = curl_init();
//     curl_setopt_array($ch, array(
//         CURLOPT_URL => $url,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_POST => true,
//         CURLOPT_POSTFIELDS => $postData
//     ));


//                 //Ignore SSL certificate verification
//     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


//                 //get response
//     $output = curl_exec($ch);

//                 //Print error if any
//     if (curl_errno($ch)) {
//         $isError = true;
//         $errorMessage = curl_error($ch);
//     }
//     curl_close($ch);
//     if($isError){
//         return array('error' => 1 , 'message' => $errorMessage);
//     }else{
//         // $user = CustomerloginModel::where(['Cust_Username'=> $mobile_number,
//         //     'studio_id'=> $data['studio_id'],
//         // ])->update(['status'=> '0']);
//      return $output;
//     }
// }

}
