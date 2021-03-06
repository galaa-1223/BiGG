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
        <a href="{{ route('bigg-huvaari') }}" class="intro-y col-span-12 lg:col-span-4 box py-10 border-2 border-theme-1 dark:border-theme-1">
            <i data-feather="user" class="w-14 h-10 text-theme-1 dark:text-theme-10 mx-auto"></i>
            <div class="font-medium text-center text-base mt-3">Багш</div>
        </a>
        <a href="{{ route('bigg-huvaari-angi') }}" class="intro-y col-span-12 lg:col-span-4 box py-10">
            <i data-feather="briefcase" class="w-14 h-10 text-theme-1 dark:text-theme-10 mx-auto"></i>
            <div class="font-medium text-center text-base mt-3">Анги</div>
        </a>
        <a href="{{ route('bigg-huvaari-shalgalt') }}" class="intro-y col-span-12 lg:col-span-4 box py-10">
            <i data-feather="check-circle" class="w-14 h-10 text-theme-1 dark:text-theme-10 mx-auto"></i>
            <div class="font-medium text-center text-base mt-3">Шалгалт</div>
        </a>
        <!-- END: FAQ Menu -->
        <!-- BEGIN: FAQ Content -->
        <div class="intro-y col-span-12 box p-5">
            @if(!count($teachers))
                <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-17 text-theme-11">
                    <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> Мэдээлэл алга байна!
                </div>
            @else
            <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                <form class="xl:flex sm:mr-auto" id="tabulator-html-filter-form">
                    <div class="sm:flex items-center sm:mr-4">
                        <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Талбар</label>
                        <select class="input w-full sm:w-32 xxl:w-full mt-2 sm:mt-0 sm:w-auto border" id="tabulator-html-filter-field">
                            <option value="teachers.ner">Багшийн нэр</option>
                            <option value="tenhim.ner">Тэнхим</option>
                            <option value="teachers.code">Багшийн код</option>
                        </select>
                    </div>
                    <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                        <input type="text" class="input w-full sm:w-80 xxl:w-full mt-2 sm:mt-0 border" id="tabulator-html-filter-value" placeholder="Хайлт үг...">
                    </div>
                    <div class="mt-2 xl:mt-0">
                        <button type="button" class="button w-full sm:w-28 bg-theme-1 text-white" id="tabulator-html-filter-go">Хайлт хийх</button>
                        <button type="button" class="button w-full sm:w-20 mt-2 sm:mt-0 sm:ml-1 bg-gray-200 text-gray-600 dark:bg-dark-5 dark:text-gray-300" id="tabulator-html-filter-reset">Арилгах</button>
                    </div>
                </form>
            </div>
            <div class="overflow-x-auto scrollbar-hidden">
                <div class="mt-5 table-report table-report--tabulator" id="teacher_huvaari_tabulator"></div>
            </div>
            @endif
        </div>
        <!-- END: HTML Table Data -->
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection