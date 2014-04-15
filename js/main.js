$(function(){
	$('.map-wrap').fitVids({ customSelector: "iframe[src*='google.com/maps']" });
	$('[data-image-switch]').on('click', function(){
		if($(this).find('img').attr('src') == 'images/home-bg2.png'){
			$(this).find('img').attr('src', 'images/home-bg.png');
		}else{
			$(this).find('img').attr('src', 'images/home-bg2.png');
		}
	});
});