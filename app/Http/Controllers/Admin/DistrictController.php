<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Brand;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    public function district(Request $request){
        if ($request->ajax()) {
              $data = DB::table('districts')->get();
              return Datatables::of($data)
                 ->addIndexColumn()
                 ->addColumn('status', function($row){
                      $statusBtn = $row->status == '1' ? 
                        '<button class="btn btn-success btn-sm">Active</button>' : 
                         '<button class="btn btn-secondary btn-sm" >Inactive</button>';
                      return $statusBtn;
                })
                 ->addColumn('edit', function($row){
                   $btn = '<a href="/address/district/manage/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                   return $btn;
                 })->addColumn('edit', function($row){
                      // Otherwise, return the Edit button
                      $btn = '<a href="/address/district/manage/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                      return $btn;
              })
                 ->addColumn('delete', function($row){
                    if ($row->privilege_status == 5) {
                        return null;
                    }else{
                       $btn = '<a href="/address/district/delete/'.$row->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="delete btn btn-danger btn-sm">Delete</a>';
                       return $btn;
                    }
                 })
                 ->rawColumns(['status','edit','delete'])
                 ->make(true);
             }
          return view('address.district');  
      }


      public function district_manage(Request $request, $id=''){
           if($id>0){
               $arr=DB::table('districts')->where(['id'=>$id])->get();
               $result['id']=$arr['0']->id;
               $result['name']=$arr['0']->name;
               $result['bn_name']=$arr['0']->bn_name;
               $result['status']=$arr['0']->status;
               $result['amount']=$arr['0']->amount;
          }else{
               $result['id']='';
               $result['name']='';
               $result['bn_name']='';
               $result['status']='';
               $result['amount']='';
          }

            return view('address.district_manage',$result);  
        }


      public function district_insert(Request $request)
      {   
          if(!$request->input('id')){
              $request->validate([
                 'name' => 'required|unique:districts,name',
                 'bn_name' => 'required',
                 'status' => 'required',
               ]);
          }else{
              $request->validate([
                 'name' => 'required|unique:districts,name,'.$request->post('id'),
                 'bn_name' => 'required',
                 'status' => 'required',
              ]);
          }

           $user=Auth::user();
           $data = [
            'name' => $request->input('name'),
            'bn_name' => $request->input('bn_name'),
            'amount' => $request->input('amount'),
            'status' => $request->input('status'),
            'division_id' => 1,
          ];


            if($request->post('id')>0){
                DB::table('districts')->where('id',$request->post('id'))->update($data);
            }else{
               DB::table('districts')->insert($data);
            } 
            
        // Insert the data into the 'districts' table
       
         return redirect('/address/district')->with('success', 'Changes saved successfully.');

      }


      public function brand_delete(Request $request,$id){          
         $model=Brand::find($id);
         $model->delete();
         return back()->with('success','Data deleted successfully.');

       }

}
