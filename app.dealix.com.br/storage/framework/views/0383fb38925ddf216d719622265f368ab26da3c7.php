
<!-- Modal -->
<div class="modal fade" id="createAreaModal" tabindex="-1" role="dialog" aria-labelledby="createAreaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="createAreaModalLabel">Nova área</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $__env->make('sistema.area_contrato.form', ['hide_header_buttons' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button onclick="createArea()" type="button" class="btn btn-primary">Criar área</button>
      </div>
    </div>
  </div>
</div>

<?php $__env->startPush('js'); ?>
    <script>
      function createArea()
      {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let formData = new FormData();
        formData.append("a011_descricao", $('#a011_descricao').val()); 
        formData.append("a011_status", $('#a011_status').is(':checked') ? 1 : 0); 
        formData.append("a005_id_empresa", $('#a005_id_empresa').val()); 

        $.ajax({
          url: "/area_contrato/create",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
          beforeSend: () => $('#createAreaModal').modal('toggle'),
          success: function (response) {

            if (response.content.a011_status == 1) {
              let data = {
                  id: response.content.a011_id_area,
                  text: response.content.a011_descricao
              };
              let newOption = new Option(data.text, data.id, false, true);
              $('#a011_id_area').append(newOption).trigger('change');
            }

            $('#createAreaModal input, #createAreaModal textarea').val('')
          },
          error: function (response) {
              console.log(response.error)
              alert('Erro, tente novamente por favor!');
          }
        });
      }
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\new_gebit\app\resources\views/sistema/contrato/modals/create_area.blade.php ENDPATH**/ ?>