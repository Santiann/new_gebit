
<!-- Modal -->
<div class="modal fade" id="createTypeModal" tabindex="-1" role="dialog" aria-labelledby="createTypeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="createTypeModalLabel">Novo tipo</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('sistema.tipo_contrato.form', ['hide_header_buttons' => true])
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button onclick="createType()" type="button" class="btn btn-primary">Criar tipo</button>
      </div>
    </div>
  </div>
</div>

@push('js')
    <script>
      function createType()
      {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let formData = new FormData();
        formData.append("a010_descricao", $('#a010_descricao').val()); 
        formData.append("a010_status", $('#a010_status').is(':checked') ? 1 : 0); 
        formData.append("a005_id_empresa", $('#a005_id_empresa').val()); 

        $.ajax({
          url: "/tipo_contrato/create",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
          beforeSend: () => $('#createTypeModal').modal('toggle'),
          success: function (response) {

            if (response.content.a010_status == 1) {
              let data = {
                  id: response.content.a010_id_tipo_contrato,
                  text: response.content.a010_descricao
              };
              let newOption = new Option(data.text, data.id, false, true);
              $('#a010_id_tipo_contrato').append(newOption).trigger('change');
            }

            $('#createTypeModal input, #createTypeModal textarea').val('')
          },
          error: function (response) {
              console.log(response.error)
              alert('Erro, tente novamente por favor!');
          }
        });
      }
    </script>
@endpush