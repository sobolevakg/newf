{%- if advCollection is defined and advCollection.getObjects()|length > 0 -%}
    <div>
        {%- if advCollection.extendedSearch() -%}
            Объявления по запросу не найдены, но возможно мы нашли что-то подходящее.
        {%- endif -%}
        {%- if advCollection.totalCount() > 0 -%}
            {%- for adv in advCollection.getObjects() -%}		
                {{ partial('housing_complex/_card', ['adv': adv]) }}
            {%- endfor -%}
        {%- endif -%}
    </div>
{%- endif -%}
