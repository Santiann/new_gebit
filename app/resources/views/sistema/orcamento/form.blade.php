<div class="box-footer BotesFixoTopo">
    <a href="{{ url('/orcamento')}}" class="btn btn-default">
       <i class="fa fa-ban"></i> Cancelar
    </a>
    <button type="submit" class="btn bg-olive pull-right botaoSalvarTela">
        <i class="fa fa-save"></i> {{ isset($submitButtonText) ? $submitButtonText : 'Salvar' }}
    </button>
</div>

<div class="box-body">
    {{ csrf_field() }}
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" id="tabs_hint">
            <li class="form_geral"><a class="active" href="#form_geral" data-toggle="tab">Geral</a></li>
            <li class="form_upload"><a class="" href="#form_upload" data-toggle="tab">Arquivos</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="active tab-pane" id="form_geral">@include ('sistema.orcamento.formGeral')</div>
        <div class="tab-pane" id="form_upload">@include ('sistema.orcamento.formUpload')</div>
    </div>
    @if ($errors->any())
        <div class="row">
            <div class="col-xs-12">
                <div class="callout callout-danger">
                    <ul class="">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                language: 'pt-BR'
            });



            function chamaDepois() {
                $('input[type="file"]').change(function () {
                    var encoutrouInputSemUpload = 0
                    $("input[name='a019_upload[]']").each(function(){
                        if (this.files.length == 0)
                        {
                            encoutrouInputSemUpload++;
                            return;
                        }
                    });

                    if(encoutrouInputSemUpload<1) {
                        var clone = $($("#tableCotacaoArquivo tr")[$("#tableCotacaoArquivo tr").length-1]).clone();
                        clone.removeClass("divUploadCopy");
                        $("#tableCotacaoArquivo").append(clone);

                        var qtd = $("input[name='a019_upload[]']").length-1;
                        $($("input[name='a019_upload[]']")[qtd]).val("");
                        $(".lixeiraUpload").show();
                        $($(".lixeiraUpload")[qtd]).hide();
                        chamaDepois();
                    }

                });
            }
            chamaDepois();

        });
        function removeLinhaTableArquivo(thiss) {
            $.confirm({
                theme: 'light',
                title: 'ALERTA',
                content: 'Tem certeza que deseja excluir este Arquivo?',
                buttons: {
                    confirm: {
                        text: 'Excluir',
                        btnClass: 'btn-danger',
                        action: function () {
                            $(thiss).parents('.arquivo_id_0').remove();
                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                    }
                }
            });
        }
    </script>
@endpush


