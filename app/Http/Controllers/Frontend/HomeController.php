<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{

        public function home(Request $request){
                $product = Product::where('product_status',1)
                 ->where('show_category','Top')->orderBy('serial','asc')->get(); 

               $slider = Slider::where('slider_status',5)->orderBy('serial','asc')->get(); 
                    // $response = Http::get(baseURL().'/page/NewsEvent');
                   // if($response['status']=="success"){
                  //      return $response['data'];
                 //  };            
                 return view('frontend.home',['product'=>$product,'slider'=>$slider]);  
        }


        public function category_detail(Request $request){
            $category_id=$request->category_id;
            $category=Category::where('id', $category_id)->first();
            $category_product = Product::where('category_id',$category_id)->orderBy('serial','asc')->get(); 
            $product = Product::where('product_status',1)
            ->where('show_category','Top')->orderBy('serial','asc')->get(); 
            return view('frontend.category_product',['category_product'=>$category_product,'category'=>$category,'product'=>$product]);  
        }


         public function product_detail(Request $request){
              $product_id=$request->product_id;
              $product = Product::find($product_id); 
              $product_all = Product::where('product_status',1)
              ->where('show_category','Top')->orderBy('serial','asc')->get(); 
              $product_slider=Slider::where('product_id',$product_id)->orderBy('serial','asc')->get();
              return view('frontend.product_detail',['product'=>$product,'product_slider'=>$product_slider,'product_all'=>$product_all]);  
         }


          public function product_search(Request $request){   
                $search=$request->query('search','');
                $search_product = Product::where('product_name', 'like', '%' . $search . '%')->orderBy('serial','asc')->get(); 
                return view('frontend.product_search',['search_product'=>$search_product]);    
          }
      

         public function user_login(Request $request){
             return view('frontend.login');  
         }


        public function order_history(Request $request){        
              $member_id=$request->header('member_id'); 
              $order=Order::where('member_id',$member_id)->orderBy('id','desc')->get();
              //   return $order;
              //   die();

            return view('frontend.order_history',['order'=>$order]);  
        }


        public function order_track(Request $request,$order_id){        
            $member_id=$request->header('member_id'); 
            $order=Order::where('member_id',$member_id)->where('id',$order_id)->orderBy('id','desc')->first();
            return view('frontend.order_track',['order'=>$order]);  
        }


        public function contact_add(Request $request){        
          
             $validator = \Validator::make(
                 $request->all(),
                   [
                     'name'=> 'required',
                     'email'=>'required',
                     'phone'=>'required',
                     'subject'=>'required',
                     'message'=>'required'
                   ]);
   
           if ($validator->fails()) {
               return response()->json([
                   'status' =>'fail',
                   'message' => 'All fields are required',
               ]);
             } else {
                
                  $model = new Contact;
                  $model->name = $request->input('name');
                  $model->phone = $request->input('phone');
                  $model->email = $request->input('email');
                  $model->subject = $request->input('subject');
                  $model->message = $request->input('message');
                  $model->save();
    
                  return response()->json([
                     'status' => 'success',
                     'message' => 'Form submitted successfully',
                   ]);
              }
        
        }




}
