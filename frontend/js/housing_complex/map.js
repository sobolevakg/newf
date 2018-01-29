if ($("div").is(".b-mapButton")) {	
	ymaps.ready(init);
	function init() {
		$(".b-mapButton").click(function(){			
	$('body').append('<div class="b-listing__modal">'+
		  '<div class="b-listing__modal-content">'+
		    '<div class="b-listing__modal-close">&times;</div>'+
		    '<div id="map" class="b-listing__map"></div>'+
		  '</div>'+
		'</div>');
			$('.b-listing__modal').css('display','block');
			$('.b-listing__modal-close').click(function(){
				$('.b-listing__modal').remove();
			});
		if($(this).attr('data-latitude') && $(this).attr('data-longitude')){

			    var myMap = new ymaps.Map('map', {
				    center: [$(this).attr('data-latitude'), $(this).attr('data-longitude')],
				    zoom: 12,
				    controls: []
				}, {
				    searchControlProvider: 'yandex#search'
				}),

				myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
				    hintContent: $(this).attr('data-name'),
				    balloonContent: $(this).attr('data-address')
				}, {
				    iconLayout: 'default#image',
				    iconImageHref: '/i/placemark.png',
				    iconImageSize: [50, 50],
				    iconImageOffset: [-20, -47]
				});


			    myMap.geoObjects
				.add(myPlacemark);
		}else if($(this).attr('data-address')){
			var myMap = new ymaps.Map('map', {
				center: [55.753994, 37.622093],
				zoom: 12,
				controls: []
			    });

			    ymaps.geocode($(this).attr('data-address'), {
			    
				results: 1
			    }).then(function (res) {
				    var firstGeoObject = res.geoObjects.get(0),
					coords = firstGeoObject.geometry.getCoordinates(),
					bounds = firstGeoObject.properties.get('boundedBy');

				    
				    myMap.setBounds(bounds, {
					checkZoomRange: true
				    });

				     var myPlacemark = new ymaps.Placemark(coords, {
				     	hintContent: $(this).attr('data-name'),
				    	balloonContent: $(this).attr('data-address')
				     }, {
				     	iconLayout: 'default#image',
					iconImageHref: '/i/placemark.png',
					iconImageSize: [50, 50],
					iconImageOffset: [-20, -47]
				     });

				     myMap.geoObjects.add(myPlacemark);
				     
				});
		}
	    });
	
     }
}
if ($("div").is("#map_card_apart")) {
	ymaps.ready(init);
	function init() {
	if($('#map_card_apart').attr('data-address')){
		 var myMap = new ymaps.Map('map_card_apart', {
				center: [55.76, 37.64],
				zoom: 13,
				controls: []
			    });

			    ymaps.geocode($('#map_card_apart').attr('data-address'), {			    
				results: 1
			    }).then(function (res) {
				    var firstGeoObject = res.geoObjects.get(0),
					coords = firstGeoObject.geometry.getCoordinates(),
					bounds = firstGeoObject.properties.get('boundedBy');


				     var myPlacemark = new ymaps.Placemark(coords, {
				    	balloonContent: $('#map_card_apart').attr('data-address')
				     }, {
				     	iconLayout: 'default#image',
					    iconImageHref: '/i/placemark.png',
					    iconImageSize: [50, 50],
					    iconImageOffset: [-20, -47]
				     });
                         myMap.geoObjects.add(myPlacemark);
				    myMap.setCenter(coords, 13, {
					    checkZoomRange: true
				    });

                    if(coords){
						$.ajax({
                              url: '/infrastructure',
                              type: 'POST',
                              dataType: 'json',
                              data:{
                                 geo: coords
                              },
                              success: function(r) {
                                    if(r.data){
                                        geo_placemark_similar(r.data, coords, myMap);
                                    }       
                              }
                            });
					}   
				           
				});  
                  
	}else{
		$('.b-housing-complex__wrap-map').remove();
	}
}

    function geo_placemark_similar(params, coords, myMap){
        var school_items = [],
            kindergartens_items = [],
            clinics_items = [],
            grocery_stores_items = [],
            cafe_items = [];

		        if(params.length){
                    for(var num = 0; num<params.length; num++){
                    var param = params[num];
				        switch (param['env_type_id']) {
				          case "1":
					        school_items.push({
		                        center: [[param['latitude']],[param['longitude']]],
		                        name: param['name']
                        	});
					        break;
				          case "2":
					        kindergartens_items.push({
		                        center: [[param['latitude']],[param['longitude']]],
		                        name: param['name']
                        	});
					        break;
				          case "3":
					        clinics_items.push({
		                        center: [[param['latitude']],[param['longitude']]],
		                        name: param['name']
                        	});
					        break;
				          case "4":
					        grocery_stores_items.push({
		                        center: [[param['latitude']],[param['longitude']]],
		                        name: param['name']
                        	});
					        break;
				          case "5":
					        cafe_items.push({
		                        center: [[param['latitude']],[param['longitude']]],
		                        name: param['name']
                        	});
					        break;
				        }
                }
		        var groups = [{
                    name: "<img src='/i/infrastructure/shkola_menu.png'>",
                    title: 'Школы',
                    href: "/i/infrastructure/shkola.png",
                    style: "default#image",
                    items: school_items
                }, {
                    name: "<img src='/i/infrastructure/sad_menu.png'>",
                    title: 'Детские сады',
                    href: "/i/infrastructure/sad.png",
                    style: "default#image",
                    items: kindergartens_items
                }, {
                    name: "<img src='/i/infrastructure/bolnica_menu.png'>",
                    title: 'Поликлиники',
                    href: "/i/infrastructure/bolnica.png",
                    style: "default#image",
                    items: clinics_items
                }, {
                    name: "<img src='/i/infrastructure/magaz_menu.png'>",
                    title: 'Продуктовые магазины',
                    href: "/i/infrastructure/magazin.png",
                    style: "default#image",
                    items: grocery_stores_items

                }, {
                    name: "<img src='/i/infrastructure/cafe_menu.png'>",
                    title: "Кафе",
                    style: "default#image",
                    href: "/i/infrastructure/cafe.png",
                    items: cafe_items
                }];

		}
	
	    
        if(groups.length){
	    	menu = $('<ul class="b-housing-complex__map-menu"/>');


		$('<li><div class="b-housing-complex__map-menu-full-name"><span>Инфраструктура</span></div><div class="b-housing-complex__map-menu-full-img"><img src="/i/left_card.png"/></div></li>').appendTo(menu).on('click', function() {
		    if ($('.b-housing-complex__map-menu').hasClass('b-housing-complex__map-menu-full')) {
		        $('.b-housing-complex__map-menu').removeClass('b-housing-complex__map-menu-full');
		        $('.b-housing-complex__map-menu-full-img').html('<img src="/i/left_card.png"/>');
		    } else {
		        $('.b-housing-complex__map-menu').addClass('b-housing-complex__map-menu-full');
		        $('.b-housing-complex__map-menu-full-img').html('<img src="/i/right_card.png"/>');
		    }
		});
		for (var i = 0, l = groups.length; i < l; i++) {
		    createMenuGroup(groups[i]);

		}

		function createMenuGroup(group) {
		    var menuItem = $('<li>' + group.name + '<span>' + group.title + '</span></li>'),
		        collection = new ymaps.GeoObjectCollection(null, {
		            preset: group.style,
		            iconImageHref: group.href,
		            iconImageSize: [50, 50],
		    		iconImageOffset: [-20, -47]
		        });


		    myMap.geoObjects.add(collection);

		    menuItem
		        .appendTo(menu)
		        .on('click', function() {
		            if (collection.getParent()) {
		                myMap.geoObjects.remove(collection);
		            } else {
		                myMap.geoObjects.add(collection);
		            }
		        });
		    for (var j = 0, m = group.items.length; j < m; j++) {
		        createSubMenu(group.items[j], collection);

		    }
		}

		function createSubMenu(item, collection) {
		    var placemark = new ymaps.Placemark(item.center, {
		        balloonContent: item.name,
		    	iconImageOffset: [-20, -47]
		    });

		    collection.add(placemark);

		}

		menu.appendTo($('#map_card_apart'));
        }
        
    }
}
if ($("div").is("#map_card")) {
	ymaps.ready(init);
	function init() {
	if($('#map_card').attr('data-latitude') && $('#map_card').attr('data-longitude')){
        var coords = [$('#map_card').attr('data-latitude'), $('#map_card').attr('data-longitude')];
		 var myMap = new ymaps.Map('map_card', {
				center: coords,
				zoom: 13,
				controls: []
			    });
            var myPlacemark = new ymaps.Placemark(coords, {
                        hintContent: $('#map_card').attr('data-name'),
				    	balloonContent: $('#map_card').attr('data-address')
				     }, {
				     	iconLayout: 'default#image',
					    iconImageHref: '/i/placemark.png',
					    iconImageSize: [50, 50],
					    iconImageOffset: [-20, -47]
				     });                   
                myMap.geoObjects.add(myPlacemark);

						$.ajax({
                              url: '/infrastructure',
                              type: 'POST',
                              dataType: 'json',
                              data:{
                                 geo: coords
                              },
                              success: function(r) {
                                    if(r.data){
                                        geo_placemark_similar(r.data, coords, myMap);
                                    }       
                              }
                            });  
				            
                  
	}else{
		$('.b-housing-complex__wrap-map').remove();
	}
}

    function geo_placemark_similar(params, coords, myMap){
        var school_items = [],
            kindergartens_items = [],
            clinics_items = [],
            grocery_stores_items = [],
            cafe_items = [];

		        if(params.length){
                    for(var num = 0; num<params.length; num++){
                    var param = params[num];
				        switch (param['env_type_id']) {
				          case "1":
					        school_items.push({
		                        center: [[param['latitude']],[param['longitude']]],
		                        name: param['name']
                        	});
					        break;
				          case "2":
					        kindergartens_items.push({
		                        center: [[param['latitude']],[param['longitude']]],
		                        name: param['name']
                        	});
					        break;
				          case "3":
					        clinics_items.push({
		                        center: [[param['latitude']],[param['longitude']]],
		                        name: param['name']
                        	});
					        break;
				          case "4":
					        grocery_stores_items.push({
		                        center: [[param['latitude']],[param['longitude']]],
		                        name: param['name']
                        	});
					        break;
				          case "5":
					        cafe_items.push({
		                        center: [[param['latitude']],[param['longitude']]],
		                        name: param['name']
                        	});
					        break;
				        }
                }
		        var groups = [{
                    name: "<img src='/i/infrastructure/shkola_menu.png'>",
                    title: 'Школы',
                    href: "/i/infrastructure/shkola.png",
                    style: "default#image",
                    items: school_items
                }, {
                    name: "<img src='/i/infrastructure/sad_menu.png'>",
                    title: 'Детские сады',
                    href: "/i/infrastructure/sad.png",
                    style: "default#image",
                    items: kindergartens_items
                }, {
                    name: "<img src='/i/infrastructure/bolnica_menu.png'>",
                    title: 'Поликлиники',
                    href: "/i/infrastructure/bolnica.png",
                    style: "default#image",
                    items: clinics_items
                }, {
                    name: "<img src='/i/infrastructure/magaz_menu.png'>",
                    title: 'Продуктовые магазины',
                    href: "/i/infrastructure/magazin.png",
                    style: "default#image",
                    items: grocery_stores_items

                }, {
                    name: "<img src='/i/infrastructure/cafe_menu.png'>",
                    title: "Кафе",
                    style: "default#image",
                    href: "/i/infrastructure/cafe.png",
                    items: cafe_items
                }];

		}
	
	    
        if(groups.length){
	    	menu = $('<ul class="b-housing-complex__map-menu"/>');


		$('<li><div class="b-housing-complex__map-menu-full-name"><span>Инфраструктура</span></div><div class="b-housing-complex__map-menu-full-img"><img src="/i/left_card.png"/></div></li>').appendTo(menu).on('click', function() {
		    if ($('.b-housing-complex__map-menu').hasClass('b-housing-complex__map-menu-full')) {
		        $('.b-housing-complex__map-menu').removeClass('b-housing-complex__map-menu-full');
		        $('.b-housing-complex__map-menu-full-img').html('<img src="/i/left_card.png"/>');
		    } else {
		        $('.b-housing-complex__map-menu').addClass('b-housing-complex__map-menu-full');
		        $('.b-housing-complex__map-menu-full-img').html('<img src="/i/right_card.png"/>');
		    }
		});
		for (var i = 0, l = groups.length; i < l; i++) {
		    createMenuGroup(groups[i]);

		}

		function createMenuGroup(group) {
		    var menuItem = $('<li>' + group.name + '<span>' + group.title + '</span></li>'),
		        collection = new ymaps.GeoObjectCollection(null, {
		            preset: group.style,
		            iconImageHref: group.href,
		            iconImageSize: [50, 50],
		    		iconImageOffset: [-20, -47]
		        });


		    myMap.geoObjects.add(collection);

		    menuItem
		        .appendTo(menu)
		        .on('click', function() {
		            if (collection.getParent()) {
		                myMap.geoObjects.remove(collection);
		            } else {
		                myMap.geoObjects.add(collection);
		            }
		        });
		    for (var j = 0, m = group.items.length; j < m; j++) {
		        createSubMenu(group.items[j], collection);

		    }
		}

		function createSubMenu(item, collection) {
		    var placemark = new ymaps.Placemark(item.center, {
		        balloonContent: item.name,
		    	iconImageOffset: [-20, -47]
		    });

		    collection.add(placemark);

		}

		menu.appendTo($('#map_card'));
        }
        
    }
}
