@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{ $page_title }} талбар</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="button text-white bg-theme-1 shadow-md mr-2">Багш нэмэх</button>
            <div class="dropdown ml-auto sm:ml-0">
                <button class="dropdown-toggle button px-2 box text-gray-700 dark:text-gray-300">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-feather="plus"></i>
                    </span>
                </button>
                <div class="dropdown-box w-40">
                    <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <i data-feather="file-plus" class="w-4 h-4 mr-2"></i> Тэнхим нэмэх
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box p-5 mt-5">
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
                    <input type="text" class="input w-full sm:w-50 xxl:w-full mt-2 sm:mt-0 border" id="tabulator-html-filter-value" placeholder="Хайлт үг...">
                </div>
                <div class="mt-2 xl:mt-0">
                    <button type="button" class="button w-full sm:w-28 bg-theme-1 text-white" id="tabulator-html-filter-go">Хайлт хийх</button>
                    <button type="button" class="button w-full sm:w-20 mt-2 sm:mt-0 sm:ml-1 bg-gray-200 text-gray-600 dark:bg-dark-5 dark:text-gray-300" id="tabulator-html-filter-reset">Арилгах</button>
                </div>
            </form>
        </div>
        <div class="overflow-x-auto scrollbar-hidden">
            <div class="mt-5 table-report table-report--tabulator" id="teacher_fond_tabulator"></div>
        </div>
        @endif
    </div>
    <!-- END: HTML Table Data -->
    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal">
        <div class="modal__content">
            <form action="{{ route('bigg-teachers-delete-ajax') }}" method="post">
            @csrf
                <input type="hidden" class="t_id" name="t_id" value="">
                <div class="p-5 text-center">
                    <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Сонгосон багшийг устгахыг хүсэж байна уу?</div>
                    <div class="text-gray-600 mt-2">Баазаас нэг мөсөн устгагдахыг анхаарна уу!</div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">{{ __('site.cancel') }}</button>
                    <button type="submit" class="modal_delete_button_tabulator button w-24 bg-theme-6 text-white">{{ __('site.delete') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
@endsection

@section('style')
@endsection

@section('script')
@endsection