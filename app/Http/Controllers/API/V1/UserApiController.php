<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\Controller;

use App\Models\ApiUser;
use App\Http\Requests\PostRequest;


use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;


class UserApiController extends Controller
{

    public function create(Request $request)
    {
        //  dd($request->all());
        $message = array();
        $status=0;
     
        if(!empty($request->all())){

            
            $validator = Validator::make($request->all(), [
                'user_id' => ['required', 'string', 'max:255', 'unique:api_users'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:api_users'],
                'contact' => ['required'],
                
            ]);

            if ($validator->fails()) {
                $message = $validator->messages()->toArray();
                $status=0;
            
            
           
            } else {
                //process the request

                $added_data = ApiUser::create([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                
    
            ]);

                if($added_data){

                    $message['success'] = 'User Create Successfully';
                    $status=1;

                }else{

                    $message['success'] = 'Error';
                    $status=0;

                }
       
            }

           

        }else{

            $message ='No Request Data';
            $status=0;

            

        }


            return response()->json(['status' => $status, 'message' => $message]);
        
    }


    public function update(Request $request)
    {
        //  dd($request->all());
        $message = array();
        $status=0;
     
        if(!empty($request->all())){

            
            $validator = Validator::make($request->all(), [
    
                    'user_id' => ['required', 'string', 'max:255', Rule::unique('api_users', 'user_id')
                    ->ignore($request->id)],
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', Rule::unique('api_users', 'email')
                    ->ignore($request->id)],
                    'contact' => ['required'],

                    
                
                
            ]);

            if ($validator->fails()) {
                $message = $validator->messages()->toArray();
                $status=0;
            
            
           
            } else {
                //process the request

                $apiuser= ApiUser::find($request->id);

                if($apiuser){
                    //check id

                    $data['user_id'] = $request->user_id;
                    $data['name'] = $request->name;
                    $data['email'] = $request->email;
                    $data['contact'] = $request->contact;
                
                
                    $update_data = $apiuser->update($data);
                
    
            

                if($update_data){

                    $message['success'] = 'Update Successfully';
                    $status=1;

                }else{

                    $message['success'] = 'Error';
                    $status=0;


                }

                
                }else{

                    $message['success'] = 'Id Doesnot Exist';
                    $status=0;

                }
       
            }

           

        }else{

            $message ='No Request Data';
            $status=0;

            

        }


            return response()->json(['status' => $status, 'message' => $message]);
        
    }


    public function delete(Request $request)
    {
        //  dd($request->all());
        $message = array();
        $status=0;
     
        if(!empty($request->all())){

            
            

           
                //process the request

                $apiuser= ApiUser::find($request->id);

                if($apiuser){
                    //check id

                    
                
                
                    $delete_data = $apiuser->delete($apiuser);
                
    
            

                if($delete_data){

                    $message['success'] = 'Delete Successfully';
                    $status=1;

                }else{

                    $message['success'] = 'Error';
                    $status=0;


                }

                
                }else{

                    $message['success'] = 'Id Doesnot Exist';
                    $status=0;

                }
       
            

           

        }else{

            $message ='No Request Data';
            $status=0;

            

        }


            return response()->json(['status' => $status, 'message' => $message]);
        
    }

   

    

    public function monthlySaleHistories(Request $request)
    {
        /*Print all request data into a Log file*/
        HelperRepo::log($request, "monthly_sale_histories");
        /*Print all request data into a Log file*/

        //$to = Carbon::today();
        //$from = Carbon::today()->subDays(30);
        $date=$request->date;
        // $saleHistories = DealerSaleHistorie::where(['user_id' => $request->dealer_id, 'office_id' => $request->office_id])
        //      //->whereBetween(DB::raw("DATE(sales_date)"), [$from, $to])
        //     ->whereDate(DB::raw("DATE(sales_date)"), $request->date)
        //     ->selectRaw('sum(item_amount) as stock, sales_date, item_id,id')
        //     ->groupBy(['item_id', 'sales_date'])
        //     ->orderBy('sales_date', 'desc')
        //     ->get();
        
        //sending total sales of a date
        $saleHistories = DealerSaleHistorie::where(['user_id' => $request->dealer_id, 'office_id' => $request->office_id])
             //->whereBetween(DB::raw("DATE(sales_date)"), [$from, $to])
            ->whereDate(DB::raw("DATE(sales_date)"), $request->date)
            ->selectRaw('sum(item_amount) as stock, sales_date, item_id,id,count(*) as total_people')
            ->groupBy('item_id')
            ->get();
        
        if (!empty($saleHistories)) {
            return response()->json(['success' => 1, 'message' => trans('messages.success'), 'data' => $saleHistories]);
        } else {
            return response()->json(['success' => 0, 'message' => trans('messages.No Data Available')]);
        }

    }

    public function dailySalesHistories(Request $request)
    {
        /*Print all request data into a Log file*/
        HelperRepo::log($request, "daily_sale_histories");
        /*Print all request data into a Log file*/

        $dealer_id = $request->dealer_id;
        $sales_date = $request->sales_date;
        $saleHistories = DealerSaleHistorie::with(['beneficiar' => function($q) {
            $q->select('id','benificiary_code','beneficiary_image','name','address');
        }])->where(['user_id' => $dealer_id])
            ->where(DB::raw("DATE(sales_date)"), $sales_date)
            ->orderBy('sales_date', 'desc')
            ->get(['id','sales_date','item_id','item_amount','benificiary_code']);

        if (!empty($saleHistories)) {
            return response()->json(['success' => 1, 'message' => trans('messages.success'), 'data' => $saleHistories]);
        } else {
            return response()->json(['success' => 0, 'message' => trans('messages.No Data Available')]);
        }

    }


}
