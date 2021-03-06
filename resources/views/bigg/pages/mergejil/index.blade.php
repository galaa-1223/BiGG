@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <h2 class="intro-y text-lg font-medium mt-10">{{ $page_title }} талбар</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('bigg-mergejil-add') }}" class="button text-white bg-theme-1 shadow-md mr-2">{{ $page_title }} нэмэх</a>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            @if(!count($mergejils))
                <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-17 text-theme-11">
                    <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> Мэдээлэл алга байна!
                </div>
            @else
            <table id="table" class="table table-report mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">Мэргэжлийн нэр</th>
                        <th class="text-center whitespace-nowrap">Суралцах хугацаа</th>
                        <th class="text-center whitespace-nowrap">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $i = 1;?>
                        @foreach($mergejils as $mergejil)
                        <tr class="intro-x">
                            <td class="w-10">
                                <div class="flex">
                                    {{ $i }}
                                </div>
                            </td>
                            <td>
                                <a href="" class="font-medium whitespace-nowrap">{{ $mergejil->ner }}</a>
                                <div class="text-gray-600 text-xs mt-0.5">{{ $mergejil->mergejil }}</div>
                            </td>
                            <td class="text-center">{{ $mergejil->jil }} жил</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="javascript:;">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i> {{ __('site.edit') }}
                                    </a>
                                    <a class="flex items-center text-theme-6 delete_button" href="javascript:;" data-id="{{ $mergejil->id }}" data-target="#delete-confirmation-modal">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> {{ __('site.delete') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++;?>
                        @endforeach
                </tbody>
            </table>
            @endif
        </div>
        <!-- END: Data List -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal">
        <div class="modal__content">
            <form action="{{ route('bigg-mergejil-delete-ajax') }}" method="post">
            @csrf
                <input type="hidden" class="t_id" name="t_id" value="">
                <div class="p-5 text-center">
                    <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Сонгосон мэргэжлийг устгахыг хүсэж байна уу?</div>
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