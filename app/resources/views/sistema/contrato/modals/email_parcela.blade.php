<!-- Modal -->
<div class="modal fade" id="parcelaEmail" tabindex="-1" role="dialog" aria-labelledby="parcelaEmail" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content p-4">
      <div class="modal-header">
        <h3 class="modal-title" id="parcelaEmailTitle">Envie o boleto por e-mail</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row mt-4">
          <div class="col-md-12">
            <h4 class="font-weight-bold control-label">Envie o boleto <span class="text-warning">em PDF</span> para o e-mail abaixo. 
              Iremos escanear o arquivo e lançar o valor da nova parcela automaticamente no sistema Dealix.</h4>
          </div>
        </div>
        <div class="row justify-content-center mt-4">
          <div class="col-md-6">
            <?php $email_result = env('IMAP_USERNAME') ?? "inbox@app.dealix.com.br";
                  $array_email = explode('@', $email_result);
                  $email_result = $array_email[0].'+'.$contrato->a013_id_contrato.'@'.$array_email[1];
            ?>
            <!-- input para exibir e-mail com parametros no endereço -->
           {!! Form::text('email_boleto', $email_result, ['id' => 'email_boleto', 'class' => 'form-control text-center', 'readonly'=>'true']) !!}

           <!-- input para exibir e-mail normal -->
           <!-- {!! Form::text('email_boleto', env('IMAP_USERNAME'), ['id' => 'email_boleto', 'class' => 'form-control text-center', 'readonly'=>'true']) !!} -->
          </div>
        </div>
        <div class="row text-center mt-4">
          <div class="col-md-12">
            <button id="btn_email_boleto" type="button" onclick="copiarTexto('email_boleto')" class="btn btn-info">Copiar e-mail</button>
          </div>
        </div>
        <!-- <div class="row justify-content-center text-center mt-5">
          <div class="col-md-12">
            <h4 class="font-weight-bold control-label">Coloque o seguinte assunto:</h4>
          </div>
        </div>
        <div class="row justify-content-center mt-4">
          <div class="col-md-6">
          {!! Form::text('assunto_email_boleto', "boleto-contrato-".$contrato->a013_id_contrato, ['id' => 'assunto_email_boleto', 'class' => 'form-control text-center', 'readonly'=>'true']) !!}
          </div>
        </div>
        <div class="row text-center mt-4">
          <div class="col-md-12">
            <button id="btn_assunto_email_boleto" type="button" onclick="copiarTexto('assunto_email_boleto')" class="btn btn-success">Copiar assunto</button>
          </div>
        </div> -->
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>

    </div>

  </div>
</div>

@push('js')
    <script>
      function copiarTexto(idField) {
          let textoCopiado = document.getElementById(idField);
          textoCopiado.select();
          textoCopiado.setSelectionRange(0, 99999)
          document.execCommand("copy");

          document.getElementById("btn_" + idField).firstChild.data = "Copiado!"
      }
    </script>
@endpush