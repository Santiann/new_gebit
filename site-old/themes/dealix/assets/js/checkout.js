(function($){
  jQuery(document).on('ready', function () {

    let loading = $('.preloader-area');
    let plan_item = {
      id: $('#plan_id').val(),
      title: $('#plan_name').text(),
      unit_price: $('#plan_price').val(),
      quantity: 1,
      tangible: 'false'
    };
    let total = plan_item.unit_price;
    var button = document.querySelector('button');
      
    // Abrir o modal ao clicar no botão
    button.addEventListener('click', function() {     
        // inicia a instância do checkout
        var checkout = new PagarMeCheckout.Checkout({
            encryption_key: $('#pagarme_encryption_key').val(),
            success: function(data) {
                $.ajax({
                    type: "POST",
                    url: "transactions/capture",
                    data: {
                        'amount': total,
                        'transaction_id': data.token
                    },
                    before: loading.fadeIn(),
                    success : function(){
                        console.log('transaction captured')
                    },
                    error: function(){
                        console.log('an error occurred, transaction was not captured')
                    },
                    always: loading.fadeOut()
                });
            },
            error: function(err) {
              console.log('something bad happened')
              console.log(err);
            },
            close: function() {
              console.log('The modal has been closed.');
            }
        });             
        
        checkout.open({
          amount: total,
          customerData: 'true',
          createToken: 'true',
          maxInstallments: 3, // parcels quantity
          items: [plan_item]
        })
    });

  });
    
}(jQuery));

