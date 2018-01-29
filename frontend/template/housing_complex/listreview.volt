{%- extends "base_card.volt" -%}
{%- block content -%}
    <div class="b-housing-complex__container">
    {%- if object is defined and object.getObjects()|length > 0 -%}
{{- partial("common/breadcrumbs", ['advCollection': advCollection]) -}}
	<div class="b-housing-complex__content">
    <div class="b-housing-complex__review-content">
        {% for obj in object.getObjects() %}
             <button class="b-housing-complex__back b-housing-complex__back-review">Назад</button>	        
		    <div class="b-typo__h3 b-housing-complex__title-review">
                Отзывы о {{obj.getName()}}
            </div>
            <div class="b-housing-complex__button-review b-review"   data-id="{{obj.getId()}}"  data-type="housing_complex">Оставить отзыв</div>
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
				<div class="b-housing-complex__review-container">Не найдено ни одного отзыва</div>
		    {%- endif -%}
	</div>
    {%- endif -%}
    </div>
    </div>
{%- endblock -%}
