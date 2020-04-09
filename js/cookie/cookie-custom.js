(function($) {


	var GetSugaBreakingClose = Cookies.get('suga_breaking_ticker_close') // => 'value'

	if(GetSugaBreakingClose == 'ticker-closed') {
		$('.suga-breaking-news-ticker-area').hide();		
	}else {
		$('.suga-breaking-news-close').on('click', function() {
			Cookies.set('suga_breaking_ticker_close', 'ticker-closed', { expires: 2 });
			$('.suga-breaking-news-ticker-area').fadeOut(500);			
			
		});
	}


	

})(jQuery);