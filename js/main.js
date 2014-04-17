$(function(){
	$('.map-wrap').fitVids({ customSelector: "iframe[src*='google.com/maps']" });
	$('.affix-container').affix({
		top: 250
	});
	$('.affix-container').css({
		width: function(){
			return $(this).parent().width()+'px';
		}
	});
	$(window).on('resize', function(){
		$('.affix-container').css({
			width: function(){
				return $(this).parent().width()+'px';
			}
		});
	})
});