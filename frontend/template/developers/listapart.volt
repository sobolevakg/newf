{%- extends "base_card.volt" -%}
{%- block content -%}
    <div class="b-developers-show__container">
    <div class="b-listing__wrapper"> 
    {{- partial("common/breadcrumbs", ['advCollection': advCollection]) -}}
    <div class="b-listing b-listing__developers-full-card">			
	<div class="b-listing__tools">
            <div class="row">
		    <div class="col-xxs-10 col-sm-5">
			<div class="b-totalNumber"><b>{{ advCollection.totalCount() }}</b> {{ advCollection.totalCount()|trans(['квартира','квартиры','квартир','квартира'], false)  }}</div>
		    </div>
			
		</div>
            </div>
            <div class="b-listing__cols">
                <div class="b-listing__left">
                   {%- if advCollection is defined and advCollection.getObjects()|length > 0 -%}
	                        {%- for adv in advCollection.getObjects() -%}
		                        {{ partial('common/_card_apart', ['adv': adv]) }}
	                        {%- endfor -%}

                        {% endif %}
                </div>
                <div class="b-listing__sep"></div>
                <div class="b-listing__right">
                    <img src="/i/banners/test.jpg" width="100%" alt="">
                </div>
            </div>
            <div class="b-listing__pagination">{{- partial("common/pagination", ['paginator': advCollection.getPaginator(pageSize)]) -}}</div>
        </div>
    </div>
    </div>
{%- endblock -%}
