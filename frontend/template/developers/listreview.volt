{%- extends "base_card.volt" -%}
{%- block content -%}
    <div class="b-developers-show__container">
{%- if object is defined and object.getObjects()|length > 0 -%}
{{- partial("common/breadcrumbs", ['object': object]) -}}
	<div class="b-developers-show__content">
    <div class="b-developers-show__card">
        {% for obj in object.getObjects() %}	        
		    <div class="b-developers-show__title b-typo__h3 b-developers-show__title-review">
            <div class="b-developers-show__button-prev"><div>Назад</div></div>
                Отзывы о {{obj.getName()}}
            </div>
            <div class="b-developers-show__button-review b-review"   data-id="{{obj.getId()}}"  data-type="developers">Оставить отзыв</div>
        {%- endfor -%}
	    {%- if advCollection is defined and advCollection.getObjects()|length > 0 -%}
		    {%- if advCollection.totalCount() > 0 -%}            
            <div class="b-review__list">
		    {% for adv in advCollection.getObjects() %}
			        {{- partial("common/review", ['adv': adv]) -}}
            {%- endfor -%}
                </div>
			    <div class="b-listing__pagination">{{- partial("common/pagination", ['paginator': advCollection.getPaginator(pageSize)]) -}}</div>
		    {%- endif -%}
		    {%- elseif advCollection is defined and advCollection.getObjects()|length < 1 -%}
				<div class="b-developers-show__review-container">Не найдено ни одного отзыва</div>
		    {%- endif -%}
	</div>
    {%- endif -%}
    </div>
    </div>
{%- endblock -%}
