// document.addEventListener('DOMContentLoaded', function () {
//   const editAddressBtn = document.getElementById('editAddressBtn');
//   const modal = document.getElementById('addressModal');
//   const closeModal = document.getElementById('closeModal');
//   const saveAddressBtn = document.getElementById('saveAddressBtn');

//   // Open the modal when the "Edit" button is clicked
//   editAddressBtn.addEventListener('click', function () {
//     modal.style.display = 'block';
//   });

//   // Close the modal when the close icon is clicked
//   closeModal.addEventListener('click', function () {
//     modal.style.display = 'none';
//   });

//   // Save the address and close the modal
//   saveAddressBtn.addEventListener('click', function () {
//     // Fetch values from modal inputs
//     const name = document.getElementById('modal_name').value;
//     const phone = document.getElementById('modal_phone').value;
//     const division = document.getElementById('modal_division').value;
//     const district = document.getElementById('modal_district').value;
//     const address = document.getElementById('modal_address').value;

//     // Here, you can add code to update the address display or send the data to your server

//     // Close the modal
//     modal.style.display = 'none';
//   });

  // Close the modal if the user clicks outside of it
//   window.addEventListener('click', function (event) {
//     if (event.target === modal) {
//       modal.style.display = 'none';
//     }
//   });
// });

function changeImage(imageSrc) {
  document.getElementById("mainImage").src = imageSrc;
}
function toggleDropdown() {
  const dropdown = document.getElementById("userDropdown");
  dropdown.classList.toggle("hidden");
}

// Close dropdown when clicking outside of it
document.addEventListener("click", function (event) {
  const dropdown = document.getElementById("userDropdown");
  const userIcon = document.querySelector(".userIcon");
  if (!userIcon.contains(event.target) && !dropdown.contains(event.target)) {
    dropdown.classList.add("hidden");
  }
});


$(document).ready(function () {
  $('.slider').slick({
    dots: true,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
  });
});
$(document).ready(function () {
  $('.product_slider').slick({
    dots: true,
    infinite: true,
    speed: 500,
    slidesToShow: 4, // Default number of slides to show
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,

    // Add responsive settings
    responsive: [
      {
        breakpoint: 1024, // Screen width of 1024px and below
        settings: {
          slidesToShow: 3, // Show 3 slides
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 768, // Screen width of 768px and below (tablet)
        settings: {
          slidesToShow: 2, // Show 2 slides
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 480, // Screen width of 480px and below (mobile)
        settings: {
          slidesToShow: 1, // Show 1 slide
          slidesToScroll: 1,
        }
      }
    ]
  });
});


$(document).ready(function() {
  var header = $('.header');
  var stickyOffset = header.offset().top;

  $(window).scroll(function() {
    if ($(window).scrollTop() > stickyOffset) {
      header.addClass('sticky shadow bg-white'); // Adds sticky and changes bg color
    } else {
      header.removeClass('sticky shadow bg-white'); // Removes sticky and reverts bg color
    }
  });
});