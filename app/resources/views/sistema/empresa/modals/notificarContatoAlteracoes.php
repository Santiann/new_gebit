<!-- Modal -->
<div class="modal fade" id="notificarContatoAlteracoes" tabindex="-1" role="dialog" aria-labelledby="notificarContatoAlteracoes" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content p-4">
      <div class="modal-header">
        <h3 class="modal-title">Notificar alterações para clientes/fornecedores</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mt-4">
          <div class="col-md-4">
              <label for="notify_contato" class="control-label">Selecione o contato</label>
              <select name="notify_contato" class="form-control select2" id="notify_contato">
                @foreach ($EmpresaContatos as $row)
                  <option value="{{ $row['a006_id_empresa_contato'] }}">{{ $row['a006_nome'] }} ({{$optionTipo_contato[$row['a006_tipo_contato']] }})</option>
                @endforeach
              </select>
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
          <div class="col-md-12">
              <label for="a028_justificativa" class="control-label">Justificativa</label>
              <textarea class="form-control" autocomplete="off" name="a028_justificativa" type="text" id="a028_justificativa" rows="4" cols="50"></textarea>
              <small>Esta parcela adicional será salva na guia <b>Anotações de Negociações</b> com status <i>Pendente</i></small>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button onclick="addParcela()" type="button" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>