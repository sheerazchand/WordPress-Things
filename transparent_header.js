jQuery(window).scroll(function(){
  var sticky = jQuery('.site-header'),
    scroll = jQuery(window).scrollTop();

  if (scroll >= 200) sticky.addClass('sticky-yes');
  else sticky.removeClass('sticky-yes');
});

@media only screen and (min-width:992px){
body.sticky-yes{
	position:fixed;
	top:0;
	left:0;
	width:100%;
}
}
