/**
 * Function to bind the mask to any form in thr view
 * @return {[type]} [description]
 */
function bindCaller()
{
	$("form").on("focus", "[data-mask]", function( event ) {
        $(this).mask($(this).attr('data-mask'));
    });
}

/**
 * Bind Mask Caller after any ajax
 */
$(document).ajaxComplete(function(){
	bindCaller();
});

/**
 * Bind Mask Caller on document ready
 */
$('body').ready(function () {
    bindCaller();
});
