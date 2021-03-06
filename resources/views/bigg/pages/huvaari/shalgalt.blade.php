@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Хичээлийн хуваарь</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: FAQ Menu -->
        <a href="{{ route('bigg-huvaari') }}" class="intro-y col-span-12 lg:col-span-4 box py-10">
            <i data-feather="user" class="w-14 h-10 text-theme-1 dark:text-theme-10 mx-auto"></i>
            <div class="font-medium text-center text-base mt-3">Багш</div>
        </a>
        <a href="{{ route('bigg-huvaari-angi') }}" class="intro-y col-span-12 lg:col-span-4 box py-10">
            <i data-feather="briefcase" class="w-14 h-10 text-theme-1 dark:text-theme-10 mx-auto"></i>
            <div class="font-medium text-center text-base mt-3">Анги</div>
        </a>
        <a href="{{ route('bigg-huvaari-shalgalt') }}" class="intro-y col-span-12 lg:col-span-4 box py-10 border-2 border-theme-1 dark:border-theme-1">
            <i data-feather="check-circle" class="w-14 h-10 text-theme-1 dark:text-theme-10 mx-auto"></i>
            <div class="font-medium text-center text-base mt-3">Шалгалт</div>
        </a>
        <!-- END: FAQ Menu -->
        <!-- BEGIN: FAQ Content -->
        <div class="intro-y col-span-12 box p-5">

                <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-17 text-theme-11">
                    <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> Мэдээлэл алга байна!
                </div>

        </div>
        <!-- END: HTML Table Data -->
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection