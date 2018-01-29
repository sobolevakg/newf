{%- extends "base_card.volt" -%}
{%- block content -%}
    <div class="#content">
        {%- if advCollection is defined and advCollection.getObjects()|length > 0 and ads is defined and ads.getObjects()|length -%}
        {% for adv in advCollection.getObjects() %}
        	{%- if adv.getPhotos() is not empty -%}
            		{{ partial('common/fotoramaTopSlider', ['photos': adv.getPhotos() ] ) }}
        	{% endif %}
        {{- partial("common/breadcrumbs", ['advCollection': advCollection]) -}}
        <div class="row ">
            <div class="col-xxs-20 col-lg-16 b-housing-complex__wrap">
                <div class="row b-housing-complex__block">
                    <div class="b-typo__h3 b-housing-complex__caption">Информация о квартирах</div>
                    <div class="row">
                        <div class="col-xxs-20 col-md-15">
                            <div class="row">
                                <div class="col-xxs-20">
                                    <div class="b-typo__h1">Квартиры на вторичном рынке в {{ adv.getName() }} </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xxs-20">
                                    <div class="b-housing-complex__address b-typo__h2">
                                        {{ adv.getAddress() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxs-20 col-md-5 s">
                            <div class="row">
                                <div class="col-xxs-20">
                                    {% if adv.getPriceMin() > 0  OR adv.getPriceMax() > 0 %}
                                        <div class="b-housing-complex__price">
                                            от <span class="b-housing-complex__priceMin">{{ '%d'|format(adv.getPriceMin()/1000000) }}</span>
                                            до<span class="b-housing-complex__priceMax">{{ '%d'|format(adv.getPriceMax()/1000000) }}</span> млн. руб.
                                        </div>
                                    {% endif %}
                                    {% if adv.getTotalSquareMin() > 0  OR adv.getTotalSquareMax() > 0 %}
                                        <div class="b-housing-complex__sq">
                                            от <span class="b-housing-complex__sqMin">{{ '%d'|format(adv.getTotalSquareMin()) }}</span>
                                            до <span class="b-housing-complex__sqMax">{{ '%d'|format(adv.getTotalSquareMax()) }}</span> м<sup>2</sup>
                                        </div>
                                    {% endif %}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxs-20 b-housing-complex__wrap b-housing-complex__room-search">
                        <div class="b-housing-complex__check">
                            <input type="checkbox" name="rooms" value="1" class="b-housing-complex__checkbox">
                            <span class="b-housing-complex__checkbox-custom"></span>
                            <span class="b-housing-complex__label-checkbox">1-комнатная</span>
                        </div>
                        <div class="b-housing-complex__check">
                            <input type="checkbox" name="rooms" value="2" class="b-housing-complex__checkbox">
                            <span class="b-housing-complex__checkbox-custom"></span>
                            <span class="b-housing-complex__label-checkbox">2-комнатная</span>
                        </div>
                        <div class="b-housing-complex__check">
                            <input type="checkbox" name="rooms" value="3" class="b-housing-complex__checkbox">
                            <span class="b-housing-complex__checkbox-custom"></span>
                            <span class="b-housing-complex__label-checkbox">3-комнатная</span>
                        </div>
                        <div class="b-housing-complex__check">
                            <input type="checkbox" name="rooms" value="4" class="b-housing-complex__checkbox">
                            <span class="b-housing-complex__checkbox-custom"></span>
                            <span class="b-housing-complex__label-checkbox">4-комнатная</span>
                        </div>
                        <div class="b-housing-complex__check">
                            <input type="checkbox" name="rooms" value="5" class="b-housing-complex__checkbox">
                            <span class="b-housing-complex__checkbox-custom"></span>
                            <span class="b-housing-complex__label-checkbox">5-комнатная</span>
                        </div>
                        <div class="b-housing-complex__check">
                            <input type="checkbox" name="rooms" value="0" class="b-housing-complex__checkbox">
                            <span class="b-housing-complex__checkbox-custom"></span>
                            <span class="b-housing-complex__label-checkbox">Студия</span>
                        </div>
                        <div class="b-housing-complex__check">
                            <input type="checkbox" name="floor" value="1" class="b-housing-complex__checkbox">
                            <span class="b-housing-complex__checkbox-custom"></span>
                            <span class="b-housing-complex__label-checkbox">Не первый</span>
                        </div>
                        <div class="b-housing-complex__check">
                            <input type="checkbox" name="floor" value="0" class="b-housing-complex__checkbox">
                            <span class="b-housing-complex__checkbox-custom"></span>
                            <span class="b-housing-complex__label-checkbox">Не последний</span>
                        </div>
                    </div>
                    <div class="col-xxs-20 b-housing-complex__wrap b-housing-complex__button-search-full">
                        <div class="b-housing-complex__button-search">Похожие объекты на вторичном рынке</div>
                        <div class="b-housing-complex__button-search">Похожие объекты рядом</div>
                        <div class="b-housing-complex__button-search">Изменить условия поиска</div>
                    </div>
                    <div class="b-housing-complex__apartments-table-content">
                        <table class="b-housing-complex__apartments-table-full">
                            <thead>
                            <tr>
                                <th class="sort header"><b>Комнат </b></th>
                                <th class="sort header"><b>Площадь </b></th>
                                <th class="sort header"><b>Этажность </b></th>
                                <th class="float-right sort header"><b>Цена</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            {%- endfor -%}
                            {% for apart in ads.getObjects() %}
                                {{ partial('housing_complex/_card_secondary_buildings', ['apart': apart, 'obj' : adv]) }}
                            {%- endfor -%}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <button class="b-housing-complex__back">Назад</button>
                <button class="b-housing-complex__fav b-favourite" data-id="{{ adv.getId() }}" data-type="zhk">Добавить в избранное</button>
                {# <button class="b-housing-complex__save">Сохранить поиск</button>#}
                </button>


            </div>
            {%- endif -%}
        </div>
{%- endblock -%}
