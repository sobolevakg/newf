{%- if advCollection is defined and advCollection.getObjects()|length > 0 -%}
    <div>
        {%- if advCollection.totalCount() > 0 -%}
            {%- for adv in advCollection.getObjects() -%}
                {{ partial('developers/_card', ['adv': adv]) }}
            {%- endfor -%}
	      {%- endif -%}
    </div>
{%- elseif advCollection is defined and advCollection.getObjects()|length < 1 -%}
		 По вашему запросу не найден ни один застройщик.
{%- endif -%}

      
