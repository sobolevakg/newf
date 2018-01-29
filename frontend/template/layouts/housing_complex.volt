{%- extends "base.volt" -%}
{%- block content -%}
    <div class="b-listing__wrapper">
        {{- partial("common/breadcrumbs") -}}
        <div class="b-listing">
            <div class="b-listing__tools">
                {{ partial('common/listingTools') }}
            </div>
            <div class="b-listing__cols">
                <div class="b-listing__left">
                    {{ content() }}
                </div>
                <div class="b-listing__sep"></div>
                <div class="b-listing__right">
                    <img src="/i/banners/test.jpg" width="100%" alt="">
                </div>
            </div>
            <div class="b-listing__pagination">{{- partial("common/pagination", ['paginator': advCollection.getPaginator(pageSize)]) -}}</div>
        </div>
    </div>
{%- endblock -%}

