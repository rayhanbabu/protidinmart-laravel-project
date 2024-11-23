<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Protidin Mart প্রতিদিন মার্ট </title>
    <link rel="icon" type="image/jpg" href="{{asset('frontend/images/logo.jpg')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
       
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      rel="stylesheet"
    />
    <!-- <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    /> -->
    <!-- Slick Slider CSS -->
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
    />

    <link rel="stylesheet" href="{{asset('frontend/dist/indext.css')}}" />


    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('frontend/dist/main.js')}}"></script>
    <script src="{{asset('dashboardfornt/js/sweetalert.min.js')}}" > </script>
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
    ></script>

    <script
      src="https://kit.fontawesome.com/f66fcf2f19.js"
      crossorigin="anonymous"
    ></script>

    <script src="{{asset('js/cart.js')}}" ></script>

    <style>
      .about {
        background: linear-gradient(180deg, #fae3ef, #fde7e7, #f0e8f9);
      }
      /* Optional: Add hover effects to user icon */
      .userIcon:hover {
        color: #555;
      }

      /* Dropdown positioning */
      #userDropdown {
        min-width: 150px;
        right: 0;
      }
    </style>
  </head>
  <body>
    <!-- header -->
    <header class="shadow bg-white">
      <div class="bg-[#FF79C8]">
        <div
          class="topHeader px-2 max-w-screen-xl flex items-center justify-between mx-auto py-2"
        >
          <div class="hidden sm:flex items-center gap-4 ">
            <p>01750360044</p>
            <p>info@protidinmart.com</p>
          </div>
          <div>

          <a href="{{url('sale_type/Wholesale')}}"
            class="bg-blue-500 px-3 py-1 hover:bg-blue-700 transition-all duration-300 rounded text-white">
          পাইকারি
            </a>

            <a href="{{url('sale_type/Retail')}}"
            class="bg-blue-500 px-3 py-1 hover:bg-blue-700 transition-all duration-300 rounded text-white">
          খুচরা
            </a>

           
          </div>
        </div>
      </div>
      <div class="header">
        <div class="max-w-screen-xl mx-auto flex py-3 justify-between px-2">
          <a
            href="{{url('/')}}"
            class="logo w-full basis-1/2 md:w-auto flex justify-center md:justify-start" >
            <img src="{{asset('frontend/images/protidin2.png')}}" alt="logo" class="h-12" />
          </a>

          <div
            class="search w-full md:w-auto hidden sm:flex basis-full justify-center items-center mt-3 mx-5 md:mx-0 order-3 md:order-none md:mt-0"
          >
            <input
              type="text"
              placeholder=" অনুসন্ধান করুন "
              class="border-black border-2 px-3 py-2 rounded-l-lg w-full md:w-auto"
            />
            <button
              class="bg-black text-white px-3 py-2 border-2 border-black rounded-r-lg"
            >
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </div>

          <div
            class="icons w-full md:w-auto flex items-center justify-center md:justify-end text-xl gap-4 mt-3 md:mt-0 relative basis-1/2"
          >
            <i class="fa-brands fa-whatsapp"></i>

        
          @if(member_info() && member_info()['phone'])      
             <i
                class="fa-solid fa-circle-user userIcon cursor-pointer"
                onclick="toggleDropdown()"
             > </i> 

            <!-- <i class="fa-regular fa-heart"></i> -->
            <a href="{{url('cart-details')}}">
              <i class="fa-solid fa-bag-shopping"></i>
              <sup class="font-bold rounded-full" id="cart_product_count">0</sup>
            </a>

            @else
                <a href="{{url('member/login')}}">
                    Login 
                </a>
            @endif


          @if(member_info() && member_info()['phone'])      
            <!-- Dropdown Menu -->
            <div
    id="userDropdown"
    class="absolute right-0 top-[160%] w-48 bg-white border border-gray-300 rounded-lg shadow-lg hidden"
  >
    <ul class="py-2">
      <li>
        <a href="{{url('member/profile')}}" class="flex items-center px-4 py-2 hover:bg-gray-100 transition-colors">
          <i class="fas fa-user mr-2 text-gray-500"></i> <!-- Font Awesome Profile Icon -->
          <span>Profile</span>
        </a>
      </li>
      <li>
        <a href="{{url('/order_history')}}" class="flex items-center px-4 py-2 hover:bg-gray-100 transition-colors">
          <i class="fas fa-box mr-2 text-gray-500"></i> <!-- Font Awesome Orders Icon -->
          <span>Orders</span>
        </a>
      </li>
      <li>
        <a href="{{url('/member/logout')}}" class="flex items-center px-4 py-2 hover:bg-gray-100 transition-colors">
          <i class="fas fa-sign-out-alt mr-2 text-gray-500"></i> <!-- Font Awesome Logout Icon -->
          <span>Logout</span>
        </a>
      </li>
    </ul>
  </div>
        @endif
              

          </div>
        </div>
      </div>
      <div
        class="search w-[90vw] md:w-auto sm:hidden flex justify-center items-center mt-3 mx-5 md:mt-0 mb-3"
      >
        <input
          type="text"
          placeholder=" অনুসন্ধান করুন "
          class="border-black border-2 px-3 py-2 rounded-l-lg w-full md:w-auto"
        />
        <button
          class="bg-black text-white px-3 py-2 border-2 border-black rounded-r-lg"
        >
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>
    </header>



    <div>
                 @yield('content')
             
     </div>
  
    <!-- contact -->
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-10">
      <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 px-6">
        <!-- Column 1: DESIGNER WEAR -->
        <div>
          <h3 class="font-semibold text-lg mb-4">DESIGNER WEAR</h3>
          <ul>
            <li class="mb-2"><a href="#">Salwar Kameez</a></li>
            <li class="mb-2"><a href="#">Sharees</a></li>
            <li class="mb-2"><a href="#">Lehengas</a></li>
            <li class="mb-2"><a href="#">Gowns</a></li>
            <li class="mb-2"><a href="#">Kidswear</a></li>
            <li class="mb-2"><a href="#">Saree Blouse</a></li>
            <li class="mb-2"><a href="#">Kurtis</a></li>
            <li class="mb-2"><a href="#">Indowestern Styles</a></li>
            <li class="mb-2"><a href="#">Men's</a></li>
            <li class="mb-2"><a href="#">Accessories</a></li>
            <li class="mb-2"><a href="#">ALTABANU Influencers</a></li>
            <li class="mb-2"><a href="#">Celebrity Wear</a></li>
          </ul>
        </div>
  
        <!-- Column 2: ABOUT US -->
        <div>
          <h3 class="font-semibold text-lg mb-4">ABOUT US</h3>
          <ul>
            <li class="mb-2"><a href="#">About Us</a></li>
            <li class="mb-2"><a href="#">Contact Us</a></li>
            <li class="mb-2"><a href="#">Blog</a></li>
            <li class="mb-2"><a href="#">Web Stories</a></li>
            <li class="mb-2"><a href="#">Testimonial</a></li>
            <li class="mb-2"><a href="#">Press</a></li>
            <li class="mb-2"><a href="#">Look book</a></li>
            <li class="mb-2"><a href="#">Careers</a></li>
            <li class="mb-2"><a href="#">ALTABANU Boutique</a></li>
            <li class="mb-2"><a href="#">ALTABANU Fashion Show</a></li>
            <li class="mb-2"><a href="#">Video Call Appointment</a></li>
            <li class="mb-2"><a href="#">Buying Guide</a></li>
          </ul>
        </div>
  
        <!-- Column 3: POLICIES -->
        <div>
          <h3 class="font-semibold text-lg mb-4">POLICIES</h3>
          <ul>
            <li class="mb-2"><a href="#">Terms & Conditions</a></li>
            <li class="mb-2"><a href="#">Shipping</a></li>
            <li class="mb-2"><a href="#">Returns</a></li>
            <li class="mb-2"><a href="#">Privacy Policy</a></li>
            <li class="mb-2"><a href="#">Privacy Policy For APP</a></li>
            <li class="mb-2"><a href="#">Payment Policy</a></li>
            <li class="mb-2"><a href="#">FAQ’s</a></li>
            <li class="mb-2"><a href="#">Customization Charges</a></li>
          </ul>
        </div>
  
        <!-- Column 4: MY ACCOUNT -->
        <div>
          <h3 class="font-semibold text-lg mb-4">MY ACCOUNT</h3>
          <ul>
            <li class="mb-2"><a href="#">Shopping Bag</a></li>
            <li class="mb-2"><a href="#">Wishlist</a></li>
            <li class="mb-2"><a href="#">Order History</a></li>
            <li class="mb-2"><a href="#">Order Tracking</a></li>
            <li class="mb-2"><a href="#">Buy In Bulk</a></li>
          </ul>
        </div>
  
        <!-- Column 5: FOLLOW US -->
        <div>
          <h3 class="font-semibold text-lg mb-4">FOLLOW US</h3>
          <div class="flex space-x-4 mb-4">
            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-youtube"></i></a>
          </div>
          <div class="mt-4">
            <h3 class="font-semibold text-lg mb-2">CONTACT US</h3>
            <p class="text-gray-400">Phone: +123 456 7890</p>
          </div>
        </div>
      </div>
  
      <!-- Bottom section: All Rights Reserved -->
      <div class="mt-8 text-center text-gray-500 text-sm">
        <p>&copy; 2024 ALTABANU. All rights reserved.</p>
      </div>
    </footer>

    
  </body>
</html>
