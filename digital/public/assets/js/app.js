// Materialize Initializations
$(document).ready(function(){
  // Sidenav
  $('.sidenav').sidenav();

  // Dropdown menu
  $(".dropdown-trigger").dropdown();

  // Select Input
  $('select').formSelect();

  // Carousel
  $('.carousel-slider').carousel({
    fullWidth: true,
    indicators: true
  });
});

// Hide Flash Messages After 3 Seconds
[...document.querySelectorAll('.btn-message-lg')].map(ele => {
  setTimeout(() => {
    ele.style.display = 'none';
  }, 3000);
});

// Read Image As String
[...document.querySelectorAll('.profile-avatar-img-input')].map(input => {
  [...document.querySelectorAll('.profile-avatar-img')].map(img => {
    input.addEventListener('change', function(e){
      const files = e.target.files;
      const fileReader = new FileReader();
      fileReader.addEventListener('load', function(){
        img.src = this.result;
      });
      fileReader.readAsDataURL(files[0]);
    });
  });
});

// Remove Preloader After window is loaded
window.addEventListener('load', () => {
  document.querySelector('.preloader').remove();
});