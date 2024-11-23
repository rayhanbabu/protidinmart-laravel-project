@extends('layouts/frontendheader')
@section('content')

<section class="w-full py-10">

<form  method="POST" id="edit_address_form" enctype="multipart/form-data">
      <div class="max-w-screen-lg mx-auto px-2 flex flex-wrap ">
        <!-- Left Side: Shipping Address and Payment Method -->
        <div class="w-full lg:w-2/3 mb-8 lg:mb-0 ">
          <!-- Shipping Address Section -->

      
          <div class="mb-12 border shadow mt-3 bg-white  pb-3 rounded">
            <h2 class="text-xl p-3 font-semibold mb-4 border-b bg-[#e1e0e078]">Shipping Address</h2>
            <!-- Pick up your parcel from -->
          
          
           <!-- Name and Phone -->
               <div class="flex flex-wrap mx-2">
              <div class="w-full md:w-1/2 px-2 mb-4">
                 <label class="block mb-2" for="name"> Name </label>
                    <input type="text" name="name" id="edit_name" class="w-full p-2 border rounded" placeholder="Enter your name">
              </div>
              
              <div class="w-full md:w-1/2 px-2 mb-4">
                 <label class="block mb-2" for="phone">Phone</label>
                  <input type="text" name="phone" id="edit_phone" class="w-full p-2 border rounded" placeholder="Enter your phone number">
              </div>
            </div>


             <!-- city and area -->
            <div class="flex flex-wrap mx-2">
              <div class="w-full md:w-1/2 px-2 mb-4">
              <label class="block mb-2" for="city">City</label>
                     <select id="district_id" name="district_id" class="w-full p-2 border rounded" required>
                         <option value="">Select City</option>
                           @foreach(district() as $row)
                                <option value="{{$row->id}}"> {{$row->name}}</option>
                           @endforeach
                           <!-- Add options for divisions -->
                     </select>
              </div>
              <div class="w-full md:w-1/2 px-2 mb-4">
              <label class="block mb-2" for="area">Area</label>
                <select id="upazila_id" name="upazila_id" class="w-full p-2 border rounded" required>
                         <option value=""> Select Area </option>
                           @foreach(upazila() as $row)
                              <option value="{{$row->id}}">
                                  {{$row->name}}
                              </option>
                             @endforeach
                           <!-- Add options for divisions -->
                        </select>
              </div>
            
            </div>



              <!-- Zone  and Alternative -->
              <div class="flex flex-wrap mx-2">
              <div class="w-full md:w-1/2 px-2 mb-4">
                     <label class="block mb-2" for="area"> Zone</label>
                       <select id="union_id" name="union_id" class="w-full p-2 border rounded" required>
                          <option value="">Select Zone</option>  
                            @foreach(union() as $row)
                              <option value="{{$row->id}}">
                                  {{$row->name}}
                              </option>
                             @endforeach        
                      </select>
              </div>
              <div class="w-full md:w-1/2 px-2 mb-4">
                  <label class="block mb-2" for="phone"> Alternative Phone </label>
                  <input type="text"  name="alternative_phone" id="edit_alternative_phone" class="w-full p-2 border rounded" placeholder="Enter your phone number">
              </div>
            
            </div>

           

            <!-- Address -->
            <div class="mb-4 px-2">
            <label class="block mb-2" for="address">Address</label>
                <textarea id="edit_address" name="address" class="w-full p-2 border rounded" rows="2" 
                placeholder="বাসা/ফ্ল্যাট নাম্বর, গ্রামের নাম, পরিচিতির এলাকা উল্লেখ করুন" ></textarea>
            </div>


            <div class="mt-4  px-2">
                <button  type="submit" id="edit_address_btn" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Update
                </button>

          </div>

     
    </form>
         
     
    </section>

    
    <script src="{{ asset('js/address.js') }}"></script>
    <script src="{{ asset('js/checkout.js') }}"></script>





    @endsection
