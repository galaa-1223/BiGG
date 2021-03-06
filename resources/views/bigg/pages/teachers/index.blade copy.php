@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <h2 class="intro-y text-lg font-medium mt-10">Багшийн талбар</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <button onclick="window.location.href='{{ route('teachers') }}'" class="button text-white bg-theme-1 shadow-md mr-2">Багш нэмэх</button>
            <div class="hidden md:block mx-auto text-gray-600">Нийт багшийн тоо:</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="{{ __('site.search') }}...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Багшийн талбар -->
            @foreach($teachers as $teacher)
            <div class="intro-y col-span-12 md:col-span-6">
                <div class="box">
                    <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                            <img alt="{{ $teacher->ovog }} {{ $teacher->ner }}" class="rounded-full" src="{{ ($teacher->image == null) ? asset('dist/images/Blank-avatar.png') : asset('uploads/teachers/thumbs/'.$teacher->image)}}">
                        </div>
                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                            <a href="" class="font-medium">{{ Str::substr($teacher->ovog, 0, 1) }}. {{ $teacher->ner }}</a>
                            <div class="text-gray-600 text-xs mt-0.5">jobs</div>
                        </div>
                        <div class="flex -ml-2 lg:ml-0 lg:justify-end mt-3 lg:mt-0">
                            <a href="{{ route('teachers-edit', $teacher->id) }}" class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-dark-5 ml-2 text-gray-500 zoom-in tooltip" title="{{ __('site.edit') }}">
                                <i class="w-3 h-3 fill-current" data-feather="edit-2"></i>
                            </a>
                            <a class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-dark-5 ml-2 text-gray-500 zoom-in tooltip delete_button" href="javascript:;" data-id="{{ $teacher->id }}" data-target="#delete-confirmation-modal" title="{{ __('site.delete') }}">
                                    <i class="w-3 h-3 fill-current" data-feather="trash"></i>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-wrap lg:flex-nowrap items-center justify-center p-5">
                        <div class="w-full lg:w-1/2 mb-4 lg:mb-0 mr-auto">
                            <div class="flex text-gray-600 text-xs">
                                <div class="mr-auto">Анкет бөглөлт</div>
                                <div>20%</div>
                            </div>
                            <div class="w-full h-1 mt-2 bg-gray-400 dark:bg-dark-1 rounded-full">
                                <div class="w-1/4 h-full bg-theme-1 dark:bg-theme-10 rounded-full"></div>
                            </div>
                        </div>
                        <button class="button button--sm text-white bg-theme-1 mr-2">Захиа илгээх</button>
                        <button class="button button--sm text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300">Профайл</button>
                    </div>
                </div>
            </div>
            @endforeach
        <!-- END: Багшийн талбар -->
    </div>
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
                    <button type="submit" class="modal_delete_button button w-24 bg-theme-6 text-white">{{ __('site.delete') }}</button>
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