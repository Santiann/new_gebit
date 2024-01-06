
<!-- Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="createCategoryModalLabel">Nova categoria</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include ('sistema.categoria_contrato.formGeral', ['hide_header_buttons' => true])
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button onclick="createCategory()" type="button" class="btn btn-primary">Criar categoria</button>
      </div>
    </div>
  </div>
</div>

@push('js')
    <script>
      function createCategory()
      {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let formData = new FormData();
        formData.append("a008_descricao", $('#a008_descricao').val()); 
        formData.append("a008_status", $('#a008_status').is(':checked') ? 1 : 0); 
        formData.append("a008_termo_cancelamento", $('#a008_termo_cancelamento').val()); 
        formData.append("a005_id_empresa", $('#a005_id_empresa').val()); 

        $.ajax({
          url: "/new_gebit/app.dealix.com.br/categoria_contrato/create",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
          beforeSend: () => $('#createCategoryModal').modal('toggle'),
          success: function (response) {

            if (response.content.a008_status == 1) {
              let data = {
                  id: response.content.a008_id_cat_contrato,
                  text: response.content.a008_descricao
              };
              let newOption = new Option(data.text, data.id, false, true);
              $('#a008_id_cat_contrato').append(newOption).trigger('change');
            }

            $('#createCategoryModal input, #createCategoryModal textarea').val('')
          },
          error: function (response) {
              console.log(response.error)
              alert('Erro, tente novamente por favor!');
          }
        });
      }
    </script>
@endpush