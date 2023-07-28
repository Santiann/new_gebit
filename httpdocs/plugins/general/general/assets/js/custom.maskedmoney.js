/**
 * Function to bind the mask to any form in thr view
 * @return {[type]} [description]
 */
function bindCaller()
{
	$("form").on("focus", "[data-money]", function( event ) {
        $(this).maskMoney({
            //prefix:'R$ ',
            allowNegative: true,
            thousands:'.',
            decimal:','
            //affixesStay: false
        });
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
