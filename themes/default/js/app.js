jQuery(function($) {
  "use strict";
////////////////////////////////////////////////////////
///////////////preloader ///////////////////////////
////////////////////////////////////////////////////////

	$(window).load(function() { // makes sure the whole site is loaded
	
			$('#status').fadeOut(); // will first fade out the loading animation
			$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
			$('body').delay(350).css({'overflow':'visible'});
	});
	  
////////////////////////////////////////////////////////
///////////////dropdown hover//////////////
////////////////////////////////////////////////////////
    $(".menu .dropdown").hover(
        function() { $('.dropdown-menu', this).stop().fadeIn("fast");
        },
        function() { $('.dropdown-menu', this).stop().fadeOut("fast");
    });

////////////////////////////////////////////////////////
///////////////back to top ///////////////////////////
////////////////////////////////////////////////////////


	var offset = 220;
	var duration = 500;
		jQuery(window).scroll(function() {
			if (jQuery(this).scrollTop() > offset) {
				jQuery('.back-to-top').fadeIn(duration);
			} else {
				jQuery('.back-to-top').fadeOut(duration);
			}
		});
		jQuery('.back-to-top').click(function(event) {
			event.preventDefault();
			jQuery('html, body').animate({scrollTop: 0}, duration);
			return false;
		});

////////////////////////////////////////////////////////
///////////////Parallax effects/////////////////////////
////////////////////////////////////////////////////////


$('div.bgParallax').each(function(){
	var $obj = $(this);

	$(window).scroll(function() {
		var yPos = -($(window).scrollTop() / $obj.data('speed')); 

		var bgpos = '50% '+ yPos + 'px';

		$obj.css('background-position', bgpos );
 
	}); 
});
////////////////////////////////////////////////////////
///////////////gallery owl-carousel ///////////////////////////
////////////////////////////////////////////////////////
  $("#feature-posts-grid").owlCarousel({
      items : 5,
      itemsDesktop : [1366,4],
      itemsDesktopSmall : [1024,3],
      pagination : false,
	  navigation : true,
	  navigationText: [
      "<i class='fa fa-angle-left'></i>",
      "<i class='fa fa-angle-right'></i>"
      ],
	  lazyLoad : true
  });
 
  
 
  jQuery("#sponsor-carousel").owlCarousel({
 
    autoPlay: 3000, //Set AutoPlay to 3 seconds
 	pagination: false,
    items : 3,
    itemsDesktop : [1199,4],
    itemsDesktopSmall : [979,3],
 	navigation: true,
	  navigationText: [
      "<i class='fa fa-angle-left'></i>",
      "<i class='fa fa-angle-right'></i>"
      ]
  });
 
  

////////////////////////////////////////////////////////
///////////////masonry ///////////////////////////
////////////////////////////////////////////////////////

	jQuery('.masonry-container').masonry({
		itemSelector: '.masonry-item'
		// columnWidth: 152
	});

////////////////////////////////////////////////////////
///////////////contact form ///////////////////////////
////////////////////////////////////////////////////////
$("#comment-form").validate({
         ignore: ":hidden",
         rules: {
             name:{
                minlength: 2,
                maxlength: 30,
                required: true
            },
            email:{
                minlength: 2,
                required: true
            },
			
			message:{
                minlength: 3,
                maxlength: 300,
                required: true
            }
         },
	});
	 
$("#contact-form").validate({
         ignore: ":hidden",
         rules: {
             yourname:{
                minlength: 2,
                maxlength: 30,
                required: true
            },
            email:{
                minlength: 2,
                required: true
            },
			
			message:{
                minlength: 3,
                maxlength: 300,
                required: true
            }
         },
		 submitHandler: function (form) {
             $.ajax({
                 type: "POST",
                 url: "sendemail.php",
                 data: $("#contact-form").serialize(),
					error:function(){
						//alert('asdasdasd');
						console.log('Some thing went wrong! :D');
						},
                 		success:function(data) {
						//alert(data);
						if(data=='fail'){
							$('#errormessage').html("<label for='captcha_code' class='error'>Security Code was incorrect.</label>");
						}else{
							$('.reg-form').html("<div id='message'></div>");
							 $('#message').html("<h2> Thanks for Submitting your Message!</h2>")
								 .hide()
								 .fadeIn(1500, function (data) {
								 $('#message').append("");
							 });
						}
                 }
             });
             return false; // required to block normal submit since you used ajax
         }
     });
/// end js
});