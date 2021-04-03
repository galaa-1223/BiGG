@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{ $page_title }} талбар</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <form class="validate-form-teacher validate-form" action="{{ route('bigg-angi-save') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- BEGIN: Анги нэмэх -->
                <div class="intro-y box p-5">
                    <div class="input-form">
                        <label class="flex flex-col sm:flex-row">
                        Мэргэжил:
                        </label>
                        <div class="mt-2">
                            <select name="m_id" data-search="true" class="tail-select w-full">
                                {{-- {{dd($bolovsrols)}} --}}
                                @if(count($bolovsrols))
                                    @foreach($bolovsrols as $bolovsrol):
                                    <optgroup label="{{ $bolovsrol->ner }}">
                                        @foreach($mergejils as $mergejil):
                                            @if($bolovsrol->id == $mergejil->bolovsrol)
                                                <option value="{{ $mergejil->id }}"> --- {{ $mergejil->ner }}  /{{ $mergejil->jil }} жил/ </option>
                                            @endif
                                        @endforeach;
                                    </optgroup>
                                    @endforeach;
                                @else
                                    <option value="">Хоосон байна</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="input-form mt-3">
                        <label class="flex flex-col sm:flex-row">
                        Ангийн багш: 
                        </label>
                        <div class="mt-2">
                            <select name="b_id" data-search="true" class="tail-select w-full">
                                @if(count($teachers))
                                    <option value="0">Багшгүй</option>
                                    @foreach($teachers as $teacher):
                                        <option value="{{ $teacher->id }}">{{ Str::substr($teacher->ovog, 0, 1) }}. {{ $teacher->ner }}</option>
                                    @endforeach;
                                @else
                                    <option value="">Хоосон байна</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="input-form mt-3">
                        <label class="flex flex-col sm:flex-row">
                            Анги: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Курс тоогоор, Бүлэг Монгол үсгээр бичнэ.</span>
                        </label>
                        <div class="sm:grid grid-cols-3 gap-2">
                            <div class="relative mt-2">
                                <div class="absolute top-0 left-0 rounded-l px-4 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">Курс</div>
                                <div class="pl-6">
                                    <input type="text" name="course" class="form-control pl-12 w-full border col-span-4" value="1" minlength="1" maxlength="1" required data-pristine-integer-message="Тоо оруулна уу" data-pristine-minlength-message="1 тэмдэгт байх ёстой" data-pristine-maxlength-message="1 тэмдэгт байх ёстой" data-pristine-required-message="Курс хоосон байж болохгүй">
                                </div>
                            </div>
                            <div class="relative mt-2">
                                <div class="absolute top-0 left-0 rounded-l px-4 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">Бүлэг</div>
                                <div class="pl-8">
                                    <input type="text" name="buleg" class="form-control pl-20 w-full border col-span-4" value="А" minlength="1" maxlength="1" required data-pristine-required-message="Бүлэг хоосон байж болохгүй">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" name="action" value="save" class="btn bg-theme-1 text-white ml-5">{{ __('site.save') }}</button>
                    </div>
                </div>
                <!-- END: Анги нэмэх -->
            </form>
        </div>
    </div> 
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-8">
        @if(!count($angiud))
                <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-17 text-theme-11">
                    <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> Мэдээлэл алга байна!
                </div>
            @else
            <table id="table" class="table table-report mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">Хичээлийн нэр</th>
                        <th class="whitespace-nowrap text-center">Товч нэр</th>
                        <th class="whitespace-nowrap text-center">Оюутны тоо</th>
                        <th class="text-center whitespace-nowrap">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $i = 1;?>
                        @foreach($angiud as $angi)
                        <tr class="intro-x">
                            <td class="w-10">
                                <div class="flex">
                                <?=(($angiud->currentpage()-1) * $angiud->perpage() + $i);?>
                                </div>
                            </td>
                            <td>
                                <a href="#" class="font-medium whitespace-nowrap">{{ $angi->ner }} {{ $angi->course }}{{ $angi->buleg }}</a>
                                <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5">{{ Str::substr($angi->ovog, 0, 1) }}. {{ $angi->bagsh }}</div>
                            </td>
                            <td class="text-center">
                                <a href="#" class="font-medium whitespace-nowrap">{{ $angi->tovch }}</a>
                            </td>
                            <td class="text-center">
                                0
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ url('bigg/angi/edit/'.$angi->id) }}">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i> {{ __('site.edit') }}
                                    </a>
                                    <a class="flex items-center text-theme-6 delete_button" href="javascript:;" data-id="{{ $angi->id }}" data-target="#delete-confirmation-modal">
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
            {{ $angiud->links() }}
        </div>
    </div> 
    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <div class="modal-body p-0"> 
                    <form action="{{ route('bigg-angi-delete-ajax') }}" method="post">
                    @csrf
                        <input type="hidden" class="t_id" name="t_id" value="">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">Сонгосон ангийг устгахыг хүсэж байна уу?</div>
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