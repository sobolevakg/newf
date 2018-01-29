<div class="b-gcard">
    <div class="b-gcard__inner">
        <div class="b-gcard__main">
            <div class="b-gcard__photos {% if adv.getPhotos()|length <= 0 %}b-gcard__photos-nophoto{% endif %}">
                {% if adv.getPhotos()|length > 0 %}
                    <div class="fotorama" data-nav="thumbs" data-thumbheight="40" data-height="200" data-fit="cover">
                        {% for photo in adv.getPhotos() %}
                            <a href="{{ photo }}"></a>
                        {% endfor %}
                    </div>
                    <div class="b-gcard__photoCount">
			<div class="b-gcard__photoPrev"></div>
			<div class="b-gcard__photoIndexAction"></div>
			<div class="b-gcard__photoAdvert"></div>
			<div class="b-gcard__photoIndexCount"></div>
			<div class="b-gcard__photoNext"></div>
		   </div>
                {% endif %}
            </div>
            <div class="b-gcard__info">
                <div class="b-gcard__info__cols">
                    <div class="b-gcard__info__cols__left">
                        <a href="/baza-novostroek/zhk-{{adv.getSlug()}}" class="b-gcard__title">{{ adv.getName() }}</a>
                        <p class="b-gcard__address">{{ adv.getAddress() }}</p>
                        <div class="spacer"></div>
                        {% if not adv.getGeoSubwayStationName() is empty %}
                            
                            <p class="b-gcard__subway">
                                <a href="{{ adv.getSearchUrlBySubwayStation() }}">{{ adv.getGeoSubwayStationName() }}</a>
                                {% if adv.getGeoSubwayWalkAccess() > 0 %}
                                    <span>({{ adv.getGeoSubwayWalkAccess() }} мин. пешком)</span>
                                {% elseif adv.getGeoSubwayTransportAccess() > 0 %}
                                    <span>({{ adv.getGeoSubwayTransportAccess() }} мин. транспортом)</span>
                                {% endif %}
                            </p>
                        {% endif %}
                        {% if not adv.getGeoRailwayStationName() is empty %}
                            <p class="b-gcard__subway">
                                Станция {{ adv.getGeoRailwayStationName() }}
                            </p>
                        {% endif %}
                        {% if adv.getMkadRemoteness() > 0 %}
                            <p>До МКАД <span>{{ adv.getMkadRemoteness() }}</span></p>
                        {% endif %}
                        {% if adv.getConstructionStage() > 0 %}
                            <div class="b-gcard__progressbar">Этап строительства
                                <div>{{ partial('common/progressBar', ['percent': adv.getConstructionStage()]) }}</div>
                            </div>
                        {% endif %}
                        <div class="spacer"></div>
                        {% if adv.getDeveloper()|length > 0 %}
                            <p>Застройщик: <a href="{{ adv.getUrlForDeveloper() }}">{{ adv.getDeveloper()['name'] }}</a></p>
                        {% endif %}
                        {% if not adv.getHousingComplexStatusName() is empty %}
                            <p>ГК: {{ adv.getHousingComplexStatusName() }}</p>
                        {% endif %}
                    </div>
                    <div class="b-gcard__info__cols__right">
                        {% if adv.getPriceFrom() > 0 OR adv.getPriceTo() > 0 %}
                            <div class="b-gcard__price">
                                {% if adv.getPriceFrom() > 0 %}
                                    от <span>{{ '%d'|format(adv.getPriceFrom() / 1000000) }}</span>
                                    {% if not adv.getPriceTo() %}
                                        млн. руб.
                                    {% endif %}
                                {% endif %}
                                {% if adv.getPriceTo() > 0 %}
                                    до <span>{{ '%d'|format(adv.getPriceTo() / 1000000) }}</span> млн. руб.
                                {% endif %}
                            </div>
                        {% endif %}
                        {% if adv.getTotalSquareFrom() > 0 OR adv.getTotalSquareTo() > 0 %}
                            <div class="b-gcard__square">
                                {% if adv.getTotalSquareFrom() > 0 %}
                                    от <span>{{ '%d'|format(adv.getTotalSquareFrom()) }}</span>
                                    {% if not adv.getTotalSquareTo() %}
                                        м<sup>2</sup>
                                    {% endif %}
                                {% endif %}
                                {% if adv.getTotalSquareTo() > 0 %}
                                    до <span>{{ '%d'|format(adv.getTotalSquareTo()) }}</span> м<sup>2</sup>
                                {% endif %}
                            </div>
                        {% endif %}
                    </div>
                </div>
                <div class="b-gcard__info__desc">
                    {% if not adv.getNote() is empty %}
                        <div class="b-gcard__note">{{ adv.getNote() }}</div>
                    {% endif %}
                </div>
            </div>
        </div>
        <div class="b-gcard__bottom">
            <div class="b-gcard__tools">
                <div class="b-gcard__fzcheck">
                    {% if adv.getIsFz214() == 1 %}
                        <div class="b-gcard__check">ФЗ-214</div>
                    {% endif %}
                </div>
                <div class="b-gcard__toollink">
                    {#<a class="link-green" href="#">N квартир от застройщика</a>#}
                </div>
		{% if adv.getSecondAdvsCount() > 0 %}
                <div class="b-gcard__toollink">
                        <a class="link-gray nowrap b-gcard__secondary" href="baza-novostroek/zhk-{{adv.getSlug()}}/vtorichnoe-zhile"> {{ adv.getSecondAdvsCount()|trans(['квартира','квартиры','квартир','квартира']) }} на вторичном рынке</a>
			<div class="b-gcard__question"></div>
                </div>
                {% endif %}
            </div>
            <div class="b-gcard__buttons">
                <div class="b-gcard__map">
                    <div class="b-mapButton" data-latitude="{{adv.getGeoLatitude()}}" data-longitude="{{adv.getGeoLongitude()}}" data-address="{{adv.getAddress()}}" data-name="{{adv.getName()}}" title="Показать на карте"></div>
                </div>
                <div class="b-gcard__favourites">
                    <div class="b-favourite"  data-id="{{ adv.getId()}}" data-type="zhk" title="Добавить в избранное"></div>
                </div>
            </div>
        </div>
    </div>
</div>
