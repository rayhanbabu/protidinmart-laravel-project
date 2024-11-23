<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Orderproduct;
use Illuminate\Support\Facades\validator;

class CheckoutController extends Controller
{

     public function checkout(Request $request){

          $member_id=$request->header('member_id');
          $cart_detail=Cart::leftjoin('products','products.id','=','carts.product_id')
          ->where('member_id',$member_id)->select('products.image','products.product_name','products.amount','carts.*')->get();

          $address=Address::where('member_id',$member_id)->first();
          return view('frontend.checkout',['address'=>$address,'cart_detail'=>$cart_detail]);  
      }


     public function upazila_id_fetch(Request $request){
       $data=DB::table('upazilas')->where('district_id',$request->district_id)->orderBy('name','asc')->get();
          if(count($data) > 0) {
             return response()->json($data);
          }
      }


       public function union_id_fetch(Request $request){
            $data=DB::table('unions')->where('upazila_id',$request->upazila_id)->orderBy('name','asc')->get();
             if(count($data) > 0) {
               return response()->json($data);
             }
         }


     public function confirm_order(Request $request){
      
          DB::beginTransaction();
          try {
          $member_id=$request->header('member_id');
          $phone=$request->header('phone');
          $address=Address::where('member_id',$member_id)->first();
          if(empty($address)){
            $validator = \Validator::make($request->all(), [
               'name' => 'required',
               'phone' => 'required',
               'district_id' => 'required',
               'upazila_id' => 'required',
               'union_id' => 'required',
               'address' => 'required',
            ]);

          if($validator->fails()) {
            return response()->json([
                  'status' => "fail",
                  'message' => "All address fields are required",
              ],200);
             } 

               $addressmodel = new Address;
               $addressmodel->member_id = $member_id;
               $addressmodel->name = $request->input('name');
               $addressmodel->phone = $request->input('phone');
               $addressmodel->alternative_phone =$request->input('alternative_phone');
               $addressmodel->district_id = $request->input('district_id');
               $addressmodel->upazila_id = $request->input('upazila_id');
               $addressmodel->union_id = $request->input('union_id');
               $addressmodel->address = $request->input('address');
               $addressmodel->save();

               $district_amount=DB::table('districts')->where('id',$addressmodel->district_id)->first();
           }else{
               $district_amount=DB::table('districts')->where('id',$address->district_id)->first();
           }


           $cart=Cart::leftjoin('products','products.id','=','carts.product_id')
            ->where('member_id',$member_id)
            ->select('products.image','products.product_name',
             'products.amount','carts.*')
             ->get();

        if($cart->count() > 0){ 
            $payment_method=$request->payment_method;
            $shipping_amount = $district_amount->amount;
            $discount_amount=0;
            $total_amount=0;
            foreach($cart as $row){ 
               $total_amount+=($row->amount*$row->qty);
            }
            $gross_amount=$total_amount-$discount_amount;   
            $net_amount=($shipping_amount+$total_amount)-$discount_amount;
                     
            $model= new Order; 
            $model->member_id=$member_id;
            $model->tran_id=Str::random(8);
            $model->total_amount=$total_amount;
            $model->discount_amount=$discount_amount;
            $model->shipping_amount=$shipping_amount;
            $model->gross_amount=$gross_amount;
            $model->net_amount=$net_amount;
            $model->status="PENDING";
            $model->payment_status=0;

         if(empty($address)){
             $model->shipping_name=$addressmodel->name;
             $model->shipping_phone=$addressmodel->phone;
             $model->address=$addressmodel->address;
             $model->district=$addressmodel->district_id;
             $model->upazila=$addressmodel->upazila_id;
             $model->union=$addressmodel->union_id;
         }else{
             $model->shipping_name=$address->name;
             $model->shipping_phone=$address->phone;
             $model->address=$address->address;
             $model->district=$address->district_id;
             $model->upazila=$address->upazila_id;
             $model->union=$address->union_id;
          }         
           $model->payment_method=$payment_method;
           $model->save();

           foreach($cart as $row){ 
               $order= new Orderproduct;
               $order->order_id=$model->id;
               $order->product_id=$row->product_id;
               $order->product_name=$row->product_name;
               $order->per_amount=$row->amount;
               $order->qty=$row->qty;
               $order->size=$row->size;
               $order->total_amount=$row->amount*$row->qty;
               $order->save();
            } 

             Cart::where('member_id',$member_id)->delete();

            //  $subject = 'Order Request with Altabanu';
            //  $body = 'Order request successful. Your Order ID:'.$model->id;
            //  $link=URL::to('order_history');
            //  SendEmail($email, $subject, $body, $link, "Altabanu");
          }else{
               return response()->json([
                  'status' => 'fail',
                  'message' => 'Cart Empty',
               ],200);
          }   

            DB::commit();    
            return response()->json([
              'status' => 'success',
              'message' => 'Order has been created successfully',
            ],200);

         } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                  'status' => 'fail',
                'message' => 'Some error occurred. Please try again',
              ],200);
           }

       }
    
    



  }
