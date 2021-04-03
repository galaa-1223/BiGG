@extends('../bigg/layout/base')

@section('body')
    <body class="app">
        @yield('content')
        <!-- BEGIN: Failed Notification Content -->
        <div id="failed-notification-content2" class="toastify-content hidden flex" >
            <i class="text-theme-6" data-feather="x-circle"></i> 
            <div class="ml-4 mr-4">
                <div class="font-medium">Анхааруулга!</div>
                <div class="text-gray-600 mt-1"> Хичээлээ сонгоно уу!. </div>
            </div>
        </div>
        <!-- END: Failed Notification Content -->
        <!-- BEGIN: Failed Notification Content -->
        <div id="failed-notification-content" class="toastify-content hidden flex" >
            <i class="text-theme-6" data-feather="x-circle"></i> 
            <div class="ml-4 mr-4">
                <div class="font-medium">Анхааруулга!</div>
                <div class="text-gray-600 mt-1"> Формыг бүрэн бөглөнө үү!. </div>
            </div>
        </div>
        <!-- END: Failed Notification Content -->
        <script>
            var bigg_URL = "<?=request()->getHttpHost();?>";
        </script>
        <!-- BEGIN: JS Assets-->
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <script src="/dist/js/ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'editor1',{
                language: 'mn'
            });
        </script>
        <!-- END: JS Assets-->

        @yield('script')
    </body>
@endsection