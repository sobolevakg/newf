{%- extends "base_card.volt" -%}
{%- block content -%}
    {%- if advCollection is defined and advCollection.getObjects()|length > 0 -%}
        {% for adv_card in advCollection.getObjects() %}
            <div class="container-fluid">
                {%- if adv_card.getPhotos() is not empty -%}
                    {{ partial('common/fotoramaTopSlider', ['photos': adv_card.getPhotos() ] ) }}
                {% endif %}
                {{- partial("common/breadcrumbs", ['advCollection': advCollection]) -}}
                <div class="row ">
                    <div class="col-xxs-20 col-lg-16 b-housing-complex__wrap">
                        <div class="row b-housing-complex__block">
                            <div class="b-typo__h3 b-housing-complex__caption">Информация о квартире</div>
                            <div class="row">
                                <div class="col-xxs-20 col-md-15">
                                    <div class="row">
                                        <div class="col-xxs-20">
                                            <h1>{{adv_card.getTotalRoomCount()}}-комнатная квартира</h1>
                                        </div>
                                        <div class="col-xxs-20">
                                            <h1>в {{adv_card.getHousingComplex()["name"]}}</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xxs-20">
                                            <div class="b-housing-complex__address b-typo__h2">
                                               {{adv_card.getAddress()}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxs-20 col-md-5 s">
                                    <div class="row">
                                        <div class="col-xxs-20">
                                            {% if adv_card.getPrice() > 0 %}
                                                <div class="b-housing-complex__price">
                                                    <span class="b-housing-complex__priceMax">{{ adv_card.getPriceFormat() }} руб.</span>
                                                </div> 
                                            {% endif %}
                                            {% if adv_card.getPriceUnit() > 0 %}
                                                <div class="b-housing-complex__price">
                                                    {{ adv_card.getPriceUnitFormat() }} руб. за м<sup>2</sup>
                                                </div> 
                                            {% endif %}
                                        </div>
                                    </div>
                                    {% if adv_card.getPhoneList()|length > 0 %} 
                                        <div class="row">
                                            <div class="col-xxs-20">
                                                <div class="b-housing-complex__showPhone">
                                                    <span class="b-housing-complex__phone-title">Показать телефон</span>
                                                    <span class="b-housing-complex__phone-show">{{ adv_card.getPhoneList()}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    {% endif %}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xxs-20 col-md-10 col-lg-8">
                                    <div class="b-housing-complex__infoBlock">                                    
                                    {% if adv_card.getGeoSubwayStationName() is not empty %}
                                        <div class="b-housing-complex__metro">
                                            <span class="b-housing-complex__metroName">{{adv_card.getGeoSubwayStationName()}}</span>
                                            <span class="b-housing-complex__metroTime">
					                        {% if adv_card.getGeoSubwayWalkAccess() is not empty %}
                                                ( {{adv_card.getGeoSubwayWalkAccess()}} минут пешком )
                                            {% endif %}
                                            {% if adv_card.getGeoSubwayTransportAccess() is not empty %}
                                                ( {{adv_card.getGeoSubwayTransportAccess()}} минут транспортом )
                                            {% endif %}
				                        </span></div>
                                    {% endif %}
                                        {% if adv_card.getGeoRailwayStationName() is not empty%}
                                            <span class="b-housing-complex__railway">Станция ЖД {{adv_card.getGeoRailwayStationName()}}
                                                <span class="b-housing-complex__railwayTime"></span>
				                            </span>
                                        {% endif %}
                                        {% if adv_card.getGeoMkadRemoteness() is not empty%}
                                            <span class="b-housing-complex__ringRoad">До МКАД
						                        <span class="b-housing-complex__ringroadLength">{{adv_card.getGeoMkadRemoteness()}} км </span>
					                        </span>
                                        {% endif %}
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xxs-20 col-md-10 col-lg-8">
                                    <div class="b-housing-complex__infoBlock">
                                        {% if adv_card.getStorey() > 0 %}
                                            <span class="b-housing-complex__title-info">Этаж:
									            <span class="b-housing-complex__bl"> {{ adv_card.getStorey()}} / {{ adv_card.getStoreyCount() }}</span>
								            </span>
                                        {% endif %}
                                        {% if adv_card.getWallMaterialTypeId() > 0 %}
                                        <span class="b-housing-complex__title-info">Тип дома:
									        <span class="b-housing-complex__bl"> {{ adv_card.getWallMaterialType() }}</span>
								        </span>
                                        {% endif %}
                                        {% if adv_card.getOwnershipTypeId() > 0 %}
                                            <span class="b-housing-complex__title-info">Тип продажи:
									<span class="b-housing-complex__bl"> {{ adv_card.getOwnershipType() }}</span>
								</span>
                                        {% endif %}
                                        {% if adv_card.getTotalSquare() is not empty %}
                                            <span class="b-housing-complex__title-info">Общая площадь:
									<span class="b-housing-complex__bl"> {{adv_card.getTotalSquare()}} м<sup>2</sup></span>
								</span>
                                        {% endif %}
                                        {% if adv_card.getLifeSquare() is not empty %}
                                            <span class="b-housing-complex__title-info">Площадь комнат:
									<span class="b-housing-complex__bl"> {{adv_card.getLifeSquare()}} м<sup>2</sup></span>
								</span>
                                        {% endif %}
                                        {% if adv_card.getLifeSquare() is not empty %}
                                            <span class="b-housing-complex__title-info">Жилая площадь:
									<span class="b-housing-complex__bl"> {{adv_card.getLifeSquare()}} м<sup>2</sup></span>
								</span>
                                        {% endif %}
                                        {% if adv_card.getKitchenSquare() is not empty %}
                                            <span class="b-housing-complex__title-info">Площадь кухни:
									            <span class="b-housing-complex__bl"> {{adv_card.getKitchenSquare()}} м<sup>2</sup></span>
								            </span>
                                        {% endif %}

                                    </div>
                                </div>
                                <div class="col-xxs-20 col-md-10 col-lg-7">
                                    <div class="b-housing-complex__infoBlock">
                                        {% if adv_card.getWaterClosetTypeId() > 0 %}
                                            <span class="b-housing-complex__title-info">Санузлов:
									<span class="b-housing-complex__bl"> {{ adv_card.getWaterClosetType() }}</span>
								</span>
                                        {% endif %}
                                        {% if adv_card.getBalconyTypeId() > 0 %}
                                        <span class="b-housing-complex__title-info">Балкон:
									        <span class="b-housing-complex__bl">{{ adv_card.getBalconyType() }}</span>
								        </span>
                                        {% endif %}
                                        {% if adv_card.getElevatorTypeId() > 0 %}
                                            <span class="b-housing-complex__title-info">Лифт:
									            <span class="b-housing-complex__bl">{{ adv_card.getElevatorType() }}</span>
								            </span>
                                        {% endif %}
                                        {% if adv_card.getPhoneLineTypeId() > 0 %}
                                            <span class="b-housing-complex__title-info">Телефон:
									            <span class="b-housing-complex__bl">{{adv_card.getPhoneLineType()}}</span>
								            </span>
                                        {% endif %}
                                        {% if adv_card.getWindowOverlookTypeId() > 0 %}
                                            <span class="b-housing-complex__title-info">Вид из окна:
									<span class="b-housing-complex__bl">{{ adv_card.getWindowOverlookType() }}</span>
								</span>
                                        {% endif %}
                                        {% if adv_card.getApartmentConditionTypeId() > 0 %}
                                            <span class="b-housing-complex__title-info">Ремонт:
									<span class="b-housing-complex__bl">{{adv_card.getApartmentConditionType()}}</span>
								</span>
                                        {% endif %}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {% if adv_card.getAddress() is not empty %}
                    <div class="col-xxs-20 col-lg-16 b-housing-complex__wrap b-housing-complex__wrap-map">
                        <div class="row b-housing-complex__block">
                            <div class="col-xxs-20-sm-20 col-md-20 col-lg-20">
                                <p class="b-housing-complex__caption b-typo__h2 b-housing-complex__caption-map">Квартира на карте</p>
                                <div class="b-housing-complex__map" id="map_card_apart" data-address="{{adv_card.getAddress()}}"></div>
                            </div>
                        </div>
                    </div>
                    {% endif %}
                    {% if adv_card.getNote() is not empty OR adv_card.getHousingComplex()['note'] is not empty%}
                    <div class="row">
                        <div class="col-xxs-20 col-lg-16 b-housing-complex__wrap">
                            <div class="row">
                                {% if adv_card.getNote() is not empty %}
                                    <div class="col-xxs-20 col-lg-10">
                                        <div class="b-housing-complex__half">
                                            <p class="b-housing-complex__caption b-typo__h2">Описание квартиры</p>
                                            <div class="b-housing-complex__gkDescription">
                                                <p>{{adv_card.getNote()}}</p>
                                                <a href="" class="b-housing-complex__showMore">Подробнее</a>

                                            </div>
                                        </div>
                                    </div>
                                {% endif %}
                                {% if adv_card.getHousingComplex() is not empty AND adv_card.getHousingComplex()['note'] is not empty %}
                                <div class="col-xxs-20 col-lg-10">
                                    <div class="b-housing-complex__half">
                                        <p class="b-housing-complex__caption b-typo__h2">Описание Жилого комплекса</p>
                                        <div class="b-housing-complex__gkDescription">
                                            <p>{{adv_card.getHousingComplex()['note']}}</p>
                                            <a href="" class="b-housing-complex__showMore">Подробнее</a>

                                        </div>
                                </div>
                            </div>
				              {% endif %}
                            </div>
                        </div>
                        {% endif %}
                        {% if obj_similar.getObjects()|length > 0  %}
                            <div class="col-xxs-20 col-lg-16 b-housing-complex__wrap">
                                <div class="row b-housing-complex__block">
                                    <p class="b-housing-complex__caption b-typo__h2">{{adv_card.getTotalRoomCount()}} комнатные квартиры на вторичном рынке  ({{obj_similar.totalCount()}})</p>
                                    {%- for similar in obj_similar.getObjects() -%}
                                        {{ partial('common/_card_secondary_buildings', ['adv': similar]) }}
                                    {% endfor %}
                                </div>
                            </div>
                        {% endif %}

                    </div>
                </div>
            </div>
              <div class="col-xxs-20 col-lg-16 b-housing-complex__wrap b-housing-complex__back-to-card">
                <div class="b-housing-complex__backtrack">
                    <a href="/baza-novostroek/zhk-{{adv_card.getHousingComplex()['slug']}}">Вернуться на карточку ЖК</a></div>
                </div>
              </div>
            <div class="row">
                <button class="b-housing-complex__back">Назад</button>
                <button class="b-housing-complex__fav b-favourite" data-id="{{ adv_card.getId()}}" data-type="flat">Добавить в избранное</button>
                {# <button class="b-housing-complex__save">Сохранить поиск</button>#}

            </div>
          
        {%- endfor -%}
    {% endif %}
{%- endblock -%}

