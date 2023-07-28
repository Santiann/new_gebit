<!-- Modal -->
<div class="modal fade" id="addParcela" tabindex="-1" role="dialog" aria-labelledby="addParcela" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content p-4">
      <div class="modal-header">
        <h3 class="modal-title" id="addParcela">Nova parcela</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form></form>
        <form id="addParcelaForm" action="#" method="POST">
        
        <div class="row mt-4">
          <div class="col-md-4">
            <label for="a028_data_cobranca" class="control-label">Data</label>
            <input id="a028_data_cobranca" name="a028_data_cobranca" class="a028_data_cobranca form-control dataMask" autocomplete="off" pattern="(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)"/>
          </div>
          <div class="col-md-4">
            <label for="a028_valor_fracao" class="control-label">Valor</label>
            <input id="a028_valor_fracao" name="a028_valor_fracao" class="moneyMaskCuston a028_valor_fracao form-control" autocomplete="off"/>
          </div>
          <!-- <div class="col-md-4">
              <div class="form-group">
                <label for="a028_recorrencia" class="control-label">Recorrência</label>
                <select name="a028_recorrencia" class="form-control select2" id="a028_recorrencia">
                  <option value="mensal">Mensal</option>
                  <option value="bimestral">Bimestral</option>
                  <option value="trimestral">Trimestral</option>
                  <option value="semestral">Semestral</option>
                  <option value="anual">Anual</option>
                </select>
            </div>
          </div> -->
        </div>
        <div class="row mt-4">
          <div class="col-md-4">
            <label for="a028_valor_comissao" class="control-label">Valor comissão</label>
            <input id="a028_valor_comissao" name="a028_valor_comissao" class="moneyMaskCuston a028_valor_comissao form-control" autocomplete="off"/>
          </div>
          <div class="col-md-4">
            <label for="a028_valor_extra" class="control-label">Valor extra</label>
            <input id="a028_valor_extra" name="a028_valor_extra" class="moneyMaskCuston a028_valor_extra form-control" autocomplete="off"/>
          </div>
        </div>
        <div class="row mt-4"> 
        <div class="col-md-4"> 
        <label for="a028_documento" class="control-label">Novo Documento</label>
            <input style="width: -moz-available;" id="a028_documento" name="a028_documento" type="file" />
            <div class="help-block with-errors"></div> 
        </div> 
        </div>
        <div class="row mt-4">
          <div class="col-md-12">
              <label for="a028_justificativa" class="control-label">Justificativa</label>
              <textarea class="form-control" autocomplete="off" name="a028_justificativa" type="text" id="a028_justificativa" rows="4" cols="50"></textarea>
              <small>Esta parcela adicional será salva na guia <b>Anotações de Negociações</b> com status <i>Pendente</i></small>
          </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button onclick="addParcela()" type="button" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>