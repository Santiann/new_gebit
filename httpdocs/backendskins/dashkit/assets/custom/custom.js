jQuery.ajaxPrefilter(function (options) {
    options.global = true;
});

$.ajaxSetup({
    beforeSend: function (jqXHR, settings) {

        var allDataObject = $('form').serializeArray();

        $.each(allDataObject, function (index, value) {
            if (settings.data && (settings.data.indexOf(decodeURI(value.name) + '=') === -1 && settings.data.indexOf(encodeURI(value.name) + '=' === -1)) === true) {
                settings.data += '&' + value.name + '=' + value.value;
            }
        });
        return true;
    }
});

$(document).ready(function () {
    $.fn.select2.defaults.set("language", "pt-BR");
});

$(document).on('ajaxPromise', function () {
    $('button').attr({'disabled': 'disabled'});
    $("select").attr('readonly', true);
});

$(document).on('ajaxStart', function () {
    $('button').attr({'disabled': 'disabled'});
    $("select").attr('readonly', true);
});

$(document).on('ajaxComplete', function () {
    $('button').removeAttr('disabled');
    $("select").removeAttr('readonly');
    $.oc.stripeLoadIndicator.hide();
});

$(function () {
    function checkPendingRequest() {
        var attr = $('button').attr('disabled');

        if ($.active === 0 && (typeof attr !== 'undefined' && attr !== false)) {
            $('button').removeAttr('disabled');
            $("select").removeAttr('readonly');
        }
    }

    window.setInterval(checkPendingRequest, 2000);
    window.setInterval(checkOpenModalEmpty, 2000);
});

function checkOpenModalEmpty() {
    var $modalOpen = $('body.modal-open');
    var $controlPopupModal = $('.control-popup.modal');
    var $modalBackDropFade = $('.modal-backdrop.fade');

    if ($(document).find('.control-popup.modal.fade[aria-hidden="true"]').length === 1 && $modalOpen.length === 1) {
        $('body').removeClass('modal-open');
        $(document).find('.control-popup.modal.fade[aria-hidden="true"]').remove();
    } else if ($controlPopupModal.length && $controlPopupModal.html().length) {
        $(document.body).addClass('modal-open')
    } else if(!$modalOpen.length && $modalBackDropFade.length && !$modalBackDropFade.html()) {
        $controlPopupModal.remove();
        $modalBackDropFade.remove();
    } else {
        $controlPopupModal.remove();
    }
}

$(document).on('hidden.bs.modal', '.modal', function () {
    setTimeout(checkOpenModalEmpty, 500);
})

$(document).ready(function () {

    if (localStorage.getItem('collapse-menu') === 'close') {
        closeMenu();
        toogleTooltips();
    }

    $("#menu-icons-new").click(function () {
        if (localStorage.getItem('collapse-menu') === 'close') {
            localStorage.setItem('collapse-menu', 'open');
        } else {
            localStorage.setItem('collapse-menu', 'close');
        }
        toogleMenu();
        toogleTooltips();
    });
});

function toogleMenu() {
    $("#sidebarCollapse").toggleClass("toggle-menu");
    $("#sidebar").toggleClass("toggle-menu-side");
    $("#sidebarUser > div > a > div > .text-center").toggleClass("d-md-none");
    $("#menu-empresa-selected").toggleClass("d-md-none");
    $(".main-content").toggleClass("ml-new");

    $(".navbar-brand").toggleClass("d-md-none");
    $(".navbar-brand-icon").toggleClass("d-md-block");

    $(".collapse").removeClass("show");
}

function closeMenu() {
    $("#sidebarCollapse").addClass("toggle-menu");
    $("#sidebar").addClass("toggle-menu-side");
    $("#sidebarUser > div > a > div > .text-center").addClass("d-md-none");
    $("#menu-empresa-selected").addClass("d-md-none");
    $(".main-content").addClass("ml-new");
    $(".navbar-brand").addClass("d-md-none");
    $(".navbar-brand-icon").addClass("d-md-block");
    $(".collapse").removeClass("show");
}

function toogleTooltips() {
    if (localStorage.getItem('collapse-menu') === 'close') {
        $('[data-tooltip]').tooltip({
            placement: 'right'
        });
    }
}

$(document).ready(function () {
    var heightWindow = $(window).height();

    if (heightWindow <= 561) {
        $('.navbar-nav').css({paddingBottom: '40vh'});
    }

    if (heightWindow <= 461) {
        $('.navbar-nav').css({paddingBottom: '55vh'});
    }
});
