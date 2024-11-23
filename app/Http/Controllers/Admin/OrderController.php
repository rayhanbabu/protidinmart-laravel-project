<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Order;
use App\Models\Orderproduct;
use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{
    public function order(Request $request){
         
        $status=$request->status;
        if($request->ajax()){  

          if($status=="All"){
               $data = Order::latest()->get();
           }else{
               $data = Order::where('status',$status)->latest()->get();
           }

           $results = $data->map(function($order){
              return [
                 'id' => $order->id,
                 'total_amount' => $order->total_amount,
                 'shipping_amount' => $order->shipping_amount,
                 'discount_amount' => $order->discount_amount,
                 'net_amount' => $order->net_amount,
                 'comment' => $order->comment,
                 'status' => $order->status,
                 'created_at' => $order->created_at,
                 'product_detail' => product_detail($order->id), // Call the function here
              ];
        });

          Log::info("rayhan...");
        //   return $results;
        //   die();

            return Datatables::of($results)
             ->addIndexColumn()
             ->addColumn('product_detail', function($results) {
                $details = '';
                 foreach ($results['product_detail'] as $product) {
                       // Concatenate product name and quantity
                        $details .= $product['product_name'] . ' (Qty: ' . $product['qty'] . ', Price: ' . $product['per_amount'] . ')<br>';
                   }
                    return $details;  // Returning as an HTML string
             })
             ->addColumn('order_status', function($row) {
                // Define the status button based on the status value
               switch ($row['status']){
                 case 'PROCESSING':
                      $statusBtn = '<button class="btn btn-warning btn-sm">Processing</button>';
                      break;
                 case 'APPROVED':
                     $statusBtn = '<button class="btn btn-info btn-sm">Approved</button>';
                     break;
                 case 'ON_SHIPPING':
                      $statusBtn = '<button class="btn btn-primary btn-sm">On Shipping</button>';
                      break;
                 case 'SHIPPED':
                     $statusBtn = '<button class="btn btn-secondary btn-sm">Shipped</button>';
                     break;
                 case 'COMPLETED':
                       $statusBtn = '<button class="btn btn-success btn-sm">Completed</button>';
                       break;
                 case 'CANCELLED':
                       $statusBtn = '<button class="btn btn-danger btn-sm">Cancelled</button>';
                       break;
                 case 'RETURNED':
                       $statusBtn = '<button class="btn btn-dark btn-sm">Returned</button>';
                       break;
                  default:
                      $statusBtn = '<button class="btn btn-secondary btn-sm">PENDING</button>';
                      break;
              }   
             return $statusBtn;
        })
        ->addColumn('edit', function($row){
             $btn = '<a href="javascript:void(0);" data-id="' . $row['id'] . '" class="edit btn btn-primary btn-sm">Edit</a>';
             return $btn;
        })
         ->addColumn('delete', function($row){
             $btn = '<a href="javascript:void(0);" data-id="' . $row['id'] . '" class="delete btn btn-danger btn-sm">Delete</a>';
             return $btn;
         })
           ->rawColumns(['product_detail','order_status','edit','delete'])
           ->make(true);
        }

          return view('admin.order',['status'=>$status]);  
      }


      public function order_edit(Request $request)
        {
          $id = $request->id;
          $data = Order::find($id);
            return response()->json([
                'status' => 200,
                'value' => $data,
            ]);
         }
  
  
      public function update(Request $request){

            // $user=Auth::user();
            $validator = \Validator::make($request->all(), [
                'status' => 'required', 
             ]);
  
          if($validator->fails()) {
               return response()->json([
                    'status' => 400,
                    'message' => $validator->messages(),
                ]);
           } else {
                $model = Order::find($request->input('edit_id'));
              if ($model) {
                 $status=$request->input('status');
                 $time= date('Y-m-d H:i:s');
                 if($status=="PROCESSING"){
                      $model->processing_at =$time;
                 }else if($status=="APPROVED"){
                      $model->approved_at =$time; 
                 }else if($status=="ON_SHIPPING"){
                      $model->on_shipping_at =$time; 
                 }else if($status=="SHIPPED"){
                      $model->shipped_at =$time; 
                 }else if($status=="COMPLETED"){
                      $model->completed_at =$time; 
                 } else if($status=="CANCELLED"){
                       $model->cancelled_at =$time; 
                 }else if($status=="RETURNED"){
                       $model->refunded_at =$time; 
                  }
                
                 $model->status = $status;
                 $model->comment = $request->input('comment');
                 $model->update();
                    return response()->json([
                      'status' => 200,
                      'message' => 'Data Updated Successfully'
                     ]);
               } else {
                   return response()->json([
                       'status' => 404,
                       'message' => 'Student not found',
                   ]);
               }
           }
      }
  

    //   public function delete(Request $request)
    //   {
    //       $model = Member::find($request->input('id'));
    //       $filePath = public_path('uploads/admin') . '/' . $model->image;
    //       if (File::exists($filePath)) {
    //           File::delete($filePath);
    //       }
    //       $model->delete();
    //       return response()->json([
    //           'status' => 200,
    //           'message' => 'Data Deleted Successfully',
    //       ]);
  
    //       // }
    //   }
  
     

}
