@extends('layouts/frontendheader')
@section('content')
<div class="bg-gray-200 flex items-center justify-center min-h-[70vh]">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold mb-6  text-gray-900"> Profile Update </h2>
        <form method="POST" action="{{ url('/member/profile_update') }}">
        @csrf
        @if ($errors->any())
          <div style="background-color: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1rem;" role="alert">
          <ul style="margin-top: 0.5rem; list-style-type: disc; padding-left: 1rem;">
            @foreach ($errors->all() as $error)
             <li style="color: #b91c1c;">{{ $error }}</li>
           @endforeach
            </ul>
          </div>
          @endif

        @if(Session::has('success'))
          <div style="background-color: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1rem;">
           {{ Session::get('success') }}
           </div>
        @endif
          
        <div class="mb-4">
            <label
              for="name"
              class="block text-sm font-medium text-gray-700 mb-2"
              >Name</label
            >
            <input
              type="text"
              id="name" 
              name="name" value="{{$member->name}}"
              class="w-full px-3 py-2 border shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              required
            />
          </div>


          <div class="mb-4">
            <label
              for="name"
              class="block text-sm font-medium text-gray-700 mb-2"
              >Date of Birth</label
            >
            <input
              type="date"
              id="dateob" value="{{$member->dateob}}"
              name="dateob"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              
            />
          </div>




          <div class="mb-4">
            <label
              for="name"
              class="block text-sm font-medium text-gray-700 mb-2"
              >Phone Number</label
            >
            <input
              type="text"
              id="phone" value="{{$member->phone}}"
              name="phone"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              required
            />
          </div>



          <div class="mb-4">
            <label
              for="email"
              class="block text-sm font-medium text-gray-700 mb-2"
              >E-mail</label
            >
            <input
              type="email"
              id="email"
              name="email" value="{{$member->email}}"
              class="w-full px-3 py-2 border shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              required
            />
          </div>

          <button
            type="submit"
            class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-sm font-medium"
          >
            Update
          </button>


        </form>
      </div>
    </div>



    @endsection
