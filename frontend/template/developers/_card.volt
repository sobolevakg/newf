<div class="b-gcard">
    <div class="b-gcard__inner">
        <div class="b-gcard__main">
            <div class="b-listing__photos {% if adv.getIcon()|length <= 0 %}b-gcard__photos-nophoto{% endif %}">
                {% if adv.getIcon()|length > 0 %}
                    <img src="{{ adv.getIcon() }}"/>
                {% endif %}
            </div>
            <div class="b-gcard__info  b-listing__info-card">
                <div class="b-gcard__info__cols">
                    <div class="b-gcard__info__cols__left">
                        <a href="baza-zastroyshchikov/{{ adv.getSlug() }}" class="b-gcard__title">{{ adv.getName() }}</a>
                        <p class="b-gcard__address">{{ adv.getAddress() }}</p>
                        <div class="spacer"></div>

                    </div>
                </div>
                <div class="b-gcard__info__desc">
                    <div class="b-listing__toollink b-listing__developer-info-left">
                        <a class="link-green" href="/baza-zastroyshchikov/{{adv.getSlug()}}/otzyvy">{{adv.getReviewCount()}}</a>
                    </div>
                    <div class="b-listing__toollink b-listing__developer-info-left b-listing__border-left">
                        {% if adv.getCountSell() > 0 %}
                            <a class="link-green" href="/baza-zastroyshchikov/{{adv.getSlug()}}/kvartiry-v-prodazhe">{{ adv.getCountSell() }} в продаже</a>
                        {% endif %}
                    </div>
                </div>
                <div class="b-gcard__bottom b-listing__hc-list">
                    <div class="b-gcard__tools b-listing__list_hc">
                        {% if adv.getHousingComplexList()|length > 0 %}
                            {% for housing_complex_list in adv.getHousingComplexList()['list'] %}
                                <div class="b-listing__href-hc">
                                    <a class="link-green" href="baza-novostroek/zhk-{{ housing_complex_list.slug }}">{{ housing_complex_list.name }}</a>
                                </div>
                            {% endfor %}
                            {% if adv.getHousingComplexList()['count'] > 0 %}
                                {{ partial('common/countHousingComplexForDevelopers', ['adv': adv]) }}
                            {% endif %}
                        {% endif %}
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
