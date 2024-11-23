@extends('layouts/frontendheader')
@section('content')


   <br>



    <div class="bg-gray-200 flex items-center justify-center min-h-[60vh]">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-900"> LOGIN / SIGNUP </h2>

                     <div class="form-group  mx-3 my-3">
                           @if(Session::has('fail'))
                             <div class="alert alert-danger" style="color: white; background-color: #fa84f0; padding:   10px; border-radius: 5px;">
                                 {{ Session::get('fail') }}
                      </div>

                                @endif
                             </div>
      @if(empty($phone))
    <style>
    .codeform{
      display:none;
     }	
   </style>

      <div class="phoneform">
        <form method="post"  id="phone_form"  class="myform"  enctype="multipart/form-data" >
          <div class="mb-4">
            <label
              for="phone"
              class="block text-sm font-medium text-gray-700 mb-2"
              > Phone Number </label
            >
            <input
              type="text"
              id="phone"
              name="phone"
              placeholder="Enter 11 Digit Phone Number."
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              pattern="[0][1][3 4 7 6 5 8 9][0-9]{8}" title="Please select Valid mobile number" 
            />
            <p class="text-danger error_phone" style="color: red;"></p>

          </div>

          <button
            type="submit" id="phone_form_btn"
            class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-sm font-medium"
          >
            Next
          </button>

        </form>
    </div>

  @endif

    
    <div class="codeform">      
        <form method="post" action="{{ url('member/login_insert') }}" class="myform"  enctype="multipart/form-data" >
        @csrf
          <div class="mb-4">
            <label for="phone"
              class="block text-sm font-medium text-gray-700 mb-2"> Phone Number </label>
            <input
              type="text"
              id="code_phone"
              name="code_phone"  value="{{$phone}}"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              pattern="[0][1][3 4 7 6 5 8 9][0-9]{8}" title="Please select Valid mobile number" readonly
            />
          </div>



          <div class="mb-4">
            <label for="phone"
              class="block text-sm font-medium text-gray-700 mb-2"> OTP  </label>
            <input
              type="text"
              id="otp"
              name="otp"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              placeholder="OTP sent to your phone. Please enter OTP." />
          </div>

          <button
            type="submit"
            class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-sm font-medium"
          >
              Submit
          </button>

        </form>
    </div>




      </div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>

      <br>
@endsection
