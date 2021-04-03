@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <h2 class="intro-y text-lg font-medium mt-10">{{ $page_title }} талбар</h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <form class="validate-form-teacher validate-form" action="{{ route('bigg-mergejil-save') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- BEGIN: Анги нэмэх -->
                    <div class="intro-y box p-5">
                        <div class="input-form">
                            <label class="flex flex-col sm:flex-row">
                            Мэргэжлийн нэр: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Криллээр бичнэ</span>
                            </label>
                            <input type="text" name="ner" placeholder="Авто засварчин" class="form-control w-full border mt-2" minlength="2" required data-pristine-minlength-message="2 тэмдэгдээс дээш байх ёстой" data-pristine-required-message="Мэргэжлийн нэр хоосон байж болохгүй"/>
                        </div>
                        <div class="input-form mt-3">
                            <label class="flex flex-col sm:flex-row">
                            Боловсрол: 
                            </label>
                            <div class="mt-2">
                                <select name="bolovsrol" data-search="true" class="tail-select w-full">
                                    @if(count($bolovsrols))
                                        @foreach($bolovsrols as $bolovsrol):
                                            <option value="{{ $bolovsrol->id }}">{{ $bolovsrol->ner }}</option>
                                        @endforeach;
                                    @else
                                        <option value="">Хоосон байна</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="input-form mt-3">
                            <label class="flex flex-col sm:flex-row">
                                Суралцах жил: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600"></span>
                            </label>
                            <div class="sm:grid grid-cols-3 gap-2">
                                <div class="relative mt-2">
                                        <select name="jil" class="tail-select w-full">
                                            <option value="1">1 жил</option>
                                            <option value="1.5">1.5 жил</option>
                                            <option value="2">2 жил</option>
                                            <option value="2.5">2.5 жил</option>
                                            <option value="3">3 жил</option>
                                            <option value="3.5">3.5 жил</option>
                                            <option value="4">4 жил</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" name="action" value="save" class="btn w-40 bg-theme-1 text-white ml-5">{{ __('site.save') }}</button>
                        </div>
                    </div>
                    <!-- END: Анги нэмэх -->
                </form>
            </div>
        </div> 
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-8">
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
                                    <a class="flex items-center mr-3" href="{{ url('bigg/mergejil/edit/'.$mergejil->id) }}">
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
            {{ $mergejils->links() }}
        </div>
        <!-- END: Data List -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <div class="modal-body p-0"> 
                    <form action="{{ route('bigg-mergejil-delete-ajax') }}" method="post">
                    @csrf
                        <input type="hidden" class="t_id" name="t_id" value="">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">Сонгосон мэргэжлийг устгахыг хүсэж байна уу?</div>
                            <div class="text-gray-600 mt-2">Баазаас нэг мөсөн устгагдахыг анхаарна уу!</div>
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="btn w-24 dark:border-dark-5 dark:text-gray-300 mr-1">{{ __('site.cancel') }}</button>
                            <button type="submit" class="modal_delete_button btn w-24 bg-theme-6 text-white">{{ __('site.delete') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
@endsection

@section('style')
@endsection

@section('script')
@endsection