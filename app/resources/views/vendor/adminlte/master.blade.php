<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link id="favicon" rel="shortcut icon" href="{{ asset("/favicon.png") }}" type="image/png" />

    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">


    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/bower_components/admin-lte/bootstrap/css/bootstrap3.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <!-- link href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />-->

    <!-- Bootstrap 4.0.0 -->
    <link href="{{ asset("/vendor/download/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/vendor/download/css/bootstrap-grid.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/vendor/download/css/bootstrap-reboot.min.css") }}" rel="stylesheet" type="text/css" />

    <!-- Font Awesome Icons -->
    <link href="{{ asset("/vendor/download/css/font-awesome.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- Ionicons -->
    <link href="{{ asset("/vendor/download/css/ionicons.min.css") }}" rel="stylesheet" type="text/css" />

    <!-- Summernote -->
    <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/summernote/summernote.css")}}">

    <!-- Select2 -->
    <link href="{{ asset ("/bower_components/admin-lte/plugins/select2/select2.min.css") }}" rel="stylesheet" type="text/css" />

    <!-- Modal Alert -->
    <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/alert-modal/jquery-confirm.min.css")}}">

    <!-- chartjs 2.9.3 -->
    <link href="{{ asset("/vendor/download/css/Chart.min.css") }}" rel="stylesheet" type="text/css" />

    <!-- dropify -->
    <link href="{{ asset("/vendor/download/css/dropify.min.css") }}" rel="stylesheet" type="text/css" />


    @include('adminlte::plugins', ['type' => 'css'])

    @yield('adminlte_css_pre')

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset ("/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset ("/bower_components/admin-lte/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css") }}">
    <link rel="stylesheet" href="{{ asset ("/bower_components/admin-lte/plugins/datatables/buttons.dataTables.min.css") }}">

    @yield('adminlte_css')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/geral.css') }}">
    <link rel="stylesheet" href="{{ asset('css/design_temp.css') }}">

</head>
<body class="@yield('classes_body')" @yield('body_data')>

@yield('body')


<script src="{{ asset('vendor/download/js/jquery.js') }}"></script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>

<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>




<script src="{{ asset('/bower_components/admin-lte/plugins/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('/bower_components/admin-lte/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('/bower_components/admin-lte/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('/bower_components/admin-lte/plugins/datatables/dataTables.responsive.min.js') }}"></script>

<script src="{{ asset('/bower_components/admin-lte/plugins/blockui/jquery.blockUI.js') }}"></script>


<!-- Validator -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/validator/validator.js") }}"></script>

<!-- InputMask -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/input-mask/jquery.mask.min.js") }}" type="text/javascript"></script>

<!-- DatePicker -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js") }}" type="text/javascript"></script>

<!-- Summernote -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/summernote/summernote.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/summernote/lang/summernote-pt-BR.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/summernote-ext-print-master/summernote-ext-print.js") }}" type="text/javascript"></script>

<!-- Select2 -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/select2/select2.full.min.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/select2/i18n/pt-BR.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="{{ asset ("/bower_components/admin-lte/dist/js/app.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/bower_components/jquery-slimscroll/jquery.slimscroll.min.js") }}" type="text/javascript"></script>

<!-- Modal Alert -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/alert-modal/jquery-confirm.min.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/eModal/dist/eModal.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/bower_components/admin-lte/plugins/bootstrap-duallistbox-master/src/jquery.bootstrap-duallistbox.js") }}" type="text/javascript"></script>

<!-- bootstrap color picker -->
<script src="{{ asset("/bower_components/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.js") }}" type="text/javascript"></script>

<!-- https://mottie.github.io/tablesorter/docs/example-widget-grouping.html -->
<script src="{{ asset("/bower_components/admin-lte/plugins/tablesorter/jquery.tablesorter.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/bower_components/admin-lte/plugins/tablesorter/widget-filter.js") }}" type="text/javascript"></script>
<script src="{{ asset("/bower_components/admin-lte/plugins/tablesorter/widget-storage.js") }}" type="text/javascript"></script>
<script src="{{ asset("/bower_components/admin-lte/plugins/tablesorter/widget-grouping.js") }}" type="text/javascript"></script>


<!-- Loading Overlay -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/loading-overlay/loadingoverlay.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/loading-overlay/loadingoverlay_progress.min.js") }}"></script>
<script src="{{ asset ("/bower_components/typeahead.bundle.min.js") }}"></script>


<!-- chartjs 2.9.3 -->
<script src="{{ asset('vendor/download/js/Chart.min.js') }}"></script>
<script src="{{ asset('vendor/download/js/Chart.bundle.min.js') }}"></script>



<!-- dropify -->
<script src="{{ asset('vendor/download/js/dropify.min.js') }}"></script>



<script src="{{ asset ("/bower_components/admin-lte/plugins/redirect/jquery.redirect.js") }}"></script>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

@include('adminlte::plugins', ['type' => 'js'])
@yield('adminlte_js')


</body>
</html>
