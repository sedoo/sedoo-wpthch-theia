var userScroll = jQuery(document).scrollTop();

jQuery(window).on('scroll', function() {
   var newScroll = jQuery(document).scrollTop();
   if(userScroll - newScroll > 20 || newScroll - userScroll > 20){
      jQuery('.site-header').addClass('small');
   } else {
      jQuery('.site-header').removeClass('small');
   }
});