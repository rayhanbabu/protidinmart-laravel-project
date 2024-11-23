@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('brand','active')
@section('homecontent')


<style>
 .codeform{
     display:none;
 }	
 .confirmpass{
   display:none;
 }

</style>

<div class="bg-gray-200 flex items-center justify-center min-h-[70vh]">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">

     <div class="emailform">
     <form method="post"  id="email_form"  class="myform"  enctype="multipart/form-data" >
           <div class="mb-4">
            <label
              for="email"
              class="block text-sm font-medium text-gray-700 mb-2"> Enter Your Email </label>
            <input
               type="email"
               id="email"
               name="email"
               placeholder="Enter your email address"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
               autocomplete="off" required
            />
          </div>
         

          <button
            type="submit" id="email_form_btn"
            class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-sm font-medium">
               Submit
            </button>
          
          </form>
     </div>


     <div class="codeform">

        <form  method="post" id="code_form" enctype="multipart/form-data">
            <div class="mb-4">
            <input type="hidden" name="email_id"  id="email_id" >

             <label
               for="email"
               class="block text-sm font-medium text-gray-700 mb-2"> Send OPT Code your Email </label>
             <input
                type="text"
                id="forget_code"
                name="forget_code"
                autocomplete="off"
                placeholder="Enter code within 7 minutes"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                autocomplete="off" required
            />
          </div>
         

             <button
                type="submit" id="email_code_btn"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-sm font-medium">
                 Submit
             </button>
          
            </form>

        </div>



    <div class="confirmpass">

    <form  method="post"  id="confirm_pass" enctype="multipart/form-data">

        <input type="hidden" name="email_id_pass"  id="email_id_pass">	
        <input type="hidden" name="forget_code_id"  id="forget_code_id">	

    <div class="mb-4">
     <label
       for="password" id="confirmpass_btn"
       class="block text-sm font-medium text-gray-700 mb-2"> New Password </label>
      <input
         type="text"
         id="npass"
         name="npass"
         autocomplete="off"
         placeholder="New Password"
         class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
         autocomplete="off" required
        />
  </div>


  <div class="mb-4">
     <label
       for="password"
       class="block text-sm font-medium text-gray-700 mb-2"> Confirm Password </label>
      <input
         type="text"
         id="cpass"
         name="cpass"
         autocomplete="off"
         placeholder="New Password"
         class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
         autocomplete="off" required
        />
  </div>
 
 

     <button
        type="submit" 
        class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-sm font-medium">
         Submit
     </button>
  
    </form>
    
   </div>



      </div>
    </div>


    <script src="{{ asset('js/forget.js') }}"></script>

@endsection