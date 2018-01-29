{%- extends "base.volt" -%}
{%- block content -%}
    <div class="b-listing__wrapper">
        {{- partial("common/breadcrumbs") -}}
        <div class="b-listing b-listing__developers-full-card">
            <div class="b-listing__tools">
                <div class="row">
                    <div class="col-xxs-10 col-sm-5">
                        <div class="b-totalNumber"><b>{{ advCollection.totalCount() }}</b> застройщиков</div>
                    </div>
                    <div class="col-xxs-20 col-sm-15 text-right toolSelects">
                        <div class="pull-right">
                            <select nice name="pageSize" id="pageSizeSelect">
                                <option value="10">Выводить по: 10</option>
                                <option value="20">Выводить по: 20</option>
                                <option value="50">Выводить по: 50</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="b-listing__cols">
                <div class="b-listing__left">
                    <input class="b-listing__developers-search" placeholder="Найти застройщика">
                    <button class="b-listing__developers-search-button"></button>
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
