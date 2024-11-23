<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Brand;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpazilaController extends Controller
{
    public function upazila(Request $request){
      $district_id=$request->query('district_id','');
       if($district_id){
          if ($request->ajax()) {
               $data = DB::table('upazilas')->where('district_id',$district_id)->get();
               return Datatables::of($data)
                 ->addIndexColumn()
                 ->addColumn('status', function($row){
                      $statusBtn = $row->status == '1' ? 
                          '<button class="btn btn-success btn-sm">Active</button>' : 
                          '<button class="btn btn-secondary btn-sm" >Inactive</button>';
                      return $statusBtn;
                 })
                 ->addColumn('edit', function($row){
                       $btn = '<a href="/address/upazila/manage/'.$row->district_id.'/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                       return $btn;
                 })->addColumn('edit', function($row){
                      // Otherwise, return the Edit button
                      $btn = '<a href="/address/upazila/manage/'.$row->district_id.'/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                      return $btn;
                 })
                 ->addColumn('delete', function($row){
                    if ($row->privilege_status == 5) {
                        return null;
                    }else{
                       $btn = '<a href="/address/upazila/delete/'.$row->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="delete btn btn-danger btn-sm">Delete</a>';
                       return $btn;
                    }
                 })
                 ->rawColumns(['status','edit','delete'])
                 ->make(true);
           }

          }
          return view('address.upazila',['district_id'=>$district_id]);  
      }


     public function upazila_manage(Request $request, $district_id='', $id=''){
           
       $result['district']=DB::table('districts')->where('id',$district_id)->first(); 
          if($id>0){
                 $arr=DB::table('upazilas')->where(['id'=>$id])->get();
                 $result['id']=$arr['0']->id;
                 $result['name']=$arr['0']->name;
                 $result['bn_name']=$arr['0']->bn_name;
                 $result['status']=$arr['0']->status;
                 $result['district_id']=$arr['0']->district_id;
          }else{
                 $result['id']='';
                 $result['name']='';
                 $result['bn_name']='';
                 $result['status']='';
                 $result['district_id']='';
           }

            return view('address.upazila_manage',$result);  
        }


      public function upazila_insert(Request $request)
      {   
          if(!$request->input('id')){
              $request->validate([
                 'name' => 'required|unique:upazilas,name',
                 'bn_name' => 'required',
                 'status' => 'required',
               ]);
          }else{
              $request->validate([
                 'name' => 'required|unique:upazilas,name,'.$request->post('id'),
                 'bn_name' => 'required',
                 'status' => 'required',
              ]);
          }

         $user=Auth::user();
         $data=[
               'name' => $request->input('name'),
               'bn_name' => $request->input('bn_name'),
               'district_id' => $request->input('district_id'),
               'status' => $request->input('status'),
             ];

           if($request->post('id')>0){
                 DB::table('upazilas')->where('id',$request->post('id'))->update($data);
            }else{
                 DB::table('upazilas')->insert($data);
           }
           
        // Insert the data into the 'districts' table
       
         return redirect('/address/upazila?district_id='.$request->input('district_id'))->with('success', 'Changes saved successfully.');

      }


      public function upazila_delete(Request $request,$id){          
          $model=DB::table('upazilas')->where('id',$id)->first();
          if($model->privilege_status==5){
            return back()->with('fail','Data not deleted.');
          }else{
             DB::table('upazilas')->where('id', $id)->delete();
            return back()->with('success','Data deleted successfully.');
          }
         
       }

}
