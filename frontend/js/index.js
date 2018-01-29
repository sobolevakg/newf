function mapsSelectorEnable() {
    let tabs = $('.b-map-nav li');
    let selectedId = $('.b-map-nav li.selected a').data('target');
    if (selectedId) {
        $('#' + selectedId).show();
    }
    tabs.find('a').on('click', function (e) {
        let target = $(this).data('target');
        $('.b-maps > .b-maps__map').hide();
        $('#' + target).show();
        tabs.removeClass('selected');
        $(this).parent().addClass('selected');
        return false;
    });
}

(function () {

    mapsSelectorEnable();
    if (window.outerWidth >= 1200) {
        $('#index-tile-maps').makeHeightEqualTo('#index-tile-rubriks');
    }

    let menu = $('#menuAdaptive').adaptiveMenu();
    $('select[nice]').niceSelect();
    $(window).resize(function () {
        "use strict";
        if (window.outerWidth < 1200) {
            $('#index-tile-maps, #index-tile-rubriks').css('min-height', 'auto');
        } else {
            $('#index-tile-maps').makeHeightEqualTo('#index-tile-rubriks');
        }
    });

    $('#pageSizeSelect').on('change', function () {
        Cookies.set('pageSize', parseInt($(this).val()), {expires: 30});
        if (window.location.href != window.location.href.replace(/&?page\=\d+/i, '')) {
            window.location.href = window.location.href.replace(/&?page\=\d+/i, '');
        } else {
            window.location.reload(true);
        }
    });

})();

/*
************************ INDEX maps hover script ******************
*/
$(document).ready(function () {
    var obj = $('.b-maps__map').find('.mapNewMsk'),
        objhover = [];

    $("#newmsk #text .st5").mousemove(function() {
        objhover = '#' + $(this).attr('id') + '_fill';
        $(objhover).addClass('clicked');
        $(this).css('font-weight','bold');
        $(this).css('font-size','14px');
        $(this).mouseout(function() {
            $("#newmsk .st0").removeClass('clicked');
        });
        $(objhover).mouseout(function() {
            $("#newmsk .st0").removeClass('clicked');
            $("#newmsk #text .st5").css('font-weight','normal');
            $("#newmsk #text .st5").css('font-size','11px');

        });

    });

    $("#newmsk .st0").mousemove(function() {
        var hover_text = '#' + $(this).attr('id').replace('_fill','');
        $(hover_text).css('font-weight','bold');
        $(hover_text).css('font-size','14px');
        $(this).mouseout(function() {
            $(hover_text).css('font-weight','normal');
            $(hover_text).css('font-size','11px');
        });
    });


    var obj = $('.b-maps__map').find('.mapMSK'),
        objhover = '', objfull = '';

    $("#msk .textMap").mousemove(function() {
        $(this).css('font-weight','bold');
        $(this).css('font-size','18px');
        objfull = '#' + $(this).attr('data-name');
        objhover = '#' + $(this).attr('data-name') + ' .st0';
        $(objhover).addClass('clicked');
        $(objhover).mouseout(function() {
            $("#msk .st0").removeClass('clicked');
            $('#msk .textMap').css('font-weight','normal');
            $('#msk .textMap').css('font-size','16px');
        });
        $(this).mouseout(function() {
            $(".msk .st0").removeClass('clicked');
        });
    });
    $("#msk .hover_show").mousemove(function() {
        var hover_text = '#' + $(this).attr('id') +'_showon .textMap';
        $(hover_text).css('font-weight','bold');
        $(hover_text).css('font-size','18px');
        $(this).mouseout(function() {
            $(hover_text).css('font-weight','normal');
            $(hover_text).css('font-size','16px');
        });
    });

    var obj = $('.b-maps__map').find('.mapObl'),
        objhover = [];
    $("#obl #text .st5").mousemove(function() {
        objhover = '#' + $(this).attr('id') + '-r-n_fill';
        $(objhover).addClass('clicked');
        $(objhover).mouseout(function() {
            $("#obl .st0").removeClass('clicked');
        });
        $(this).mouseout(function() {
            $("#obl .st0").removeClass('clicked');
        });
    });

    $("#obl .st0, .st5").mousemove(function() {
        var hover_text = '#' + $(this).attr('id').replace('-r-n_fill',' ');
        $(hover_text).css('font-weight','bold');
        $(hover_text).css('font-size','14px');
        $(this).mouseout(function() {
            $(hover_text).css('font-weight','normal');
            $(hover_text).css('font-size','11px');
        });
    });
});