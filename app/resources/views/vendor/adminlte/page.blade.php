@extends('adminlte::master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body',
    (config('adminlte.sidebar_mini', true) === true ?
        'sidebar-mini ' :
        (config('adminlte.sidebar_mini', true) == 'md' ?
         'sidebar-mini sidebar-mini-md ' : '')
    ) .
    (config('adminlte.layout_topnav') || View::getSection('layout_topnav') ? 'layout-top-nav ' : '') .
    (config('adminlte.layout_boxed') ? 'layout-boxed ' : '') .
    (!config('adminlte.layout_topnav') && !View::getSection('layout_topnav') ?
        (config('adminlte.layout_fixed_sidebar') ? 'layout-fixed ' : '') .
        (config('adminlte.layout_fixed_navbar') === true ?
            'layout-navbar-fixed ' :
            (isset(config('adminlte.layout_fixed_navbar')['xs']) ? (config('adminlte.layout_fixed_navbar')['xs'] == true ? 'layout-navbar-fixed ' : 'layout-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['sm']) ? (config('adminlte.layout_fixed_navbar')['sm'] == true ? 'layout-sm-navbar-fixed ' : 'layout-sm-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['md']) ? (config('adminlte.layout_fixed_navbar')['md'] == true ? 'layout-md-navbar-fixed ' : 'layout-md-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['lg']) ? (config('adminlte.layout_fixed_navbar')['lg'] == true ? 'layout-lg-navbar-fixed ' : 'layout-lg-navbar-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_navbar')['xl']) ? (config('adminlte.layout_fixed_navbar')['xl'] == true ? 'layout-xl-navbar-fixed ' : 'layout-xl-navbar-not-fixed ') : '')
        ) .
        (config('adminlte.layout_fixed_footer') === true ?
            'layout-footer-fixed ' :
            (isset(config('adminlte.layout_fixed_footer')['xs']) ? (config('adminlte.layout_fixed_footer')['xs'] == true ? 'layout-footer-fixed ' : 'layout-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['sm']) ? (config('adminlte.layout_fixed_footer')['sm'] == true ? 'layout-sm-footer-fixed ' : 'layout-sm-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['md']) ? (config('adminlte.layout_fixed_footer')['md'] == true ? 'layout-md-footer-fixed ' : 'layout-md-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['lg']) ? (config('adminlte.layout_fixed_footer')['lg'] == true ? 'layout-lg-footer-fixed ' : 'layout-lg-footer-not-fixed ') : '') .
            (isset(config('adminlte.layout_fixed_footer')['xl']) ? (config('adminlte.layout_fixed_footer')['xl'] == true ? 'layout-xl-footer-fixed ' : 'layout-xl-footer-not-fixed ') : '')
        )
        : ''
    ) .
    (config('adminlte.sidebar_collapse') || View::getSection('sidebar_collapse') ? 'sidebar-collapse ' : '') .
    (config('adminlte.right_sidebar') && config('adminlte.right_sidebar_push') ? 'control-sidebar-push ' : '') .
    config('adminlte.classes_body')
)

@section('body_data',
(config('adminlte.sidebar_scrollbar_theme', 'os-theme-light') != 'os-theme-light' ? 'data-scrollbar-theme=' . config('adminlte.sidebar_scrollbar_theme')  : '') . ' ' . (config('adminlte.sidebar_scrollbar_auto_hide', 'l') != 'l' ? 'data-scrollbar-auto-hide=' . config('adminlte.sidebar_scrollbar_auto_hide')   : ''))

@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@else
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif


@section('body')
    <div class="wrapper">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
        <nav class="main-header navbar {{config('adminlte.classes_topnav_nav', 'navbar-expand-md')}} {{config('adminlte.topnav_color', 'navbar-white navbar-light')}}">
            <div class="{{config('adminlte.classes_topnav_container', 'container')}}">
                @if(config('adminlte.logo_img_xl'))
                    <a href="{{ $dashboard_url }}" class="navbar-brand logo-switch">
                        <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}" alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}" class="{{config('adminlte.logo_img_class', 'brand-image-xl')}} logo-xs">
                        <img src="{{ asset(config('adminlte.logo_img_xl')) }}" alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}" class="{{config('adminlte.logo_img_xl_class', 'brand-image-xs')}} logo-xl">
                    </a>
                @else
                    <a href="{{ $dashboard_url }}" class="navbar-brand {{ config('adminlte.classes_brand') }}">
                        <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}" alt="{{config('adminlte.logo_img_alt', 'AdminLTE')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
                        <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
                            {!! config('adminlte.logo', '<b>Dealix</b>') !!}
                        </span>
                    </a>
                @endif

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="nav navbar-nav">
                        @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                    </ul>
                </div>
            @else
            <nav class="main-header navbar {{config('adminlte.classes_topnav_nav', 'navbar-expand-md')}} {{config('adminlte.classes_topnav', 'navbar-white navbar-light')}}">
                <ul class="navbar-nav menu-collapse">
                    <li class="nav-item">

                        <a class="nav-link" data-widget="pushmenu" href="#" @if(config('adminlte.sidebar_collapse_remember')) data-enable-remember="true" @endif @if(!config('adminlte.sidebar_collapse_remember_no_transition')) data-no-transition-after-reload="false" @endif @if(config('adminlte.sidebar_collapse_auto_size')) data-auto-collapse-size="{{config('adminlte.sidebar_collapse_auto_size')}}" @endif>
                            <i class="fas fa-bars"></i>
                            <span class="sr-only">{{ __('adminlte::adminlte.toggle_navigation') }}</span>
                        </a>

                    </li>



                    @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')

                    @yield('content_top_nav_left')

                </ul>
            @endif
                <div class="base-line">
                    <h1 class="page_atual" style="max-width: 825px;">
                        {{ $page_title??"" }}<span id="nomeAuxliarTitulo"></span>
                    </h1>
                    <ol class="breadcrumb">

                        <?php
                            if (request()->route()->uri !="home"){


                            $queryString = "";
                            if ((Request::getQueryString()))
                            {
                                $queryString = "?".Request::getQueryString();
                            }
                            $breadcrumb = explode('.',Route::currentRouteName());
                            if($breadcrumb[0] != null)
                            {
                                $breadcrumb = '/' . $breadcrumb[0].$queryString;
                            }
                            else
                            {
                                $breadcrumb = request()->getRequestUri().$queryString;
                            }
                        }
                        ?>
                        @if(($breadcrumb??"") != "")
                            <li><a href="{{ url('/home') }}">Home</a></li>
                            <li><a href="{{ url($breadcrumb??"")}}"> {{ $page_title??""  }}</a></li>
                            <li class="active"> {{ $page_description??""  }}</li>
                        @endif

                    </ol>
                </div>

                <ul class="navbar-nav navbar-right ml-auto @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))order-1 order-md-3 navbar-no-expand @endif">


                    @yield('content_top_nav_right')


                    @include ('vendor.adminlte.notification')


                    @if(Auth::user())
                        <li class="nav-item logout">
                            <a class="nav-link" href="{{ $logout_url }}">
                                <i class="fas fa-sign-out-alt"></i> {{-- {{ __('adminlte::adminlte.log_out') }} --}}
                            </a>
                            <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                                @if(config('adminlte.logout_method'))
                                    {{ method_field(config('adminlte.logout_method')) }}
                                @endif
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif

                    @if(config('adminlte.right_sidebar'))
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-widget="control-sidebar" @if(!config('adminlte.right_sidebar_slide')) data-controlsidebar-slide="false" @endif @if(config('adminlte.right_sidebar_scrollbar_theme', 'os-theme-light') != 'os-theme-light') data-scrollbar-theme="{{config('adminlte.right_sidebar_scrollbar_theme')}}" @endif @if(config('adminlte.right_sidebar_scrollbar_auto_hide', 'l') != 'l') data-scrollbar-auto-hide="{{config('adminlte.right_sidebar_scrollbar_auto_hide')}}" @endif>
                                <i class="{{config('adminlte.right_sidebar_icon')}}"></i>
                            </a>
                        </li>
                    @endif
                </ul>
                @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
                    </nav>
                @endif
            </nav>
        @if(!config('adminlte.layout_topnav') && !View::getSection('layout_topnav'))
        <aside class="main-sidebar {{config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4')}}">
            <a href="{{ $dashboard_url }}" class="brand-link {{ config('adminlte.classes_brand') }}">
                <span class="txt-name-user">
                    <i class="fa fa-fw fa-user-circle "></i>
                    <span class="brand-text font-weight-light ">
                        {!! Auth::user()->name??"" !!}
                    </span>
                </span>
                <i class="fas fa-pen"></i>
            </a>
            <div class="sidebar">
                <nav class="">
                    <ul class="nav nav-sidebar flex-column {{config('adminlte.classes_sidebar_nav', '')}}" data-widget="treeview" role="menu" @if(config('adminlte.sidebar_nav_animation_speed') != 300) data-animation-speed="{{config('adminlte.sidebar_nav_animation_speed')}}" @endif @if(!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>
                        @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                    </ul>
                </nav>
            </div>
        </aside>
        @endif

        <div class="content-wrapper">
            @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
            <div class="container">
            @endif

            <div class="content-header">
                <div class="{{config('adminlte.classes_content_header', 'container-fluid')}}">

                    @yield('content_header')

                </div>
            </div>

            <div class="content">
                <div class="{{config('adminlte.classes_content', 'container-fluid')}}">
                    @yield('content')
                </div>
            </div>
            @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))
            </div>
            @endif
        </div>

        @hasSection('footer')
        <footer class="main-footer">

            @yield('footer')
        </footer>
        @endif

        @if(config('adminlte.right_sidebar'))
            <aside class="control-sidebar control-sidebar-{{config('adminlte.right_sidebar_theme')}}">
                @yield('right-sidebar')
            </aside>
        @endif

    </div>


@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script>

        if("{{Auth::user()->cadastro_completo}}" == "0")
        {
            ///so mostra 1 x quando entra no sistema e se ainda nao atualizou seus dados
            if('{{Session::get('cadastro_completo')??0}}' == 0) {
                if ($(".meusdados").length <= 0) {
                    $.confirm({
                        theme: 'light',
                        title: 'ALERTA',
                        content: "Dados Cadastrais Incompletos, Favor atualizar seus dados!",
                        buttons: {
                            confirm: {
                                text: 'Atualizar',
                                btnClass: 'btn-danger',
                                action: function () {

                                    //window.location = "{{ url('empresa/'.Auth::user()->id_empresa_principal.'/edit') }}";
                                    window.location = "{{ url('/meusdados') }}";//here double curly bracket


                                }
                            },
                            cancel: {
                                text: 'Cancelar',
                            }
                        }
                    });
                }
            }
        }
        @php(Session::put('cadastro_completo', '1'))
        function fLerNotificacao(id,assunto, conteudo, indLido, thiss) {
            $.confirm({
                theme: 'light',
                title: assunto,
                content: conteudo,
                buttons: {
                    confirm: {
                        text: indLido=="0"?'Marcar Como Lido':'Ok',
                        btnClass: 'btn-danger',
                        action: function () {

                            $.ajax({
                                url: '/notificacaoLida',
                                type: 'GET',
                                contentType: "application/json; charset=utf-8",
                                dataType: "json",
                                data: {
                                    idNotificacao: id
                                },
                                success: function (response) {
                                    $(thiss).attr("style","");

                                    var qtd = parseInt($(".jMsgQtdNoificacao").html());

                                    qtd--;

                                    var qtdIcone = qtd;
                                    if(qtdIcone>9)
                                        qtdIcone = "+9";

                                    $(".jLabelQtdNoificacao").html(qtdIcone);
                                    $(".jMsgQtdNoificacao").html(qtd);
                                },
                                error: function () {

                                }
                            });


                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                    }
                }
            });
        }
        $(".testeclickinicial").click();


        var caminho =  '/'+window.location.pathname.split('/')[1]+"|";
        var queryString = window.location.search;

        //console.log(caminho );
        //debugger;
        $('ul.nav-sidebar a').filter(function() {
            var caminhoMenu = this.pathname+"|";
            var caminhoMenuqueryString = this.search;
            var caminhoMenuHref =  this.href;
            if(caminhoMenu.indexOf(caminho )>=0 && caminhoMenuqueryString.indexOf(queryString )>=0 && caminhoMenuHref.indexOf("#")<0){
                /*
                console.log(caminhoMenu.indexOf(caminho )>0);
                console.log(caminhoMenu.indexOf("#")<0);
                console.log(caminhoMenu);
                console.log(caminho );
                */
            }
            return (caminhoMenu.indexOf(caminho )>=0 && caminhoMenuqueryString.indexOf(queryString )>=0 && caminhoMenuHref.indexOf("#")<0);
        }).parentsUntil("nav").addClass('active').show().children('a').addClass('active');



    </script>
    @stack('js')
    @yield('js')
@stop
