;(function ($) {
    $.fn.extend({
        makeHeightEqualTo: function (options) {
            this.defaultOptions = {};
            var settings = $.extend({}, this.defaultOptions, options);
            var elem = $(options);
            var h = elem.outerHeight();
            return this.each(function () {
                var $this = $(this);
                var _h = $(this).outerHeight();
                var height = Math.max(h, _h);

                elem.css('min-height', height);
                $this.css('min-height', height);
            });
        }
    });
})(jQuery);

;(function ($) {
    $.fn.extend({
        adaptiveMenu: function (options) {
            this.defaultOptions = {};
            var settings = $.extend({}, this.defaultOptions, options);
            var menu = $(this);
            var close = menu.find('[adaptive-menu-close]');
            if (close) {
                $(close).on('click', function () {
                    "use strict";
                    menu.addClass('hidden');
                });
            }
            var open = $('[adaptive-menu-open]');
            if (open) {
                $(open).on('click', function () {
                    "use strict";
                    menu.removeClass('hidden');
                });
            }
        }
    });
})(jQuery);

;(function ($) {
    $.fn.extend({
        favourite: function () {
            let selectedClass = 'selected';

            function getCookieName(type) {
                "use strict";
                return 'fav-' + type;
            }

            function getIds(type) {
                "use strict";
                let ids = [];
                let val = Cookies.get(getCookieName(type));
                if (val && val.length > 0) {
                    ids = $.trim(val).split(';').map(el => parseInt(el));
                }
                return ids;
            }

            function has(id, type) {
                "use strict";
                let ids = getIds(type);
                return ids.indexOf(id) !== -1;
            }

            function add(id, type) {
                "use strict";
                let ids = getIds(type);
                if (ids.indexOf(id) === -1) {
                    ids.push(id);
                }
                Cookies.set(getCookieName(type), ids.join(';'), {expires: 365});
                return ids;
            }

            function remove(id, type) {
                "use strict";
                let ids = getIds(type);
                let idx = ids.indexOf(id);
                if (idx !== -1) {
                    ids.splice(idx, 1);
                }

                Cookies.set(getCookieName(type), ids.join(';'), {expires: 365});
                return ids;
            }

            return this.each(function () {
                let $this = $(this);
                let type = $this.data('type');
                let id = $this.data('id');

                if (has(id, type)) {
                    $this.addClass(selectedClass);
                }

                $this.on('click', function () {
                    "use strict";
                    if (has(id, type)) {
                        remove(id, type);
                        $this.removeClass(selectedClass);
                    } else {
                        add(id, type);
                        $this.addClass(selectedClass);
                    }
                });
            });
        }
    });
})(jQuery);

;(function ($) {
    $.fn.extend({
        dialog: function (options, text) {
            var $this = $(this);
            options = $.extend( {
              'background-color' : '#c7f6c2',
              'width' : '200px',
              'height' : '50px',
              'color' : '#000'
            }, options);


            $this.append("<div class='b-modal__modal'><div class='b-modal__dialog'><div class='b-modal__modal-close'>&times;</div></div></div>");
            var $obj = $this.find('.b-modal__dialog'),
                $modal = $this.find('.b-modal__modal');
            
            if($obj){
                $obj.css(options);
                $obj.append('<div class="b-modal__text">' + text + '</div>');
                $obj.find('.b-modal__modal-close').click(function(){
                    $modal.remove();
                });
            }
        }
    });
})(jQuery);
