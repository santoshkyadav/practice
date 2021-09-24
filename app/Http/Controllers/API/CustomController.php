<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Response;
use Illuminate\Database\QueryException;
use DB;
use App\CustomerloginModel;
use App\User;
use App\functionNameModel;
use App\FunctiondetailModel;

class CustomController extends Controller {

    public function __construct() {
    //$this->middleware('guest');
    }

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function login(Request $request) {
    try {
        $validator = Validator::make($request->all(), [
            'username' => 'required|numeric|digits:10',
            'Password' => 'require',
        ]);
        if ($validator->fails()) {
            $errorMsg = $validator->getMessageBag()->toArray();
            return Response::json(array('status' => 'error', 'message' => $errorMsg))->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
        } else {
            $allCustomers = CustomerloginModel::select('Cust_Username', 'Cust_Password')
            ->where(['Cust_Username' => $request->username,
                'Cust_Password' => $request->password,
            ])->get();
            if (count($allCustomers) > 0){
                return Response::json(['status' => 'success', 'message' => 'Logged Successfully', 'data' => $allCustomers])->withHeaders([
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

public function addCustomer(Request $request){
   try {
    $validator = Validator::make($request->all(), [
        'studio_mobile'=> 'required|numeric|digits:10',
        'Cust_Username' => 'required|numeric|digits:10',
        'password' => 'required|min:3',
        'name' => 'required',
        'city' => 'required',
        'state' => 'required',
        'status' => 'required'
    ]);
    if ($validator->fails()) {
        $errorMsg = $validator->getMessageBag()->toArray();
        return Response::json(array('status' => 'error', 'message' => $errorMsg))->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ]);
    } else {

// $studio = User::all();
        $studio = User::where('mobile_no','=', $request->studio_mobile)->get()->toArray();
            // return print_r($studio); die;
        if(!empty($studio)){
            $studio = $studio[0]['id'];
            $customer = CustomerloginModel::where('Cust_Username', $request->Cust_Username)
            ->where('studio_id', $studio)->get()->toArray();
            // return print_r($customer); die;
            if(!empty($customer)){

                $customer_update = CustomerloginModel::where('Cust_Username', '=', $request->Cust_Username)->update(['studio_id' => $studio,
                    'Cust_Username' => $request->Cust_Username,
                    'Cust_Password' => $request->password,
                    'CustomerName' => $request->name,
                    'City' => $request->city,
                    'State' => $request->state,
                    'status' => $request->status ]);
                if($customer_update){
                    $num_padded = sprintf("%04d", $studio);
                    return Response::json(['status' => 'success', 'message' => 'Updated Successfully', 'studio_id' => $num_padded])->withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ]);
                } else{
                    return Response::json(array('status' => 'error', 'message' => 'Customer not updated.'))->withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ]);
                }
            }else{ 

                $customer = new CustomerloginModel;
                $customer->studio_id = $studio; 
                $customer->Cust_Username = $request->Cust_Username;
                $customer->Cust_Password = $request->password;
                $customer->CustomerName = $request->name;
                $customer->City = $request->city;
                $customer->State = $request->state;
                $customer->State = $request->status;

                $customer->save();
                $num_padded = sprintf("%04d", $studio);
                return Response::json(['status' => 'success', 'message' => 'Created  Successfully', 'studio_id' => $num_padded])->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]); 

            }
        }else{
           return Response::json(array('status' => 'error', 'message' => 'Enter a valid studio mobile number.'))->withHeaders([
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

public function addFunctionName(Request $request){
    try {

        $validator = Validator::make($request->all(), [
            'customer_mobile'=> 'required|numeric|digits:10',
            'functiondate' => 'required',
            'functiontype' => 'required',
            'albumname' => 'required',
            'imagecount' => 'required',
            'noofsheet' => 'required'
        ]);
        if ($validator->fails()) {
            $errorMsg = $validator->getMessageBag()->toArray();
            return Response::json(array('status' => 'error', 'message' => $errorMsg))->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
        } else {

            $customer_detail = CustomerloginModel::where('Cust_Username', $request->customer_mobile)->where('studio_id', $request->studio_id)->get()->toArray();

            if(!empty($customer_detail)){
                 $customer_id = $customer_detail[0]['Customer_id'];
                $studio_id = $customer_detail[0]['studio_id'];
                $functiondate = $request->functiondate;
                
                //----------convert date formet here-------------//
                // $date = explode(' ',$functiondate);
                // $date1 = $date[0];
                // $date1 = strtotime($date1);
                // $new = date('Y-m-d', $date1);
                //   // return print_r($new); die;      
                $function_date = functionNameModel::where('FunctionDate', $functiondate)
                ->where('customer_id', $customer_id)
                ->get()->toArray();
               
                if(!empty($function_date)){
                    $function_update = functionNameModel::where('FunctionDate', '=', $functiondate)->where('customer_id', $customer_id)->update(['Studio_Id' => $studio_id,
                        'customer_id' => $customer_id,
                        'FunctionDate' => $functiondate,
                        'FunctionType' => $request->functiontype,
                        'AlbumName' => $request->albumname,
                        'ImageCount' => $request->imagecount,
                        'Remark' => $request->remark,
                        'NumberOfSheet' => $request->noofsheet,
                         ]);

                    if($function_update){
                        $function_id = functionNameModel::select('id')->where('FunctionDate', $request->functiondate)
                        ->where('customer_id', $customer_id)
                        ->where('Studio_Id', $studio_id)
                        ->get()->toArray();
                        // return print_r($function_id); die;
                        $function_id = $function_id[0]['id'];
                        $num_padded = sprintf("%06d", $function_id);
                        // return print_r($num_padded); die;
                     return Response::json(['status' => 'success', 'message' => 'Updated Successfully', 'function_id' => $num_padded])->withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ]);
                 }else{
                    return Response::json(array('status' => 'error', 'message' => 'Function name is not Updated.'))->withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ]); 
                }
            }else{

                $function = new functionNameModel;

                $function->Studio_Id = $studio_id; 
                $function->customer_id = $customer_id;
                $function->FunctionDate = $request->functiondate;
                $function->FunctionType = $request->functiontype;
                $function->AlbumName = $request->albumname;
                $function->ImageCount = $request->imagecount;
                $function->Remark = $request->remark;
                $function->NumberOfSheet = $request->noofsheet; 

                $function->save();
                if($function){
                     $function_id = functionNameModel::select('id')->where('FunctionDate', $request->functiondate)
                        ->where('customer_id', $customer_id)
                        ->where('Studio_Id', $studio_id )
                        ->get()->toArray();
                        // return print_r($function_id); die;
                        $function_id = $function_id[0]['id'];
                        
                        $num_padded = sprintf("%06d", $function_id);
                        
                 return Response::json(['status' => 'success', 'message' => 'Function Created  Successfully', 'function_id' => $num_padded])->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]);
             }else{
                return Response::json(array('status' => 'error', 'message' => 'Function is not created.'))->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]); 
            }
        }
    }else{
        return Response::json(array('status' => 'error', 'message' => 'Entar a registered customer Mobile number.'))->withHeaders([
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

public function photoDetails(Request $request){

    try {
        $validator = Validator::make($request->all(), [
            'customer_mobile'=> 'required|numeric|digits:10',
            'folder_name'=> 'required',
            'filename' => 'required',
            'function_id' => 'required',
        ]);
        if ($validator->fails()) {
            $errorMsg = $validator->getMessageBag()->toArray();
            return Response::json(array('status' => 'error', 'message' => $errorMsg))->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
        } else {

            $customer_detail = CustomerloginModel::where('Cust_Username','=', $request->customer_mobile)->where('studio_id', $request->studio_id)->get()->toArray();
            // return print_r($customer_detail); 
            if(!empty($customer_detail)){

                $customer_id = $customer_detail[0]['Customer_id'];
                $studio_id = $customer_detail[0]['studio_id'];

                $functiondetail = new FunctiondetailModel;

                $functiondetail->Studio_Id = $studio_id; 
                $functiondetail->Customer_Id = $customer_id;
                $functiondetail->Function_id = $request->function_id;
                $functiondetail->FolderName = $request->folder_name;
                $functiondetail->FileName = $request->filename;

                $functiondetail->save();
                if($functiondetail){
                 return Response::json(['status' => 'success', 'message' => 'Image details submitted  Successfully', 'data' => $functiondetail])->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]);
             }else{
                return Response::json(array('status' => 'error', 'message' => 'Image details not submitted.'))->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]); 
            }

        }else{
            return Response::json(array('status' => 'error', 'message' => 'Enter a registered mobile number.'))->withHeaders([
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

public function selectedImages(Request $request){
    try{
        $validator = Validator::make($request->all(), [
            'customer_mobile'=> 'required|numeric|digits:10',
            'function_id' => 'required',
        ]);
        if ($validator->fails()) {
            $errorMsg = $validator->getMessageBag()->toArray();
            return Response::json(array('status' => 'error', 'message' => $errorMsg))->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
        } else {
            $customer_detail = CustomerloginModel::where('Cust_Username','=', $request->customer_mobile)->get()->toArray();
            // return print_r($customer_detail); 
            if(!empty($customer_detail)){

                $customer_id = $customer_detail[0]['Customer_id'];
                $studio_id = $customer_detail[0]['studio_id'];

                $selected_images_data = FunctiondetailModel::where('Function_id', $request->function_id)->where('Status', '1')->get()->toArray();
                // return print_r($selected_images_data); die;
                if(!empty($selected_images_data)){
                     return Response::json(['status' => 'success', 'message' => 'Image details submitted  Successfully', 'data' => $selected_images_data])->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]);

                }else{
                    return Response::json(array('status' => 'error', 'message' => 'Function not exist or photos are not selected!'))->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    ]);
                }

            }else{
                 return Response::json(array('status' => 'error', 'message' => 'Enter a valid mobile number.'))->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    ]);
            }
        }
    }catch(QueryException $ex){
         return Response::json(array('status' => 'error', 'message' => $ex->getMessage()))->withHeaders([
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ]);
    }
}

public function activateCustomer(Request $request){
     try{
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            
        ]);
        if ($validator->fails()) {
            $errorMsg = $validator->getMessageBag()->toArray();
            return Response::json(array('status' => 'error', 'message' => $errorMsg))->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
        } else {
            $customer_detail = CustomerloginModel::where('Customer_id','=', $request->customer_id)->get()->toArray();
            // return print_r($customer_detail); 
            if(!empty($customer_detail)){
                $activateCustomer = CustomerloginModel::where('Customer_id','=', $request->customer_id)->update(['status' => '1']);
                if($activateCustomer){
                     return Response::json(['status' => 'success', 'message' => 'Customer Activated Successfully.'])->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]);
                }else{
                    return Response::json(array('status' => 'error', 'message' => 'Customer does not Activated!'))->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
                }

            }else{
                return Response::json(array('status' => 'error', 'message' => 'Customer does not exist!'))->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]);
            }
        }
    }catch(QueryException $ex){
         return Response::json(array('status' => 'error', 'message' => $ex->getMessage()))->withHeaders([
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ]);
    }

}

}
