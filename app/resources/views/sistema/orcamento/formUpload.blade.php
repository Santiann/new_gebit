<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="tableCotacaoArquivo">
                    <tr>
                        <th>Arquivo</th>
                    </tr>
                    @if ($arquivos??"" != '')
                        @foreach ($arquivos as $row)
                            <tr class="arquivo_id_0">
                                <td>
                                    <a href="http://{{$_SERVER["HTTP_HOST"]}}/storage{{($row['a019_url'])}}" target="_blank">{{ $row['a019_url'] }}</a>
                                    {!! Form::hidden('a019_url[]', $row['a019_url'], ['class' => 'form-control']) !!}
                                </td>

                            </tr>
                        @endforeach
                    @endif
                    <tr class="arquivo_id_0 divUploadCopy">
                        <td>
                            {!! Form::file('a019_upload[]',null, ['class' => 'form-control a019_upload', 'id'=>'a019_upload[]',"multiple"=>"multiple","autocomplete"=>"off"]) !!}
                        </td>
                        <td>
                            <div class="btn btn-xs btn-danger lixeiraUpload" onclick="removeLinhaTableArquivo(this)">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

