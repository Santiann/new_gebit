<!-- Modal -->
<div class="modal fade" id="addComentarioAnotacao" tabindex="-1" role="dialog" aria-labelledby="addComentarioAnotacao" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content p-4">
      <div class="modal-header">
        <h3 class="modal-title" id="addComentarioAnotacao">Adicionar comentário</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mt-4">
          <div class="col-md-12">
              <label for="add_comment_note" class="control-label">Adicione um comentário para a anotação selecionada</label>
              <textarea class="form-control" autocomplete="off" name="add_comment_note" type="text" id="add_comment_note" rows="4" cols="50"></textarea>
          </div>
        </div>
        <div class="row mt-4 justify-content-center">
          <div class="col-md-12">
            <label class="control-label">Aceita esta anotação?</label>
          </div>
        </div>
        <div class="row mt-4 justify-content-center">
          <div class="col-md-6">
              <input type="radio" id="aceitar" name="a026_anotacao_aceite" value="1">
              <label class="control-label" for="aceitar">Aceitar</label>&ensp;
          </div>
          <div class="col-md-6">
              <input type="radio" id="rejeitar" name="a026_anotacao_aceite" value="0">
              <label class="control-label" for="rejeitar">Rejeitar</label>&ensp;
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button onclick="addComentarioAnotacao()" type="button" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>