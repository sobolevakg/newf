if ($("div").is(".b-review")) {

    $('.b-review').click(function () {
        var answer = $(this).attr('data-answer');
        $('body').append('<div class="b-review__modal">'+
		  '<div class="b-review__modal-content">'+
		   '<div class="b-review__modal-close">&times;</div>'+
		    '<div class="b-review__modal-tabs">Оставить отзыв</div>'+
		    '<div class="b-review__tabs-content">' +
                          '<div class="b-review__input-content">' +
                                  '<label for="name">Ваше имя</label>' +                          
                                  '<input spellcheck="false" class="b-review__input" id="user_name" maxlength="80" name="user_name" required>'+  
                                  '<div class="b-review__option b-review__gray">Например: Иванов Иван Иванович</div>' + 
                          '</div>' +  
                          '<div class="b-review__input-content">' +                 
                                  '<label for="text">Текст отзыва</label>' +
                                  '<textarea name="text" class="b-review__text-area" id="text" required></textarea>'+   
                          '</div>' +
                                '<div class="b-review__option b-review__gray b-review__option-error"></div>' + 
                          '<div class="b-review__button-container">' +
                                  '<button class="b-review__button b-review__save">Оставить отзыв</button>' +                          
                          '</div>' +
                     '</div>' +                     
		  '</div>'+
		'</div> ');

    $('.b-review__modal').css('display','block');
	$('.b-review__modal-close').click(function(){
		$('.b-review__modal').remove();
	});
$('.b-review__save').click(function(){
if($('#user_name').val() != '' && $('#text').val() != ''){
	$('#text').css({'border' : '1px solid #acacac'});
        $('#user_name').css({'border' : '1px solid #acacac'});
        $.ajax({
          url: '/review_save',
          type: 'POST',
          dataType: 'json',
          data:{
             user_name: $('#user_name').val(),
             text: $('#text').val(),
             id: $('.b-review').attr('data-id'),
             type: $('.b-review').attr('data-type'),
             answer: answer
          },
          success: function(r) {
                if(r.error == 1){
                        $('.b-review__option-error').text(r.message);
                        $('.b-review__option-error').css('display', 'block');
                }else if(r.error == 0){
			$('.b-review__modal').remove();
			$('body').dialog({}, r.message);
		}
                   
          },
          error: function (r) {
		$('.b-review__modal').remove();
                $('body').dialog({'background-color' : 'rgba(255, 0, 0, 0.57)'}, r.message);
          }
        });
}else{
	if($('#user_name').val() == ''){
	
        	$('#user_name').css({'border' : '1px solid #ff0000'});

	}else{
		$('#user_name').css({'border' : '1px solid #acacac'});
	}
	if($('#text').val() == ''){

		$('#text').css({'border' : '1px solid #ff0000'});
	}else{
		$('#text').css({'border' : '1px solid #acacac'});
	}
}
});
    });


}
