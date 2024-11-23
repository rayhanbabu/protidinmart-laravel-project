<?php

namespace App\Http\Controllers\MemberAuth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\MemberJWTToken;
use App\Models\Member;
use Illuminate\Validation\Rules;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\Phonesms;

class MemberAuthController extends Controller
{

    public function login(Request $request)
     {
        try {

             $phone=$request->query("phone","");
             return view('memberauth.login',["phone"=>$phone]);
        } catch (Exception $e){
             return  view('errors.error', ['error' => $e]);
        }
     }


     public function login_verify(Request $request){
          $phone =$request->phone;
          $validator=\Validator::make($request->all(),[    
              'phone'=>'required',
            ]);

         if($validator->fails()){
            return response()->json([
              'status'=>'fail',
              'message'=>$validator->messages(),
           ]); 
         }else{
             //$rand=rand(1111,9999);
             $rand=1234;
             $date = date('Y-m-d');

             $data = Phonesms::create([
                'status' => 0,
                'verify_status' => 0,
                'phone' => $request->phone,
                'otp' => $rand, 
                'date' => $date, 
                'member_category' =>'Online'
             ]);

             Member::updateOrCreate(['phone' => $request->phone], ['phone'=>$request->phone,'otp'=>$rand]);

             return response()->json([
                   'status'=>'success',
                   'phone'=>$request->phone,
              ],200); 

         }
         
      }   



      public function login_insert(Request $request)
      {
           // Validate the input
           $request->validate([
               'code_phone' => ['required', 'max:255'],
               'otp' => ['required'],
           ]);

         $throttleKey = Str::lower($request->input('phone')) . '|' . $request->ip();
      
         if(RateLimiter::tooManyAttempts($throttleKey, 5)) {
                    throw ValidationException::withMessages([
                        'email' => ['Too many login attempts. Please try again in ' . RateLimiter::availableIn($throttleKey) . ' seconds.'],
                    ]);
         }
            
                // Retrieve member by email
    
                $member= Member::where('phone',$request->code_phone)->where('otp',$request->otp)->first();
                if (!$member) {
                    // Increment the throttle attempts if login fails
                    RateLimiter::hit($throttleKey);
                    return redirect('member/login?phone='.$request->code_phone)->with('fail','Invalid OPT.');
                  
                }
            
                // Reset the rate limiter on successful login
                RateLimiter::clear($throttleKey);
            
                $token_member = MemberJWTToken::CreateToken($member->phone, $member->id);
                Cookie::queue('token_member',$token_member, 60*24*30); //96 hour
      
                 $member_info = [
                    "name" => $member->name, "phone" => $member->phone, 
                 ];
                 $member_info_array = serialize($member_info);
                 Cookie::queue('member_info', $member_info_array, 60 * 24*30);
      
                 return redirect("/member/dashboard")->with('success', 'Logged in successfully!');
      }
   
  


   
      

    public function logout()
    {
        Cookie::queue('token_member', '', -1);
        Cookie::queue('member_info', '', -1);
        return redirect('member/login');
    }


    public function dashboard(Request $request){
          try {
                return redirect("/");
            } catch (Exception $e) {
                return  view('errors.error', ['error' => $e]);
            }
     }




}
