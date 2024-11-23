<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Stock;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function stock(Request $request){
       if($request->ajax()){
            $data = Stock::leftjoin('products','products.id','=','stocks.product_id')
            ->select('products.product_name','stocks.*')->latest()->get();
             return Datatables::of($data)
               ->addIndexColumn()
                ->addColumn('status', function($row){
                  $statusBtn = $row->stock_status == '1' ? 
                      '<button class="btn btn-success btn-sm">Active</button>' : 
                      '<button class="btn btn-secondary btn-sm" >Inactive</button>';
                   return $statusBtn;
                })
                ->addColumn('edit', function($row){
                   $btn = '<a href="/admin/stock/manage/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                   return $btn;
               })              
               ->addColumn('delete', function($row){
                 $btn = '<a href="/admin/stock/delete/'.$row->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="delete btn btn-danger btn-sm">Delete</a>';
                 return $btn;
             })
               ->rawColumns(['status','edit','delete'])
               ->make(true);
           }
        return view('admin.stock');  
      }


      public function stock_manage(Request $request, $id=''){

        $result['product']=Product::where('product_status',1)->orderBy('product_name','asc')->get();
        if($id>0){
               $arr=Stock::where(['id'=>$id])->get();
               $result['id']=$arr['0']->id;
               $result['product_id']=$arr['0']->product_id;
               $result['qty']=$arr['0']->qty;
               $result['unit']=$arr['0']->unit;
               $result['per_amount']=$arr['0']->per_amount;
               $result['total_amount']=$arr['0']->total_amount;
               $result['comment']=$arr['0']->comment;
               $result['stock_status']=$arr['0']->stock_status;
          } else {
               $result['id']='';
               $result['product_id']='';
               $result['qty']='';
               $result['unit']='';
               $result['per_amount']='';
               $result['total_amount']='';
               $result['comment']='';
               $result['stock_status']='';
          }

            return view('admin.stock_manage',$result);  
        }

      public function stock_insert(Request $request)
      {
    
        if(!$request->input('id')){
              $request->validate([
                 'product_id' => 'required',
                 'unit' => 'required',
                 'qty' => 'required',
                 'per_amount' => 'required',
               ]);
        }else{
              $request->validate([
                 'product_id' => 'required',
                 'unit' => 'required',
                 'qty' => 'required',
                 'per_amount' => 'required',
              ]);
         }

        $user=Auth::user();
      if($request->post('id')>0){
          $model=Stock::find($request->post('id'));
          $model->updated_by=$user->id;
      }else{
           $model= new Stock; 
           $model->created_by=$user->id;
       }

         $date= date("Y-m-d");
         $year= date("Y");
         $month= date("m");
         $day= date("d");

         $total_amount=$request->input('qty')*$request->input('per_amount');


          $model->product_id=$request->input('product_id');
          $model->qty=$request->input('qty');
          $model->unit=$request->input('unit');
          $model->per_amount=$request->input('per_amount');
          $model->stock_status=$request->input('stock_status');
          $model->total_amount=$total_amount;
          $model->date = $date;
          $model->year = $year;
          $model->month = $month;
          $model->day = $day;
          $model->save();

         return redirect('/admin/stock')->with('success', 'Changes saved successfully.');

      }


      public function stock_delete(Request $request,$id){    
           $model=Stock::find($id);
           $model->delete();
           return back()->with('success', 'Data deleted successfully.');
       }

}
