
@extends('adminlte::page')

@php

	$page_title = "CRUD - Generator";
    $page_description = substr($campos[0]->TABLE_NAME,5,1000);

@endphp
@section('title', $page_title)

@section('content_header')
	<h1>{{$page_title}}</h1>
@stop


@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<h3 class="box-title">Model</h3>
					</div>
					<div class="tools"> </div>
				</div>
				<div class="box-body">
					<textarea style="width: 100%" rows="5">{!! $textModel !!}</textarea>
				</div>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<h3 class="box-title">Request</h3>
					</div>
					<div class="tools"> </div>
				</div>
				<div class="box-body">
					<textarea style="width: 100%" rows="5">{!! $textRequest !!}</textarea>
				</div>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<h3 class="box-title">Controller</h3>
					</div>
					<div class="tools"> </div>
				</div>
				<div class="box-body">
					<textarea style="width: 100%" rows="5">{!! $textController !!}</textarea>
				</div>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<h3 class="box-title">View</h3>
					</div>
					<div class="tools"> </div>
				</div>
				<div class="box-body">
					<textarea style="width: 100%" rows="5">php artisan crud:view {{ucfirst(substr($campos[0]->TABLE_NAME,5,1000)) }} --pk="@foreach($campos->where('COLUMN_KEY','=','PRI') as $campo){{ $campo->COLUMN_NAME }}@endforeach" --fields="@foreach($campos->where('COLUMN_KEY','<>','PRI')->whereNotIn('COLUMN_NAME',['idassociado','created_at','created_at_user','updated_at','updated_at_user']) as $campo){{ $campo->COLUMN_NAME }}#{{ $campo->present()->tipocampo }}@if ($campo != $campos->where('COLUMN_KEY','<>','PRI')->whereNotIn('COLUMN_NAME',['idassociado','created_at','created_at_user','updated_at','updated_at_user'])->last() );@endif @endforeach"  --validations="@foreach($required as $campo){{ $campo->COLUMN_NAME }}#required @if ($campo != $required->last() );@endif @endforeach"  --view-path="sistema" --localize=no</textarea>
				</div>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<h3 class="box-title">Route (routes/web.php)</h3>
					</div>
					<div class="tools"> </div>
				</div>
				<div class="box-body">
					<textarea style="width: 100%" rows="5"> php artisan crud:route Route  --name-route={{ $route }} --type=WEB </textarea>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<h3 class="box-title">Insert Permissions</h3>
					</div>
					<div class="tools"> </div>
				</div>
				<div class="box-body">
				<textarea style="width: 100%" rows="5">@foreach($permissions as $item)INSERT INTO permissions ( guard_name, tipo, name, display_name, description,created_at,url) VALUES ( 'web','{{ $item['tipo'] }}', '{{ $route }}@if($item['permission'] != "")-{{ $item['permission'] }}@endif', '@if($item['permission'] != ""){{ $route }}-{{ $item['permission'] }}@else{{ ucfirst($route) }}@endif', '@if($item['permission'] != ""){{ ucfirst($item['permission']) }} @endif{{ ucfirst($route) }}',CURRENT_DATE,@if($item['tipo']=="MENU")'{{ $route }}'@else null @endif);
@endforeach

insert into role_has_permissions (permission_id,role_id)
select permissions.`id`, `roles`.`id` from permissions
cross join roles on ind_adm = 1
where permissions.name like '{{$route}}%' and tipo = 'PERM' and ind_adm = 1
and permissions.`id` not in (select permission_id from role_has_permissions)
;
                </textarea>
				</div>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<h3 class="box-title">Lang pt-BR (Só é necessário se a view for criada com o parâmetro --localize=yes)</h3>
					</div>
					<div class="tools"> </div>
				</div>
				<div class="box-body">
					<textarea style="width: 100%" rows="5">php artisan crud:lang {{ $campos[0]->TABLE_NAME }} --fields="@foreach($campos as $campo){{ $campo->COLUMN_NAME }}#{{ $campo->DATA_TYPE }}@if ($campo != $campos->where('COLUMN_KEY','<>','PRI')->last() );@endif @endforeach" --locales=pt-BR</textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<h3 class="box-title">....</h3>
					</div>
					<div class="tools"> </div>
				</div>
				<div class="box-body">
					<textarea style="width: 100%" rows="5">php artisan config:cache & php artisan config:clear & composer dump-autoload</textarea>
				</div>
			</div>
		</div>
	</div>
@stop

@section('css')
	<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')



@stop






