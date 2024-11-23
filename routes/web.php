<?php

use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\MemberAuth\MemberAuthController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Admin\UpazilaController;
use App\Http\Controllers\Admin\UnionController;
use App\Http\Controllers\Admin\ContactController;
 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

         Route::get('sale_type/{sale_type}',function($sale_type){
               Session::put('sale_type',$sale_type);
               return redirect()->back();
         });

      //  Route::get('/', function () {
      //  return view('welcome');
      //  });

   Route::middleware('WebgestMiddleware')->group(function(){
       Route::get('/', [HomeController::class, 'home']);
       Route::get('/category/{category_id}',[HomeController::class, 'category_detail']);
       Route::get('/product_detail/{product_id}',[HomeController::class, 'product_detail']);

       Route::get('/product_search',[HomeController::class, 'product_search']);

       Route::post('/contact_add', [HomeController::class,'contact_add']);
      
       Route::get('/forget_password', [ProfileController::class,'forget_password']);
       Route::post('/forget_password_send', [ProfileController::class,'forget_password_send']);
       Route::get('/reset_password/{token}', [ProfileController::class,'reset_password']);
       Route::post('/reset_password_update', [ProfileController::class,'reset_password_update']);
     
      });

       Route::middleware('auth')->group(function () {
              Route::get('/admin/dashboard', [AdminController::class,'index']);
              Route::get('admin/logout', [AuthenticatedSessionController::class, 'destroy']);

              Route::get('/password_change', [ProfileController::class,'password_change']);
              Route::post('/password_update', [ProfileController::class,'password_update']); 
        });


         //admin route
         Route::middleware('AdminMiddleware')->group(function (){
          
            //role Access
            Route::get('/admin/role_access', [AdminController::class,'role_access']);
            Route::get('/admin/role_access/manage', [AdminController::class,'role_access_manage']);
            Route::get('/admin/role_access/manage/{id}', [AdminController::class,'role_access_manage']);
            Route::post('/admin/role_access/insert', [AdminController::class,'role_access_insert']);
            Route::get('/admin/role_access/delete/{id}', [AdminController::class,'role_access_delete']);
               
            //brand 
            Route::get('/admin/brand', [BrandController::class,'brand']);
            Route::get('/admin/brand/manage', [BrandController::class,'brand_manage']);
            Route::get('/admin/brand/manage/{id}', [BrandController::class,'brand_manage']);
            Route::post('/admin/brand/insert', [BrandController::class,'brand_insert']);
            Route::get('/admin/brand/delete/{id}', [BrandController::class,'brand_delete']); 
  
            //Stock 
            Route::get('/admin/stock', [StockController::class,'stock']);
            Route::get('/admin/stock/manage', [StockController::class,'stock_manage']);
            Route::get('/admin/stock/manage/{id}', [StockController::class,'stock_manage']);
            Route::post('/admin/stock/insert', [StockController::class,'stock_insert']);
            Route::get('/admin/stock/delete/{id}', [StockController::class,'stock_delete']);
        
            //category 
            Route::get('/admin/category', [CategoryController::class,'category']);
            Route::get('/admin/category/manage', [CategoryController::class,'category_manage']);
            Route::get('/admin/category/manage/{id}', [CategoryController::class,'category_manage']);
            Route::post('/admin/category/insert', [CategoryController::class,'category_insert']);
            Route::get('/admin/category/delete/{id}', [CategoryController::class,'category_delete']);

             // product 
            Route::get('/admin/product', [ProductController::class,'product']);
            Route::get('/admin/product/manage', [ProductController::class,'product_manage']);
            Route::get('/admin/product/manage/{id}', [ProductController::class,'product_manage']);
            Route::post('/admin/product/insert', [ProductController::class,'product_insert']);
            Route::get('/admin/product/delete/{id}', [ProductController::class,'product_delete']);

             // Slider 
            Route::get('/admin/slider/{product_id}', [SliderController::class,'slider']);
            Route::get('/admin/slider/manage/{product_id}', [SliderController::class,'slider_manage']);
            Route::get('/admin/slider/manage/{product_id}/{id}', [SliderController::class,'slider_manage']);
            Route::post('/admin/slider/insert', [SliderController::class,'slider_insert']);
            Route::get('/admin/slider/delete/{id}', [SliderController::class,'slider_delete']);

             // Member  
            Route::get('/admin/member',[MemberController::class,'member']);
            Route::post('/admin/member/insert',[MemberController::class,'store']);
            Route::get('/admin/member_view/{id}',[MemberController::class,'edit']);
            Route::post('/admin/member/update',[MemberController::class,'update']);
            Route::delete('/admin/member/delete',[MemberController::class,'delete']);

            // Order details
            Route::get('/admin/order/{status}',[OrderController::class,'order']);
            Route::get('/admin/order_view/{id}',[OrderController::class,'order_edit']);
            Route::post('/admin/order/update',[OrderController::class,'update']);

            // Address District / City 
            Route::get('/address/district',[DistrictController::class,'district']);
            Route::get('/address/district/manage',[DistrictController::class,'district_manage']);
            Route::get('/address/district/manage/{id}',[DistrictController::class,'district_manage']);
            Route::post('/address/district/insert', [DistrictController::class,'district_insert']);
            Route::get('/address/district/delete/{id}',[DistrictController::class,'district_delete']); 


             // Address upazila / Area 
             Route::get('/address/upazila',[UpazilaController::class,'upazila']);
             Route::get('/address/upazila/manage/{district_id}',[UpazilaController::class,'upazila_manage']);
             Route::get('/address/upazila/manage/{district_id}/{id}',[UpazilaController::class,'upazila_manage']);
             Route::post('/address/upazila/insert', [UpazilaController::class,'upazila_insert']);
             Route::get('/address/upazila/delete/{id}',[UpazilaController::class,'upazila_delete']); 

              // Address union / Area 
              Route::get('/address/union',[UnionController::class,'union']);
              Route::get('/address/union/manage/{upazila_id}',[UnionController::class,'union_manage']);
              Route::get('/address/union/manage/{upazila_id}/{id}',[UnionController::class,'union_manage']);
              Route::post('/address/union/insert', [UnionController::class,'union_insert']);
              Route::get('/address/union/delete/{id}',[UnionController::class,'union_delete']);       
       
              //Message 
              Route::get('/admin/contact', [ContactController::class,'contact']);
              Route::get('/admin/contact/manage', [ContactController::class,'contact_manage']);
              Route::get('/admin/contact/manage/{id}', [ContactController::class,'contact_manage']);
              Route::post('/admin/contact/insert', [ContactController::class,'contact_insert']);
              Route::get('/admin/contact/delete/{id}', [ContactController::class,'contact_delete']); 
             
            });

        //Member login
        Route::get('/member/login',[MemberAuthController::class,'login'])->middleware('MemberTokenExist');
        Route::get('/member/register',[MemberAuthController::class,'register'])->middleware('MemberTokenExist');
        Route::post('/member/register_insert',[MemberAuthController::class,'register_insert']);
        Route::get('/email_verify/{emailmd5}',[MemberAuthController::class,'email_verify']);

        Route::post('/member/login_verify',[MemberAuthController::class,'login_verify']);
        Route::post('/member/login_insert',[MemberAuthController::class,'login_insert']);
  
        Route::get('member/forget',[MemberAuthController::class,'member_forget']);
        Route::post('member/forget',[MemberAuthController::class,'forgetemail']); 
        Route::post('member/forgetcode',[MemberAuthController::class,'forgetcode']); 
        Route::post('member/confirmpass',[MemberAuthController::class,'confirmpass']);
    
        Route::middleware('MemberToken')->group(function(){

              Route::get('/member/logout',[MemberAuthController::class,'logout']);
              Route::get('/member/dashboard',[MemberAuthController::class,'dashboard']);

              Route::post('/add_to_cart',[CartController::class,'add_to_cart']);
              Route::get('/cart_product_count',[CartController::class,'cart_product_count']);
              Route::get('/cart-details',[CartController::class,'cart_details']);
              Route::get('/cart-details-fetch',[CartController::class,'cart_detail_fatch']);
              Route::post('/cart-delete-item',[CartController::class,'cart_delete_item']);
              Route::post('/cart-update-quantity',[CartController::class,'cart_update_quantity']);
              Route::get('/check_out_count',[CartController::class,'check_out_count']);

              //Address information
              Route::get('/upazila_id_fetch', [CheckoutController::class,'upazila_id_fetch']);
              Route::get('/union_id_fetch', [CheckoutController::class,'union_id_fetch']);
               
              Route::get('/address_edit',[CartController::class,'address_edit']);
              Route::get('/address_fatch',[CartController::class,'address_fatch']);
              Route::post('/address_update',[CartController::class,'address_update']);

              Route::get('/checkout', [CheckoutController::class,'checkout']);
              Route::post('/confirm_order', [CheckoutController::class,'confirm_order']);

              Route::get('/order_history', [HomeController::class, 'order_history']);
              Route::get('/order_track/{order_id}', [HomeController::class, 'order_track']);
         

              //profile Infromation  
              Route::get('/member/profile', [ProfileController::class,'profile']);
              Route::post('/member/profile_update', [ProfileController::class,'profile_update']);


         });  

    
    

  require __DIR__.'/auth.php';
