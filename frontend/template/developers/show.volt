{%- extends "base_card.volt" -%}
{%- block content -%}
    <div class="b-developers-show__container">
	{%- if object is defined and object.getObjects()|length > 0 -%}
		
		{% for obj in object.getObjects() %}
            {{- partial("common/breadcrumbs", ['advCollection': object]) -}}
			<div class="b-developers-show__content">
				<div class="b-developers-show__card">					
					<div class="b-developers-show__title b-typo__h3"><div class="b-developers-show__button-prev"><div>Назад</div></div>Информация о застройщике</div>
                                        <div class="b-developers-show__content-info">
					        <div class="b-developers-show__photo b-listing__photos {% if obj.getIcon()|length <= 0 %}b-gcard__photos-nophoto{% endif %}">
						        {% if obj.getIcon()|length > 0 %}
							            <img src="{{obj.getIcon()}}"/>
						        {% endif %}
					        </div>
					        <div class="b-developers-show__info">
						        <div class="b-developers-show__name b-typo__h1">{{obj.getName()}}</div>
						        <div class="b-developers-show__address b-typo__h2">{{obj.getAddress()}}</div>
						        <div class="b-developers-show__site">Официальный сайт: <a class="link-green" href="http://{{obj.getUrl()}}" target="_blank">{{obj.getUrl()}}</a></div>
						        <div class="b-developers-show__created_year">Год создания: {{obj.getCreatedYear()}}</div>
					        </div>
                                        </div>
                                        <div class="b-developers-show__phone">
						<span class="b-developers-show__phone-title">Показать телефон</span>
						<span class="b-developers-show__phone-show">{{obj.getPhone()}}</span>
					</div>
					<div class="b-developers-show__description">
                                                <div class="b-developers-show__note">
                                                        {{obj.getDescription()}}
                                                </div>
                                                        {% if obj.getDescription()|length > 500 %}
                                                                 <div class="b-developers-show__read-more">
                                                                        <div class="b-developers-show__showMore">Подробнее</div>
                                                                 </div>
                                                        {% endif %}
                                        </div>
					{%- if housing_complex_list is defined and housing_complex_list.getObjects()|length > 0 -%}
						<div class="b-developers-show__title b-typo__h3">
							<a href="/baza-zastroyshchikov/{{obj.getSlug()}}/novostroyki-kompanii" class="b-developers-show__link">Новостройки компании {{obj.getName()}}</a>
							<span class="b-developers-show__count"> ({% if housing_complex_list.getObjects()|length <= 0 %} 0 {% endif %}{% if housing_complex_list.getObjects()|length > 0 %}{{ housing_complex_list.totalCount() }}{% endif %})
                                                        </span>
                                                </div>                     

						<div class="b-developers-show__list-hc">
							{%- for adv in housing_complex_list.getObjects() -%}
									 {{ partial('housing_complex/_card', ['adv': adv]) }}
							{%- endfor -%}
						</div>	
{% endif %}		
                <div class="b-developers-show__title b-typo__h3">                            	
							<a href="/baza-zastroyshchikov/{{obj.getSlug()}}/otzyvy" class="b-developers-show__link">Отзывы о компании {{obj.getName()}}</a>
                
                           {%- if advCollection is defined and advCollection.getObjects()|length > 0 -%}
							<span class="b-developers-show__count"> ({{advCollection.totalCount()}})</span>
                </div>
                            <div class="b-review__list">
                             {% for adv in advCollection.getObjects() %}
                                     {{- partial("common/review", ['adv': adv]) -}}
                            {%- endfor -%}
                            </div>
                            {% else %}
                            <span class="b-developers-show__count"> (0)</span>
                            </div>
                            <div class="b-review__list-none">
                                К сожалению, нет ни одного отзыва
                            </div>
                            {% endif %}
                        </div>		
				
					<div class="b-developers-show__right">                    
						<img src="/i/banners/test.jpg" alt="" width="100%">                
					</div>				
				</div>
                               
		{%- endfor -%}
	
	{%- endif -%}
    </div>
{%- endblock -%}
