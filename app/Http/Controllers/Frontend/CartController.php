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
use Illuminate\Support\Facades\validator;


class CartController extends Controller
{

    public function add_to_cart(Request $request){
          $product_id=$request->product_id;
          $qty=$request->qty;
          $member_id=$request->header('member_id');
          $size=$request->size;

         Cart::updateOrCreate(['member_id'=>$member_id,'product_id'=>$product_id],
         ['member_id'=>$member_id,'product_id'=>$product_id,'qty'=>$qty ,'size'=>$size]);
            return response()->json([
               'status' => 'success',
               'data' => $request->all(),
               'message' => 'Data Added Successfully',
             ],200);  
          }


         public function address_edit(Request $request){
              return view('frontend.address_edit');
          }


     public function cart_product_count(Request $request){

         $member_id=$request->header('member_id');
         $cart=Cart::where('member_id',$member_id)->get();
       
          return response()->json([
               'status' => 'success',
               'count' => $cart->count(),
               'message' => 'Data Fatch Successfully',
           ],200);  
         
       }



     public function cart_details(Request $request){ 

            $member_id=$request->header('member_id');

            $cart_detail=Cart::leftjoin('products','products.id','=','carts.product_id')
                ->where('member_id',$member_id)
                ->select('products.image','products.product_name',
                'products.amount','carts.*')
                ->get();

             $address=Address::leftjoin('districts','districts.id','=','addresses.district_id')
               ->leftjoin('upazilas','upazilas.id','=','addresses.upazila_id')
               ->leftjoin('unions','unions.id','=','addresses.union_id')
               ->where('member_id',$member_id)
               ->select('districts.name as district_name','upazilas.name as upazila_name'
               ,'unions.name as union_name' ,'addresses.*')->first();  

             if($cart_detail->count()<=0){
                    $cart="empty";
                    return view('frontend.cart',['cart'=>$cart,'address'=>$address]); 
              }else{
                   return view('frontend.cart',['cart'=>"",'address'=>$address]); 
              }
         }



      public function cart_detail_fatch(Request $request){   
            $member_id=$request->header('member_id');  
            $cart=Cart::leftjoin('products','products.id','=','carts.product_id')
             ->where('member_id',$member_id)
             ->select('products.image','products.product_name',
             'products.amount','carts.*')
             ->get();
       
          
           return response()->json([
                 'status' => 'success',
                 'cart' => $cart,
                 'message' => 'Data Added Successfully',
             ],200);  
        }


        public function cart_delete_item(Request $request){   

         $cart_id=$request->id; 
         $cart=Cart::find($cart_id);
         $cart->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data Added Successfully',
             ],200);  
     }



      public function cart_update_quantity(Request $request){   

          $cart_id=$request->id; 
          $quantity=$request->quantity; 
          $model=Cart::find($cart_id);
          $model->qty = $quantity;
          $model->save();
 
           return response()->json([
               'status' => 'success',
               'message' => 'Data Added Successfully',
            ],200);  
       }




       public function check_out_count(Request $request){

         $member_id=$request->header('member_id');
         $cart=Cart::leftjoin('products','products.id','=','carts.product_id')
          ->where('member_id',$member_id)
          ->select('products.image','products.product_name','products.amount','carts.*')->get();
           $sum=0;
          foreach($cart as $row){
                   $sum=$sum+$row->qty*$row->amount;
          }

          $shipping_amount=100;
          $total_amount=$sum+$shipping_amount;
        
          return response()->json([
               'status' => 'success',
               'subtotal_amount' => $sum,
               'shipping_amount' => $shipping_amount,
               'total_amount' => $total_amount,
               'message' => 'Data Fatch Successfully',
           ],200);  
          
      }


      public function address_update(Request $request){
              //$data="Rayhan babu";   
              $member_id=$request->header('member_id'); 
              $validator = \Validator::make($request->all(),[
                  'name' => 'required',
                  'phone' => 'required',
                  'district_id' => 'required',
                  'upazila_id' => 'required',
                  'union_id' => 'required',
                  'address' => 'required',
              ]);
  
              if($validator->fails()){
                   return response()->json([
                      'status' => "fail",
                      'message' => "All address fields are required",
                     ],200);
                } 
                
                 $name = $request->input('name');
                 $phone = $request->input('phone');
                 $alternative_phone =$request->input('alternative_phone');
                 $district_id = $request->input('district_id');
                 $upazila_id = $request->input('upazila_id');
                 $union_id = $request->input('union_id');
                 $address = $request->input('address');
                 
               DB::update("update addresses set name ='$name', phone ='$phone', alternative_phone ='$alternative_phone',
               district_id ='$district_id',upazila_id ='$upazila_id' ,union_id ='$union_id'
               ,address ='$address' where member_id = '$member_id'");
             
                return response()->json([
                     'status' => 'success',
                     'message' => 'Data Fatch Successfully',
                 ],200);  

          }


          public function address_fatch(Request $request){
               $member_id=$request->header('member_id'); 

               $edit_value = Address::where('member_id', $member_id)->first();
            if ($edit_value) {
                return response()->json([
                   'status' => 200,
                   'edit_value' => $edit_value,
                ]);
            } else {
              return response()->json([
                  'status' => 404,
                  'message' => 'Student not found',
                ]);
           }

                
          }




 



  }
