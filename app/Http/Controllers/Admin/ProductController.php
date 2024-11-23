<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function product(Request $request){

        if ($request->ajax()){
             $data = Product::leftjoin('brands','brands.id','=','products.brand_id')
             ->leftjoin('categories','categories.id','=','products.category_id')
             ->select('brands.brand_name','categories.category_name','products.*')->latest()->get();
             return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row){
                  $imageUrl = asset('uploads/admin/'.$row->image); // Assuming 'image' is the field name in the database
                  return '<img src="'.$imageUrl.'" alt="Image" style="width: 50px; height: 50px;"/>';
                })
                 ->addColumn('status', function($row){
                    $statusBtn = $row->product_status == '1' ? 
                      '<button class="btn btn-success btn-sm">Active</button>' : 
                      '<button class="btn btn-secondary btn-sm" >Inactive</button>';
                   return $statusBtn;
                })
                 ->addColumn('slider', function($row){
                   $btn = '<a href="/admin/slider/'.$row->id.'" class="edit btn btn-primary btn-sm">Slider</a>';
                   return $btn;
                })
                ->addColumn('edit', function($row){
                    $btn = '<a href="/admin/product/manage/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                    return $btn;
                })
                 ->addColumn('delete', function($row){
                    $btn = '<a href="/admin/product/delete/'.$row->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['image','slider','status','edit','delete'])
                ->make(true);
            }
          return view('admin.product');  
      }


      public function product_manage(Request $request, $id=''){   
           $result['brand']=DB::table('brands')->orderBy('brand_name','asc')->get();
           $result['category']=DB::table('categories')->orderBy('category_name','asc')->get();
           if($id>0){
               $arr=Product::where(['id'=>$id])->get();
               $result['id']=$arr['0']->id;
               $result['brand_id']=$arr['0']->brand_id;
               $result['category_id']=$arr['0']->category_id;
               $result['product_name']=$arr['0']->product_name;
               $result['product_status']=$arr['0']->product_status;   
               $result['product_slug']=$arr['0']->product_slug;  
               $result['amount']=$arr['0']->amount; 
               $result['serial']=$arr['0']->serial;  
               $result['desc']=$arr['0']->desc;   
               $result['image']=$arr['0']->image; 
               $result['show_category']=$arr['0']->show_category; 
               $result['size_show']=$arr['0']->size_show; 
               $result['approximate_amount']=$arr['0']->approximate_amount;              
          } else {
              $result['id']='';
              $result['product_name']='';
              $result['product_status']='';
              $result['brand_id']='';
              $result['category_id']='';
              $result['product_slug']=''; 
              $result['amount']=''; 
              $result['serial']='';  
              $result['desc']='';   
              $result['image']=''; 
              $result['show_category']='';
              $result['size_show']=''; 
              $result['approximate_amount']='';       

          }

            return view('admin.product_manage',$result);  
        }

      public function product_insert(Request $request)
      {
        if(!$request->input('id')){
              $request->validate([ 
                 'product_name' => 'required|unique:products,product_name',
                 'product_status' => 'required',
                 'brand_id' => 'required',
                 'category_id' => 'required',
                 'image' => 'required|image|mimes:jpeg,png,jpg|max:400',
               ]);
          }else{
              $request->validate([
                 'product_name' => 'required|unique:products,product_name,'.$request->post('id'),
                 'product_status' => 'required',
                 'brand_id' => 'required',
                 'category_id' => 'required',
                 'image'=> 'image|mimes:jpeg,png,jpg|max:400',
              ]);
          }

          $user=Auth::user();
       if($request->post('id')>0){
           $model=Product::find($request->post('id'));
           $model->updated_by=$user->id;
            
           if ($request->hasfile('image')) {
                 $imgfile = 'booking-';
                 $path = public_path('uploads/admin') . '/' . $model->image;
                  if (File::exists($path)) {
                    File::delete($path);
                  }
                 $image = $request->file('image');
                 $new_name = $imgfile . rand() . '.' . $image->getClientOriginalExtension();
                 $image->move(public_path('uploads/admin'), $new_name);
                 $model->image = $new_name;
           }
      }else{
            $model= new Product; 
            $model->created_by=$user->id;

            if ($request->hasfile('image')) {
                $imgfile = 'booking-';
                $image = $request->file('image');
                $new_name = $imgfile . rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/admin'), $new_name);
                $model->image = $new_name;   
            }
        }

           $model->product_name=$request->input('product_name');
           $model->brand_id=$request->input('brand_id');
           $model->category_id=$request->input('category_id');
           $model->product_status=$request->input('product_status');
           $model->product_slug=Str::slug($request->input('product_name'));
           $model->amount=$request->input('amount');
           $model->desc=$request->input('desc');
           $model->serial=$request->input('serial',0);  
           $model->show_category=$request->input('show_category');   
           $model->size_show=$request->input('size_show');
           $model->approximate_amount=$request->input('approximate_amount');       
           $model->save();

          return redirect('/admin/product')->with('success', 'Changes saved successfully.');

      }


         public function product_delete(Request $request,$id){  
          $model = Product::find($id);
          $filePath = public_path('uploads/admin') . '/' . $model->image;
          if (File::exists($filePath)) {
              File::delete($filePath);
          }
          $model->delete();
              return back()->with('success', 'Data deleted successfully.');
          }

    }
