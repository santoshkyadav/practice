<?php

namespace App\Http\Controllers;

use App\PaymentdetailModel;
use Illuminate\Http\Request;
use App\CustomerModel;
use Validator;
use DB;
use Session;
use App\User;
use Carbon\Carbon;

class StudioController extends Controller {

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
    public function clients() {
        $session = Session::all();
        $user_id = $session['studio_id'];
        $studio  = DB::table('studio')->where('id', $user_id)->get();
        if($studio[0]->status  == 2){
             $allEvents = DB::table('customerdetails')->where('studio_id', $user_id)->get();
        // print_r($allEvents); die;
        return view('events.clientdetail', compact(['allEvents']));
        }else{
            return redirect('user_dashboard')->with('error', 'Not a Active User.');
        }
       
    }

    public function viewCustomer(Request $request){
        $customer = $request->id;
        $cust =  CustomerModel::find($customer);
        $data = (['Cust_Username' =>$cust->Cust_Username,
        'Cust_Password' => $cust->Cust_Password
    ]);
    
        $username = $cust->Cust_Username;
        $pass = $cust->Cust_Password;
        return redirect('customer/view?Cust_Username='.$username.'&Cust_Password='.$pass);
        
    }

    public function displaySoftware() {
        $session = Session::all();
        $user_id = $session['studio_id'];
        $studio  = DB::table('studio')->where('id', $user_id)->get();
        if($studio[0]->status  == 2){
        $software = DB::table('software')->select('sw_name', 'file_name', 'description')->where('IsActive', 1)->get();
        return view('events.software', compact(['software']));
        }else{
            return redirect('user_dashboard')->with('error', 'Not a Active User.');
        }
    }

    public function displaytemplate($template) {

        $template = DB::table('template')->select('template_name', 'file_name', 'imagename', 'size', 'template_type')->where('template_type', $template)->where('IsActive', 1)->get();
//        print_r($template); die;
        return view('events.template', compact(['template']));
    }

    public function templatesummary() {
         $session = Session::all();
        $user_id = $session['studio_id'];
        $studio  = DB::table('studio')->where('id', $user_id)->get();
        if($studio[0]->status  == 2){
        $templatesummary = DB::table('templatesummary')->select('UploadDate', 'NoOfTemplate', 'TotalFileSize', 'TemplateType')->orderby('UploadDate', 'desc')->get()->toArray();
       // print_r($templatesummary); die;
        return view('events.templatesummary', compact(['templatesummary']));
        }else{
            return redirect('user_dashboard')->with('error', 'Not a Active User.');
        }
    }

    public function paymentgateway(Request $request) {
        $Validator = Validator::make($request->all(),[
            'amount'=> 'required|string',
            'paidfor' => 'required',
            'collection' => 'required'
        ]);
        if($Validator ->fails()){
            $failedRules = $Validator->getMessageBag();
            return redirect()->back()->withInput()->withErrors($failedRules);
        } else{
            if($request->payment_tenure == 0){
           $session = Session::all();
           $paidfor = json_encode($request->paidfor);
        // print_r($session); die();
           $paymentTable = new PaymentdetailModel();
           $paymentTable->SubscriptionTenure = $request->payment_tenure;
           $paymentTable->PaymentMethord = $request->payment;
           $paymentTable->AmountPaid = $request->amount;
           $paymentTable->Studio_id = $session['studio_id'];
           $paymentTable->StudioMobileNumber = $session['mobile'];
           $paymentTable->AmountPaidFor = $paidfor;
           $paymentTable->CollectionPlace = $request->collection;
           $paymentTable->CollectedBy = $request->collectedby;
           $paymentTable->Remark = $request->remark;

           $paymentTable->save();
           if($paymentTable){
            $now = Carbon::now();
            $time = strtotime($now);
            $final = date("Y-m-d h:m:s", strtotime("+1 month", $time));
            // print_r($final);
           $studio = User::where('id', $session['studio_id'])->update(['ExpiredStudio' => $final,
            'status' => '2']);
           return redirect('user_dashboard');
            }
        }else{
            $session = Session::all();
            $paidfor = json_encode($request->paidfor);
        // print_r($session); die();
          $paymentTable = new PaymentdetailModel;
           $paymentTable->SubscriptionTenure = $request->payment_tenure;
           $paymentTable->PaymentMethord = $request->payment;
           $paymentTable->AmountPaid = $request->amount;
           $paymentTable->Studio_id = $session['studio_id'];
           $paymentTable->StudioMobileNumber = $session['mobile'];
           $paymentTable->AmountPaidFor = $paidfor;
           $paymentTable->CollectionPlace = $request->collection;
           $paymentTable->CollectedBy = $request->collectedby;
           $paymentTable->Remark = $request->remark;

           $paymentTable->save();
           if($paymentTable){
            $now = Carbon::now();
            $time = strtotime($now);
            $final = date("Y-m-d h:m:s", strtotime("+".$request->payment_tenure." month", $time));
            // print_r($final);
           $studio = User::where('id', $session['studio_id'])->update(['ExpiredStudio' => $final,
            'status' => '2']);
            return redirect('user_dashboard');
            }
        }
       }         
   }

    public function finalsubmitsync(Request $request){
        // print_r($request->studio_id); die;
    // $data =Session::all(); 
    $isError = 0;
    $errorMessage = true;
    $customer = DB::table('mstcustomer')->where('Customer_id', $request->id)->get();
    $user = User::where('id', $request->studio_id)->get();
   
    $mobile_number = $user[0]->mobile_no;
                     // $mobile_number = 8052222355;
    $message= $customer[0]->CustomerName." has send selected photo to download.";
                //Preparing post parameters
     // print_r($message); die;
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
        // $user = CustomerloginModel::where('Cust_Username', $mobile_number)->where('studio_id', $data['studio_id'])->update(['status'=> '0']);
     return $output;
    }
}

}
