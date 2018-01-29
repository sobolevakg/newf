{%- extends "base_card.volt" -%}
{%- block content -%}
{%- if object is defined and object.getObjects()|length > 0 -%}
	{% for obj in object.getObjects() %}
<div class="#content">
<div class="container-fluid">
    {%- if obj.getPhotos() is not empty -%}
     	{{ partial('common/fotoramaTopSlider', ['photos': obj.getPhotos() ] ) }}
    {% endif %}
    {{- partial("common/breadcrumbs", ['advCollection': object]) -}}
    <div class="row ">
        <div class="col-xxs-20 col-lg-16 b-housing-complex__wrap">
            <div class="row b-housing-complex__block">
                    <div class="b-typo__h3 b-housing-complex__caption">Информация о жилом комплексе</div>
                    <div class="row">
                        <div class="col-xxs-20 col-md-15">
                            <div class="row">
                                <div class="col-xxs-20">
                                    <h1>{{obj.getName()}}</h1>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-xxs-20">
                                <div class="b-housing-complex__address b-typo__h2">
                                    {{obj.getGeoRegionName()}} {% if obj.getGeoStreetName() !="-=без улицы=-" or obj.getGeoStreetName()  =="" %},{{obj.getGeoStreetName() }}{% endif %}
                                    {% if obj.getGeoBuildingName()|length > 0 %}, {{obj.getGeoBuildingName()}}{% endif %}
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-xxs-20 col-md-5 s">
                            <div class="row">
                                <div class="col-xxs-20">
					{% if obj.getPriceFrom() > 0  OR obj.getPriceto() > 0%}
                                    		<div class="b-housing-complex__price">
							от <span class="b-housing-complex__priceMin">{{obj.getPriceFrom()/1000000}}</span>
							 до<span class="b-housing-complex__priceMax">{{obj.getPriceto()/1000000}}</span> млн. руб.</div>
					{% endif %}
					{% if obj.getTotalSquareFrom() > 0  OR obj.getTotalSquareTo() > 0%}
                        <div class="b-housing-complex__sq">
                            от <span class="b-housing-complex__sqMin">{{'%d'|format(obj.getTotalSquareFrom())}}</span>
                            до <span class="b-housing-complex__sqMax">{{'%d'|format(obj.getTotalSquareTo())}}</span> м<sup>2</sup>
                        </div>
					{% endif %}
                                </div>
                            </div>
                    {% if obj.getDeveloper()|length > 0  AND obj.getDeveloper()['phone'] IS NOT NULL %}
                            <div class="row">
                                <div class="col-xxs-20">
                                    <div class="b-housing-complex__showPhone">
                                        <span class="b-housing-complex__phone-title">Показать телефон</span>
			                            <span class="b-housing-complex__phone-show">{{ obj.getDeveloper()['phone'] }}</span>
                                    </div>
                                </div>
                            </div>
                    {% endif %}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxs-20 col-md-10 col-lg-8">
                            <div class="b-housing-complex__infoBlock">
                                <div class="b-housing-complex__metro">
				<span class="b-housing-complex__metroName">{{obj.getGeoSubwayStationName()}}</span>
				<span class="b-housing-complex__metroTime">
					{% if obj.getGeoSubwayTransportAccess() is empty%}
						( {{obj.getGeoSubwayWalkAccess()}} минут пешком )
					{% else %}
						( {{obj.getGeoSubwayTransportAccess()}} минут транспортом )
					{% endif %}
				</span></div>
				{% if obj.getGeoRailwayStationName() is not empty%}
                                <span class="b-housing-complex__railway">Станция ЖД {{obj.getGeoRailwayStationName()}}
					<span class="b-housing-complex__railwayTime"></span>
				</span>
				{% endif %}
				{% if obj.getGeoMkadRemoteness() is not empty%}
                                	<span class="b-housing-complex__ringRoad">До МКАД
						<span class="b-housing-complex__ringroadLength">{{obj.getGeoMkadRemoteness()}} км </span>
					</span>
				{% endif %}
                                <div class="b-housing-complex__processing">Этап строительства
                                    <div class="b-housing-complex__progressBar">
                                        <div class="b-housing-complex__fill" style="width: {{obj.getConstructionStage()}}%"></div>
                                    </div><span class="b-housing-complex__progress">{{obj.getConstructionStage()}}%</span>
                                </div>
				{% if obj.getDeveloper()|length > 0 %}
		                        <span class="b-housing-complex__builder">Застройщик:
						<span class="b-housing-complex__builderName">{{ obj.getDeveloper()['name'] }}</span>
					</span>

				{% endif %}

				{% if obj.getBuiltYear()  is not empty %}
                                <span class="b-housing-complex__status">ГК:
							{% if obj.getHousingComplexStatusId() == 1 %}
								<span class="b-housing-complex__statusType"> Дом сдан</span>
							{% endif %}
					<span class="b-housing-complex__statusType"> {{obj.getBuiltYear()}}</span>
				{% endif %}
				</span>
                            </div>
                        </div>
                        <div class="col-xxs-20 col-md-10 col-lg-7">
                            <div class="b-housing-complex__infoBlock">
								{% if obj.getHousingComplexClassId() > 0 %}
                                <span class="b-housing-complex__gkClass">Класс ЖК:
									<span class="b-housing-complex__bl">{{obj.getHousingComplexClassName()}}</span>
								</span>
								{% endif %}
                                <span class="b-housing-complex__gkType">Тип дома:
									<span class="b-housing-complex__bl">Панельный, монолитный</span>
								</span>
								{% if obj.getReadyQuarter() is not empty%}
                                <span class="b-housing-complex__houseCount">Домов:
									<span class="b-housing-complex__bl">{{obj.getReadyQuarter()}}</span>
								</span>
								{% endif %}
								{% if obj.getStoreysCount() is not empty%}
                                <span class="b-housing-complex__floorsMax">Этажность:
									<span class="b-housing-complex__bl">{{obj.getStoreysCount()}} этажей</span>
								</span>
								{% endif %}
								{% if obj.getIsFz214() == 1 %}
		                        	<span>&nbsp;</span>
		                        	<div class="b-gcard__check">ФЗ-214</div>
								{% endif %}
                            </div>
                        </div>
                    </div>
            </div>
			{% if obj.getAds() is not empty %}
            <div class="row b-housing-complex__block">
                    <div class="col-xxs-20">
                        <p class="b-housing-complex__caption b-typo__h2">Квартиры в наличии:</p>
                        <div class="b-housing-complex__row">
						{%- for ads in obj.getAds()-%}
                            <div class="col-xxs-20 col-sm-10 col-lg-5 no-p">
                                <div class="b-housing-complex__aparts">
                                    {{ads['total_room_count']}}-комнатные
                                    <span class="b-housing-complex__sq">от {{ads['min_total_square']}}</span> м<sup>2</sup>
                                    <div class="b-housing-complex__price">от
					<span class="b-housing-complex__priceMin"><?php echo round($ads['min_price']/1000000)?></span>
					 до <span class="b-housing-complex__priceMax"><?php echo round($ads['max_price']/1000000)?></span> млн. руб.
									</div>
                                </div>

                            </div>
							{%- endfor -%}
                        </div>
                    </div>
                </div>
			{% endif %}
	</div>
	{% if obj.getGeoLatitude() is not empty and obj.getGeoLongitude() is not empty%}
	<div class="col-xxs-20 col-lg-16 b-housing-complex__wrap b-housing-complex__wrap-map">
           <div class="row b-housing-complex__block">
                    <div class="col-xxs-20-sm-20 col-md-20 col-lg-20">
                        <p class="b-housing-complex__caption b-typo__h2 b-housing-complex__caption-map">Жилой комплекс на карте</p>
                            <div class="b-housing-complex__map" id="map_card" data-latitude="{{obj.getGeoLatitude()}}" data-longitude="{{obj.getGeoLongitude()}}" data-name="{{obj.getName()}}"></div>
                    </div>
            </div>
         </div>
        {% endif %}
		<div class="col-xxs-20 col-lg-16 b-housing-complex__wrap">
			{% if obj.getDeveloper()|length > 0%}
            <div class="row b-housing-complex__block">
                <div class="col-xxs-20">
                    <p class="b-housing-complex__caption b-typo__h2">Застройщик</p>
                    <div class="b-housing-complex__builderInfo row">
                        <div class="col-xxs-20 col-md-4">
                            <div class="b-housing-complex__builderPic {% if obj.getDeveloper()['icon']|length <= 0 %}b-gcard__photos-nophoto{% endif %}"
                                    {% if obj.getDeveloper()['icon']|length > 0 %} style="background-image: url({{ obj.getDeveloper()['icon'] }})" {% endif %}
                            ></div>
                        </div>
                        <div class="col-xxs-20 col-md-16  b-housing-complex__builderDescription ">
                            <span class="b-housing-complex__builderCaption">{{ obj.getDeveloper()['name'] }}</span>
                            <div class="b-housing-complex__builderDesc">{{obj.getDeveloper()['description']}}</div>
                            <a href="/baza-zastroyshchikov/{{obj.getDeveloper()['slug']}}" class="b-housing-complex__showMore">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
		{% endif %}
            </div>
            <div class="row b-housing-complex__block">
                <div class="col-xxs-20 col-lg-16 b-housing-complex__wrap">
                    <div class="row">
		{% if obj.getNote() is not empty %}
                        <div class="col-xxs-20 col-lg-10">
                            <div class="b-housing-complex__half">
                                <p class="b-housing-complex__caption b-typo__h2">Описание Жилого комплекса</p>
                                <div class="b-housing-complex__gkDescription">
                                    	<p>{{obj.getNote()}}</p>
                                   	 <a href="" class="b-housing-complex__showMore">Подробнее</a>

                                </div>
                            </div>
                        </div>
		{% endif %}
                        {# <div class="col-xxs-20 col-lg-10">
                            <div class="b-housing-complex__half">
                                <p class="b-housing-complex__caption b-typo__h2">Акции</p>
                                <div class="b-housing-complex__sale">
                                   <span class="b-housing-complex__saleHead"><span class="b-housing-complex__red">Скидка 7% </span>на элитные квартиры</span>
                                    <p class="b-housing-complex__salebody">Самая бюджетная по цене 3-комн. квартира в готовой части комплекса – на 3 этаже корпуса Дом введен в эксплуатацию в 2014 году и заселяется. На квартиру оформлено право собственности.
                                    </p>
                                </div>
                                <div class="b-housing-complex__sale">
                                    <span class="b-housing-complex__saleHead"><span class="b-housing-complex__red">Повышение цен </span>с 12 октября</span>
                                    <p class="b-housing-complex__salebody">В портфеле проектов – элитный жилой комплекс "Одиннадцать Станиславского", офисный комплекс класса А "Луч", офисно-жилой комплекс класса А
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>#}
                </div>
            </div>
            {#<div class="row b-housing-complex__block">
                <p class="b-housing-complex__caption b-typo__h2">Ипотека</p>
                <div class="row">
                    <div class="col-xxs-20 col-sm-10  col-lg-5 bankLogo b0"></div>
                    <div class="col-xxs-20 col-sm-10  col-lg-5 bankLogo b1"></div>
                    <div class="col-xxs-20 col-sm-10  col-lg-5 bankLogo b2"></div>
                    <div class="col-xxs-20 col-sm-10  col-lg-5 bankLogo b3"></div>
                    <div class="col-xxs-20 col-sm-10  col-lg-5 bankLogo b4"></div>
                    <div class="col-xxs-20 col-sm-10  col-lg-5 bankLogo b5"></div>
                </div>
            </div>#}
            {% if similar.getObjects()|length > 0  %}
             <div class="col-xxs-20 col-lg-16 b-housing-complex__wrap">
                    <div class="row b-housing-complex__block">
                            <p class="b-housing-complex__caption b-typo__h2">Похожие объекты рядом ({{similar.totalCount()}})</p>
                                    {%- for adv in similar.getObjects() -%}
                                        {{ partial('housing_complex/_card', ['adv': adv]) }}
                                    {% endfor %}
                    </div>
                </div>
           {% endif %}
           {% if ads_similar.getObjects()|length > 0  %}
           <div class="col-xxs-20 col-lg-16 b-housing-complex__wrap">                
                <div class="row b-housing-complex__block">
                    <p class="b-housing-complex__caption b-typo__h2">Похожие объекты на вторичном рынке  ({{ads_similar.totalCount()}})</p>
                        {%- for adv in ads_similar.getObjects() -%}
                            {{ partial('common/_card_secondary_buildings', ['adv': adv]) }}
                        {% endfor %}
                </div>
            </div>
           {% endif %}
           <div class="col-xxs-20 col-lg-16 b-housing-complex__wrap">  
               <div class="row b-housing-complex__block">
                    <div class="col-xxs-20 col-md-10">
                        <div class="b-housing-complex__reviews">
                            <p class="b-housing-complex__caption b-typo__h2"><a href="/baza-novostroek/zhk-{{obj.getSlug()}}/otzyvy" class="b-housing-complex__link">Отзывы   <span class="b-housing-complex__count"">{%- if advCollection is defined and advCollection.getObjects()|length > 0 -%}  ({{advCollection.totalCount()}})  {% else %} (0) {% endif %}</span></a></p>                      
                            

                            <div class="col-xxs-20">
                                <div class="b-housing-complex__review">
                            {%- if advCollection is defined and advCollection.getObjects()|length > 0 -%}
                                {% for adv in advCollection.getObjects() %}
                                    <div class="b-housing-complex__reviewText">{{adv.getText()}}</div>
                                    <div class="b-housing-complex__reviewAuthor">{{adv.getNameUser()}}</div>
                                    <a href="/baza-novostroek/zhk-{{obj.getSlug()}}/otzyvy">Все отзывы</a>                                
                                {%- endfor -%}
                                {% else %}
                                     К сожалению, нет ни одного отзыва
                                {% endif %}
                                </div>
                            
                            </div>

                        </div>
                    </div>
                </div>
                {# <div class="col-xxs-20 col-md-10">
                    <div class="b-housing-complex__saler">
                        <p class="b-housing-complex__caption b-typo__h2">Продавец</p>
                        <div class="b-housing-complex__developerLinks">
                            <div class="b-housing-complex__developerLink">
                                <a href="#">Шатер Девелопмент</a>
                            </div>
                            <div class="b-housing-complex__developerLink">
                                <a href="#">Шатер Девелопмент</a>
                            </div>
                            <div class="b-housing-complex__developerLink">
                                <a href="#">Шатер Девелопмент</a>
                            </div>
                            <div class="b-housing-complex__developerLink">
                                <a href="#">Шатер Девелопмент</a>
                            </div>
                            <div class="b-housing-complex__developerLink">
                                <a href="#">Шатер Девелопмент</a>
                            </div>
                        </div>
                    </div>
                </div>#}
            </div>
        </div>
</div>
    </div>
</div>
<div class="row">
                <button class="b-housing-complex__back">Назад</button>
                <button class="b-housing-complex__fav b-favourite" data-id="{{ obj.getId()}}" data-type="zhk">Добавить в избранное</button>
               {# <button class="b-housing-complex__save">Сохранить поиск</button>#}
</button>


</div>

</div>


<script>
$(document).ready(function(){
ymaps.ready(init);
function init() {
 var school_items = [],
            kindergartens_items = [],
            clinics_items = [],
            grocery_stores_items = [],
            cafe_items = [];

		{% if obj.getSimilarObject()|length > 0 %}
			{% for geoObjects in obj.getSimilarObject() %}
				switch ({{geoObjects['env_type_id']}}) {
				  case 1:
					school_items.push({
		                center: [["{{geoObjects['latitude']}}"],["{{geoObjects['longitude']}}"]],
		                name: "{{geoObjects['name']}}"
                	});
					break;
				  case 2:
					kindergartens_items.push({
                    	center: [["{{geoObjects['latitude']}}"],["{{geoObjects['longitude']}}"]],
		                name: "{{geoObjects['name']}}"
                	});
					break;
				  case 3:
					clinics_items.push({
                    	center: [["{{geoObjects['latitude']}}"],["{{geoObjects['longitude']}}"]],
		                name: "{{geoObjects['name']}}"
                	});
					break;
				  case 4:
					grocery_stores_items.push({
                    	center: [["{{geoObjects['latitude']}}"],["{{geoObjects['longitude']}}"]],
		                name: "{{geoObjects['name']}}"
                	});
					break;
				  case 5:
					cafe_items.push({
                    	center: [["{{geoObjects['latitude']}}"],["{{geoObjects['longitude']}}"]],
		                name: "{{geoObjects['name']}}"
                	});
					break;
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

			{% endfor %}
		{% endif %}


	var myMap = new ymaps.Map('map_card', {
            center: [{{obj.getGeoLatitude()}}, {{obj.getGeoLongitude()}}],
            zoom: 13,
            controls: []
        }, {
            searchControlProvider: 'yandex#search'
        });

        myMap.geoObjects.add(new ymaps.Placemark(myMap.getCenter(), {
            hintContent: "{{obj.getName()}}"
        }, {
            iconLayout: 'default#image',
            iconImageHref: '/i/placemark.png',
            iconImageSize: [50, 50],
            iconImageOffset: [-20, -47]
        }));

        myMap.behaviors.disable('scrollZoom');
	{% if obj.getSimilarObject()|length > 0 %}
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
        zoom_map(myMap);
   function zoom_map(){
        if(document.body.clientWidth <= 320){
            myMap.setZoom(16, {duration: 1000});
        }
    }

	{% endif %}
}
});
</script>
{%- endfor -%}
{%- endif -%}
{%- endblock -%}
