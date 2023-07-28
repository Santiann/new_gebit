/**
 * Function to bind the mask to any form in thr view
 * @return {[type]} [description]
 */
function bindCallerMoney()
{
    $('[data-money]').each(function(item){
        $(item).maskMoney({
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
    bindCallerMoney();
});

/**
 * Bind Mask Caller on document ready
 */
$('body').ready(function () {
    bindCallerMoney();
});
