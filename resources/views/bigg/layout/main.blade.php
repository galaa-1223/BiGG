@extends('../bigg/layout/base')

@section('body')
    <body class="app">
        @yield('content')
        <script>
            var bigg_URL = "<?=request()->getHttpHost();?>";
        </script>
        <!-- BEGIN: JS Assets-->
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->

        @yield('script')
    </body>
@endsection