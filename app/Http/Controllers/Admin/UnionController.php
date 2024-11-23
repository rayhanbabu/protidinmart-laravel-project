<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Brand;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UnionController extends Controller
{
    public function union(Request $request){
      $upazila_id=$request->query('upazila_id','');
       if($upazila_id){
          if ($request->ajax()) {
               $data = DB::table('unions')->where('upazila_id',$upazila_id)->get();
               return Datatables::of($data)
                 ->addIndexColumn()
                 ->addColumn('status', function($row){
                      $statusBtn = $row->status == '1' ? 
                          '<button class="btn btn-success btn-sm">Active</button>' : 
                          '<button class="btn btn-secondary btn-sm" >Inactive</button>';
                      return $statusBtn;
                 })
                 ->addColumn('edit', function($row){
                       $btn = '<a href="/address/union/manage/'.$row->upazila_id.'/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                       return $btn;
                 })->addColumn('edit', function($row){
                      // Otherwise, return the Edit button
                      $btn = '<a href="/address/union/manage/'.$row->upazila_id.'/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                      return $btn;
                 })
                 ->addColumn('delete', function($row){
                    if ($row->privilege_status == 5) {
                        return null;
                    }else{
                       $btn = '<a href="/address/union/delete/'.$row->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="delete btn btn-danger btn-sm">Delete</a>';
                       return $btn;
                    }
                 })
                 ->rawColumns(['status','edit','delete'])
                 ->make(true);
           }

          }

          return view('address.union',['upazila_id'=>$upazila_id]);  
      }


     public function union_manage(Request $request, $upazila_id='', $id=''){
           
       $result['upazila']=DB::table('upazilas')->where('id',$upazila_id)->first(); 
       if($id>0){
                 $arr=DB::table('unions')->where(['id'=>$id])->get();
                 $result['id']=$arr['0']->id;
                 $result['name']=$arr['0']->name;
                 $result['bn_name']=$arr['0']->bn_name;
                 $result['status']=$arr['0']->status;
          }else{
                 $result['id']='';
                 $result['name']='';
                 $result['bn_name']='';
                 $result['status']='';
           }

            return view('address.union_manage',$result);  
        }


      public function union_insert(Request $request)
      {   
          if(!$request->input('id')){
              $request->validate([
                 'name' => 'required|unique:unions,name',
                 'bn_name' => 'required',
                 'status' => 'required',
               ]);
          }else{
              $request->validate([
                 'name' => 'required|unique:unions,name,'.$request->post('id'),
                 'bn_name' => 'required',
                 'status' => 'required',
              ]);
          }

            $data = [
              'name' => $request->input('name'),
              'bn_name' => $request->input('bn_name'),
              'upazila_id' => $request->input('upazila_id'),
              'status' => $request->input('status'),
            ];

            if($request->post('id')>0){
                DB::table('unions')->where('id',$request->post('id'))->update($data);
            }else{
               DB::table('unions')->insert($data);
            }
         
            
        // Insert the data into the 'districts' table
       
         return redirect('/address/union?upazila_id='.$request->input('upazila_id'))->with('success', 'Changes saved successfully.');

      }


      public function union_delete(Request $request,$id){          
          $model=DB::table('unions')->where('id',$id)->first();
          if($model->privilege_status==5){
            return back()->with('fail','Data not deleted.');
          }else{
             DB::table('unions')->where('id', $id)->delete();
            return back()->with('success','Data deleted successfully.');
          }
         
       }

}
