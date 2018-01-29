window.onload = function () {
    if ($("div").is(".b-developers-show__button-prev")) {
        $('.b-developers-show__button-prev').click(function () {
            history.back();
        });
    }

    if ($("div").is(".b-developers-show__phone")) {
        $('.b-developers-show__phone').click(function () {
            if ($('.b-developers-show__phone  .b-developers-show__phone-show').is(':hidden')) {
                $('.b-developers-show__phone .b-developers-show__phone-title').hide();
                $('.b-developers-show__phone  .b-developers-show__phone-show').show();
            } else {
                $('.b-developers-show__phone .b-developers-show__phone-title').show();
                $('.b-developers-show__phone  .b-developers-show__phone-show').hide();
            }
        });
    }

$('.b-listing__developers-search').keyup(function(event){
   if ((event.keyCode == 0xA)|| (event.keyCode == 0xD)){
	var url = location.href + '?',
		search_url = url.substr(0,url.indexOf('?'));
        location.href = search_url + '?name=' + $('.b-listing__developers-search').val();
   }
});

$('.b-listing__developers-search-button').click(function(){
   if ($('.b-listing__developers-search').val() != ''){
	var url = location.href + '?',
		search_url = url.substr(0,url.indexOf('?'));
        location.href = search_url + '?name=' + $('.b-listing__developers-search').val();
   }
});

if ($("div").is(".b-developers-show__read-more")) {
        $('.b-developers-show__read-more').click(function () {
		if ($('.b-developers-show__note').hasClass('b-developers-show__note-full')){			
             		$('.b-developers-show__note').removeClass('b-developers-show__note-full');
		}else{
             		$('.b-developers-show__note').addClass('b-developers-show__note-full');
		}
        });
}


}
