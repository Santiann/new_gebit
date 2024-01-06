
<!-- Modal -->
<div class="modal fade" id="createCompanyModal" tabindex="-1" role="dialog" aria-labelledby="createCompanyModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="createCompanyModalLabel">Novo Cliente/Fornecedor</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $__env->make('sistema.empresa.form', ['hide_header_buttons' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button onclick="createCompany()" type="button" class="btn btn-primary">Criar cliente/fornecedor</button>
      </div>
    </div>
  </div>
</div>

<?php $__env->startPush('js'); ?>
    <script>
      function createCompany()
      {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let formData = new FormData(document.querySelector('#form_modal_create_contrato'));

        $.ajax({
          url: "/empresa/create",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
          beforeSend: () => $('#createCompanyModal').modal('toggle'),
          success: function (response) {

            if (response.content.a005_status == 1) {
              let data = {
                  id: response.content.a005_id_empresa,
                  text: response.content.a005_nome_fantasia || response.content.a005_nome_completo
              };
              let newOption = new Option(data.text, data.id, false, true);
              $('#a005_id_empresa_cli_for').append(newOption).trigger('change');
            }

            $('#createCompanyModal input, #createCompanyModal textarea').val('')
          },
          error: function (response) {
              console.log(response.error)
              alert('Erro, tente novamente por favor!');
          }
        });
      }
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\new_gebit\app\resources\views/sistema/contrato/modals/create_company.blade.php ENDPATH**/ ?>