<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="tableCotacaoArquivo">
                    <tr>
                        <th>Arquivo</th>
                        <th>Descrição</th>
                        <th style="width: 80px">Ação</th>
                    </tr>
                    @if ($arquivos??"" != '')
                        @foreach ($arquivos as $row)
                            <tr class="arquivo_id_0">
                                <td>
                                    <a href="http://{{$_SERVER["HTTP_HOST"]}}/storage{{($row['a023_url'])}}" target="_blank">{{ $row['a023_url'] }}</a>
                                    {!! Form::hidden('a023_url[]', $row['a023_url'], ['class' => 'form-control']) !!}
                                </td>
                                <td>
                                    {{$row['a023_descricao']}}
                                    {!! Form::hidden('a023_descricao[]', $row['a023_descricao'], ['class' => 'form-control']) !!}
                                </td>

                                <td class="btnRemoveUpload">
                                    @if(!(($readonly??"") == "readonly"))
                                    <div class="btn btn-xs btn-danger"  title="Remover Arquivo"
                                         onclick="removeLinhaTableArquivo(this)">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    <tr class="arquivo_id_0 divUploadCopy">
                        <td>
                            {!! Form::file('a023_upload[]',null, ['class' => 'form-control a023_upload', 'id'=>'a023_upload[]',"multiple"=>"multiple","autocomplete"=>"off"]) !!}
                        </td>
                        <td>
                            <div class="form-group {{ $errors->has('a005_id_empresa') ? 'has-error' : ''}}">
                                {!! Form::text('a023_descricao[]', null, ['class' => 'form-control a023_descricao','autocomplete' => 'off', 'id'=>'a023_descricao[]']) !!}
                                {!! $errors->first('a005_id_empresa', '<p class="help-block">:message</p>') !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <td>
                            <div class="btn btn-xs btn-danger lixeiraUpload" style="display: none;" title="Remover Arquivo" onclick="removeLinhaTableArquivo(this)">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

