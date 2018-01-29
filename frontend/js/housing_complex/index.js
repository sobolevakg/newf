$(document).ready(function () {
function getAllUrlParams(url) {

  var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

  var obj = {};
  if (queryString) {
    queryString = queryString.split('#')[0];
    var arr = queryString.split('&');

    for (var i=0; i<arr.length; i++) {
      var a = arr[i].split('=');
      var paramNum = undefined;
      var paramName = a[0].replace(/\[\d*\]/, function(v) {
        paramNum = v.slice(1,-1);
        return '';
      });

      var paramValue = typeof(a[1])==='undefined' ? true : a[1];
      paramName = paramName.toLowerCase();
      paramValue = paramValue.toLowerCase();

      if (obj[paramName]) {
        if (typeof obj[paramName] === 'string') {
          obj[paramName] = [obj[paramName]];
        }
        if (typeof paramNum === 'undefined') {
          obj[paramName].push(paramValue);
        }
        else {
          obj[paramName][paramNum] = paramValue;
        }
      }
      else {
        obj[paramName] = paramValue;
      }
    }
  }

  return obj;
}

    $('.b-favourite').favourite();

    $('.b-housing-complex__topSlider').slick({
        arrows: true,
        prevArrow: ('.b-housing-complex__prev'),
        nextArrow: ('.b-housing-complex__next'),
        centerMode: true,
        centerPadding: '150px',
        slidesToShow: 2,
        speed: 500,
        variableWidth: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3,
                    swipe: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1,
                    swipe: true
                }
            }
        ]
    });
    $('.b-housing-complex__photo').css('display', 'block');
    $('.b-housing-complex__imgCountMax').text($('.b-housing-complex__topSlider').slick("getSlick").slideCount);
    $('.b-housing-complex__topSlider').on('afterChange', function (event, slick, currentSlide) {
        $('.b-housing-complex__imgCountNum').text((currentSlide + 1));
    });

    if ($("button").is(".b-housing-complex__back")) {
        $('.b-housing-complex__back').click(function () {
            history.back();
        });
    }

    if ($("div").is(".b-housing-complex__showPhone")) {
        $('.b-housing-complex__showPhone').click(function () {
            if ($('.b-housing-complex__showPhone  .b-housing-complex__phone-show').is(':hidden')) {
                $('.b-housing-complex__showPhone .b-housing-complex__phone-title').hide();
                $('.b-housing-complex__showPhone  .b-housing-complex__phone-show').show();
            } else {
                $('.b-housing-complex__showPhone .b-housing-complex__phone-title').show();
                $('.b-housing-complex__showPhone  .b-housing-complex__phone-show').hide();
            }
        });
    }
if ($("table").is(".b-housing-complex__apartments-table-full")) {

 $(".b-housing-complex__apartments-table-full").tablesorter();
}

if (getAllUrlParams().rooms != undefined){
	var rooms = getAllUrlParams().rooms.split(',');
	for (var i = 0; i < rooms.length; i++) {
	  $(".b-housing-complex__check input[name=rooms][value="+rooms[i] + "]").attr("checked","checked");
	}
}

if (getAllUrlParams().floor != undefined){
	var floor = getAllUrlParams().floor.split(',');
	for (var i = 0; i < floor.length; i++) {
	  $(".b-housing-complex__check input[name=floor][value="+floor[i] + "]").attr("checked","checked");
	}
}

$(".b-housing-complex__check input[type=checkbox]").change(function() {
        var url = location.href + '?',
		search_url = url.substr(0,url.indexOf('?')),
	rooms = [], floor = [];
	$(".b-housing-complex__check input[type=checkbox]:checked").each(function(index,elem) {
		if($(this).attr('name') == 'rooms'){
			rooms.push(this.value);	
		}else{
			floor.push(this.value);
		}
	});
	if (rooms.length){
		search_url += '?rooms=' + rooms; 
	}
	if(search_url.indexOf('?') > -1 && floor.length){
		search_url += '&floor=' + floor; 
	}else if(floor.length && search_url.indexOf('?') < 0){
		search_url += '?floor=' + floor; 
	}
      	location.href = search_url;
  
});

if ($("div").is(".b-gcard__photos")) {
	$(".b-gcard__photos").each(function( i, element ) {
		var count = $(element).find('.b-gcard__photoCount');
		$(element).find('.fotorama').on('fotorama:show',function (e, fotorama, extra) {
				count.find('.b-gcard__photoIndexCount').html(fotorama.size);
				count.find('.b-gcard__photoIndexAction').html(fotorama.activeIndex+1);
			 }
		 );
		$(element).find('.fotorama').on('fotorama:ready',function (e, fotorama, extra) {
				count.find('.b-gcard__photoPrev').click(function(){
					fotorama.show('<');
				})
				count.find('.b-gcard__photoNext').click(function(){
					fotorama.show('>');
				})
			 }
		 );
	});
}
});
