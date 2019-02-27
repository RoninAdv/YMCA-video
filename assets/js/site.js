$( document ).ready(function() {

 	if (navigator.userAgent.toLowerCase().indexOf("chrome") >= 0) {
    $(window).load(function(){
        $('input:-webkit-autofill').each(function(){
            var text = $(this).val();
            var name = $(this).attr('name');
            $(this).after(this.outerHTML).remove();
            $('input[name=' + name + ']').val(text);
        });
    });}

  $( '.day-events a' ).on( "click", function() {
    alert('test');
  }); 

 


    $(window).scroll(function() { // check if scroll event happened
        if ($(document).scrollTop() > 50) { // check if user scrolled more than 50 from top of the browser window
            $(".site-header").addClass("scrolled"); // if yes, then change the color of class "navbar-fixed-top" to white (#f8f8f8)
        } else {
            $(".site-header").removeClass("scrolled"); // if not, change it back to transparent
        }
    });

$('a#buttonid').click(function(){
    $(this).addClass('active'); 
});
  

$('.event-list li').first().addClass("display");

$(document).on('click', '.orange', function() { 
   var month = $(this).attr('data-month');
   var day = $(this).attr('data-day');
   var id = '.' + $(this).attr('data-monthday');
   $('li.display').removeClass( 'display' );
   $('div').find(id).addClass('display');
   $('.class-day').text(day);
   $('.class-month').text(month);
 });

// $('.center-posts').slick({
//   centerMode: true,
//   centerPadding: '0px',
//   slidesToShow: 3,
//   adaptiveHeight: false,
//   responsive: [
//     {
//       breakpoint: 768,
//       settings: {
//         arrows: false,
//         centerMode: true,
//         centerPadding: '40px',
//         slidesToShow: 3
//       }
//     },
//     {
//       breakpoint: 480,
//       settings: {
//         arrows: false,
//         centerMode: true,
//         centerPadding: '40px',
//         slidesToShow: 1
//       }
//     }
//   ]
// });





});//end script



var $jq = jQuery.noConflict();
$jq(document).ready(function() { 
  $jq('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
      disableOn: 700,
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,
      fixedContentPos: false
    });


});
