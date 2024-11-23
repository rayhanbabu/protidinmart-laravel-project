<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Contact;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function contact(Request $request){
        if ($request->ajax()) {
             $data = Contact::latest()->get();
             return Datatables::of($data)
                 ->addIndexColumn()
                 ->addColumn('status', function($row){
                    $statusBtn = $row->contact_status == '1' ? 
                        '<button class="btn btn-success btn-sm">Active</button>' : 
                        '<button class="btn btn-secondary btn-sm">Inactive</button>';
                     return $statusBtn;
                 })
                  ->addColumn('edit', function($row){
                   $btn = '<a href="/admin/contact/manage/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                   return $btn;
                })
                ->addColumn('delete', function($row){
                  $btn = '<a href="/admin/contact/delete/'.$row->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="delete btn btn-danger btn-sm">Delete</a>';
                  return $btn;
              })
               ->rawColumns(['status','edit','delete'])
               ->make(true);
            }
          return view('admin.contact');  
      }


      public function contact_manage(Request $request, $id=''){
           if($id>0){
               $arr=Contact::where(['id'=>$id])->get();
               $result['id']=$arr['0']->id;
               $result['name']=$arr['0']->name;
               $result['email']=$arr['0']->email;
               $result['subject']=$arr['0']->subject;
               $result['message']=$arr['0']->message;
               $result['contact_status']=$arr['0']->contact_status;
          } else {
              $result['id']='';
              $result['name']='';
              $result['email']='';
              $result['subject']='';
              $result['message']='';
              $result['contact_status']='';
          }

            return view('admin.contact_manage',$result);  
        }

      public function contact_insert(Request $request)
      {
    
          if(!$request->input('id')){
              $request->validate([
                 'name' => 'required',
                 'contact_status' => 'required',
               ]);
          }else{
              $request->validate([
                 'name' => 'required',
                 'contact_status' => 'required',
              ]);
          }

          $user=Auth::user();
        if($request->post('id')>0){
            $model=Contact::find($request->post('id'));
        }else{
            $model= new Contact; 
         }
         $model->name=$request->input('name');
         $model->email=$request->input('email');
         $model->subject=$request->input('subject');
         $model->message=$request->input('message');
         $model->contact_status=$request->input('contact_status');
         $model->save();

         return redirect('/admin/contact')->with('success', 'Changes saved successfully.');

      }


      public function contact_delete(Request $request,$id){          
         $model=Contact::find($id);
         $model->delete();
         return back()->with('success','Data deleted successfully.');

       }

}
