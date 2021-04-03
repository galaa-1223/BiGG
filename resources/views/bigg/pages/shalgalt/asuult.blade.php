@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <!-- BEGIN: Asuult Garchig -->
    <div class="intro-y box px-5 pt-5 mt-5">
        <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
            <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                <div class="ml-5">
                    <div class="w-full truncate sm:whitespace-normal font-medium text-lg">{{ $shalgalt->ner }}</div>
                    <div class="text-gray-600">Bagsh ner</div>
                    <div class="text-gray-600">
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-indigo-100 bg-indigo-700 rounded">NEW</span>
                    </div>
                </div>
            </div>
            <div class="mt-6 lg:mt-0 flex-2 px-5 border-l border-r border-gray-200 border-t lg:border-t-0 pt-5 lg:pt-0">
                <div class="font-medium text-center lg:text-left lg:mt-5">Contact Details</div>
                <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                    <div class="truncate sm:whitespace-normal flex items-center bg-theme-14 p-1">{{ $shalgalt->start }}</div>
                    <div class="truncate sm:whitespace-normal flex items-center mt-3 bg-theme-31 p-1">{{ $shalgalt->end }}</div>
                    <div class="truncate sm:whitespace-normal flex items-center mt-3">Тэнцэх оноо: {{ $shalgalt->tentseh }}</div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- END: Asuult Garchig -->
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Asuultuud Table -->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                    <a href="{{ route('bigg-shalgalt-asuult-add', $id) }}" class="button w-full bg-theme-1 text-white mt-3">Асуулт нэмэх</a>
                </div>
                <div class="p-5" id="basic-table">
                    <div class="preview">
                        <div class="overflow-x-auto">
                        @if($asuults->isEmpty())
                            <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-31 text-theme-35">
                                <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> Асуулт оруулаагүй байна!.
                            </div>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-b-2 whitespace-nowrap w-10">#</th>
                                        <th class="border-b-2 whitespace-nowrap">Асуултын нэр</th>
                                        <th class="border-b-2 whitespace-nowrap"></th>
                                        <th class="border-b-2 whitespace-nowrap"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($asuults as $asuult)
                                    <tr>
                                        <td class="border-b">{{ $i }}.</td>
                                        <td class="border-b"><a href="#" class="ajax_shalgalt" data-ajax="/bigg/shalgalt/ajax_hariult?id={{ $asuult->id }}&h_id={{ $i }}" data-viewer="hariult_viewer">{{ $asuult->asuult }}</a> </td>
                                        <td class="border-b w-10">
                                        <?php if($asuult->type == 'neg'):?>
                                            <span class="inline-flex text-right px-2 py-1 mr-2 text-xs leading-none bg-theme-20 text-white bg-red-600 rounded-full">Нэг</span>
                                        <?php elseif($asuult->type == 'olon'): ?>
                                            <span class="inline-flex text-right px-2 py-1 mr-2 text-xs leading-none bg-theme-32 text-white bg-red-600 rounded-full">Олон</span>
                                        <?php endif;?>
                                        </td>
                                        <td class="border-b w-10">
                                            <a href="#" class="tooltip delete_button" title="Устгах" data-id="{{ $asuult->id }}" data-target="#delete-confirmation-modal"><i data-feather="x" class="mx-auto text-theme-6"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                        </div>
                    </div>
                   
                </div>
            </div>
            <!-- END: Asuultuud Table -->
                
        </div>
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Hariult Rows -->
                <div id="hariult_viewer"></div>
            <!-- END: Hariult Rows -->
        </div>
    </div>

    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal">
        <div class="modal__content">
            <form action="{{ route('bigg-shalgalt-asuult-delete-ajax') }}" method="post">
            @csrf
                <input type="hidden" class="t_id" name="t_id" value="">
                <input type="hidden" class="a_id" name="a_id" value="{{ $id }}">
                <div class="p-5 text-center">
                    <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Сонгосон асуултыг устгахыг хүсэж байна уу?</div>
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