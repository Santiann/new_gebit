@extends('adminlte::master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', 'register-page')

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('body')
    <div class="login-box" style="width: 96%">
        <div class="login-logo">
            <a href="#" class="logo-login"></a>
        </div>
        <div class="card" style="">
            <div class="card-body register-card-body">

                <div class="box">

                    {!! Form::open(['url' => '/registrar/create', 'class' => 'form form-empresa EspacoTopo', 'data-toggle' => 'validator', 'files' => true]) !!}
                    <input type="hidden" id="cadastrese" name="cadastrese" value="1">
                    @include ('sistema.empresa.formRegistrar')
                    {!! Form::close() !!}
                </div>



            </div>
        </div>
            <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
    <script>
        $(".register-page").attr('style','overflow:hidden;');
        $(".box-body").attr('style','max-height: 500px;overflow-x: hidden;overflow-y: auto;');

        $(".validaunico").blur(function () {
            validaCampoUnicoExistente(this);
        });

    </script>
@stop

