$(document).ready(function () {
    $.fn.select2.defaults.set("language", "pt-BR");
});

$(document).on('ajaxPromise', function() {
    $('button').attr({'disabled': 'disabled'});
});

$(document).on('ajaxStart', function() {
    $('button').attr({'disabled': 'disabled'});
});

$(document).on('ajaxComplete', function() {
    $('button').removeAttr('disabled');
});

$(document).on('hide.bs.modal', function (event) {
    setTimeout(function () {
        if($(document).find('.control-popup.modal.fade[aria-hidden="true"]').length === 1 && $('body.modal-open').length === 1) {
            $('body').removeClass('modal-open');
            $(document).find('.control-popup.modal.fade[aria-hidden="true"]').remove();
        }
    }, 500);
});

function delay(callback, ms) {
    var timer = 0;
    return function () {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}

function removeSpecialChars(string) {
    var resto, acentos = [];
    acentos['a'] = /[ÁÀÂÃ]/gi;
    acentos['e'] = /[ÉÈÊ]/gi;
    acentos['i'] = /[ÍÌÎ]/gi;
    acentos['o'] = /[ÓÒÔÕ]/gi;
    acentos['u'] = /[ÚÙÛ]/gi;
    acentos['c'] = /[Ç]/gi;
    resto = /[^a-z0-9\-]+/gi;
    return string
        .replace(acentos['a'], 'a')
        .replace(acentos['e'], 'e')
        .replace(acentos['i'], 'i')
        .replace(acentos['o'], 'o')
        .replace(acentos['u'], 'u')
        .replace(acentos['c'], 'c')
        .replace(resto, '-').toLowerCase();
}

function find(item, query) {

    var valor = removeSpecialChars($.trim(query).replace(/([.?*+^$[\]\\(){}|-])/g, "\\$1"));
    var re = new RegExp(valor + '.*', 'gi');

    if (!valor.length) {
        return false;
    }

    return removeSpecialChars($.trim(item)).match(re);
}

$(document).ready(function () {

    $('[name="search-menu"]').keyup(delay(function () {
        var query = $(this).val();
        if (query) {
            var $items = $('.navbar-nav>.nav-item>div>.nav>li>a.nav-link');
            $.each($items, function (index, item) {
                var $item = $(item);
                if (find($item.text(), query)) {
                    $item.parent().show();
                } else {
                    $item.parent().hide();
                }
            });

            var $itemsSettings = $('#menu-settings > ul > div.nav-item > div.collapse > ul > li > a');
            $.each($itemsSettings, function (index, item) {
                var $item = $(item);
                if (find($item.text(), query)) {
                    $item.parent().show();
                } else {
                    $item.parent().hide();
                }
            });

            var $parent_items_setting = $('#menu-settings > ul.nav > div.nav-item>div.collapse');
            $.each($parent_items_setting, function (index, parent) {
                $.each($(parent).find('.nav-item'), function (index, nav) {
                    if ($(nav).css('display') !== 'none') {
                        $(parent).parents('.nav-item').show();
                        $(parent).collapse('show');
                        return false;
                    } else {
                        $(parent).parents('.nav-item').hide();
                        $(parent).collapse('hide');
                    }
                });
            });

            var $parent_items = $('.navbar-nav>li.nav-item>div.collapse');
            $.each($parent_items, function (index, parent) {
                $.each($(parent).find('.nav-item'), function (index, nav) {
                    if ($(nav).css('display') !== 'none') {
                        $(parent).parents('.nav-item').show();
                        $(parent).collapse('show');
                        return false;
                    } else {
                        $(parent).parents('.nav-item').hide();
                        $(parent).collapse('hide');
                    }
                });
            });
        } else {
            $('.navbar-nav>.nav-item').show();
            $('.navbar-nav>.nav-item>div>.nav>li').show();
            $('.navbar-nav>.nav-item>div.collapse').collapse('hide');
            //settings
            $('#menu-settings > ul > div.nav-item > div.collapse > ul > li').show();
            $('#menu-settings > ul > div').show();
            $('#menu-settings > ul.nav > div.nav-item>div.collapse').collapse('hide');
        }
    }, 1000));
});
