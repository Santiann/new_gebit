/**
 * Function to bind the mask to any form in thr view
 * @return {[type]} [description]
 */
function bindCallerMask() {
    $("[data-mask]").each(function () {
        $(this).mask($(this).attr('data-mask'), { clearIfNotMatch: true });
    });
}

/**
 * Bind Mask Caller after any ajax
 */
$(document).ajaxComplete(function () {
    bindCallerMask();
});

/**
 * Bind Mask Caller on document ready
 */
$('body').ready(function () {
    bindCallerMask();
});
