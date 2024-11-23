<?php
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Mail;
    use App\Models\Appointment;
    use App\Models\Category;
    use Illuminate\Support\Facades\Cookie;
    use App\Models\Medicine;
    use App\Models\Order;
    use App\Models\Orderproduct;
 
        function prx($arr){
            echo "<pre>";
            print_r($arr);
            die();
         }

         function baseUrl(){
             $baseURL="https://dumedical.amaderthikana.com/api";
             return $baseURL;
         }
         

       function SendEmail($email,$subject,$body,$otp,$name){
           $details = [
              'subject' => $subject,
              'otp_code'=> $otp,
                 'body' => $body,
                 'name' => $name,
            ];                
        Mail::to($email)->send(new \App\Mail\LoginMail($details));
    }


       function member_info(){
        $member_info=Cookie::get('member_info');
        $result=unserialize($member_info);
        return $result;
    }


       

      function getMinutesBetween2Dates(DateTime $date1, DateTime $date2, $absolute = true) {
          $interval = $date2->diff($date1);
          $minutes = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;
          return (!$absolute and $interval->invert) ? -$minutes : $minutes;
      }

       function getYearsBetween2Dates(DateTime $date1, DateTime $date2, $absolute = true) {
           $interval = $date2->diff($date1);
           $years = $interval->y;
           return (!$absolute && $interval->invert) ? -$years : $years;
       }

        function category(){
            $data = Category::where('category_status',1)->orderBy('serial','asc')->get();
            return $data;
        }

        function district(){
           $data = DB::table('districts')->orderBy('name','asc')->get();
           return $data;
        }

        function upazila(){
          $data = DB::table('upazilas')->orderBy('name','asc')->get();
          return $data;
       }

       function union(){
        $data = DB::table('unions')->orderBy('name','asc')->get();
        return $data;
     }

     function order_count($status){
         $data = Order::where('status',$status)->get();
         return $data;
     }
     
      function product_detail($order_id){
          //Example logic, you can modify this to suit your needs
          $order_detail=Orderproduct::leftjoin('products','products.id','=','orderproducts.product_id')
          ->where('order_id',$order_id)
          ->select('products.image','orderproducts.*')->get();
          return $order_detail;
       }

    



   ?>
