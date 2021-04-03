@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <h2 class="intro-y text-lg font-medium mt-10">{{ Str::substr($teacher->ovog, 0, 1)}}. {{ $teacher->ner }} багшийн цагийн фонд</h2>
    <div class="intro-y text-gray-600 text-xs whitespace-nowrap mt-0.5">{{ $teacher->mergejil }}</div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <form class="validate-form-teacher" action="{{ route('bigg-teachers-fond-save') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- BEGIN: Фонд нэмэх -->
                <input type="hidden" name="t_id" value="{{ $t_id }}" />
                <div class="intro-y box p-5">
                    <div class="input-form">
                        <label class="flex flex-col sm:flex-row">
                        Анги:
                        </label>
                        <div class="mt-2">
                            <select name="a_id" data-search="true" class="tail-select w-full">
                                @if($angis)
                                    @foreach($angis as $angi):
                                        <option value="{{ $angi->id }}">{{ $angi->ner }} {{ $angi->course }}{{ $angi->buleg }}</option>
                                    @endforeach;
                                @else
                                    <option value="">Хоосон байна</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="input-form mt-3">
                        <label class="flex flex-col sm:flex-row">
                        Хичээл: 
                        </label>
                        <div class="mt-2">
                            <select name="h_id" data-search="true" class="tail-select w-full">
                                @if($hicheels)
                                    @foreach($hicheels as $hicheel):
                                        <option value="{{ $hicheel->id }}">{{ $hicheel->ner }}</option>
                                    @endforeach;
                                @else
                                    <option value="">Хоосон байна</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="input-form mt-3">
                        <label class="flex flex-col sm:flex-row">
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">.</span>
                        </label>
                        <div class="sm:grid grid-cols-3 gap-2">
                            <div class="relative mt-2">
                                <div class="absolute top-0 left-0 rounded-l px-4 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">Цаг: </div>
                                <div class="pl-6">
                                    <input type="text" name="tsag" class="form-control pl-12 w-full border col-span-4" value="72" minlength="1" maxlength="4" required data-pristine-integer-message="Тоо оруулна уу" data-pristine-minlength-message="1 тэмдэгт байх ёстой" data-pristine-maxlength-message="1 тэмдэгт байх ёстой" data-pristine-required-message="Курс хоосон байж болохгүй">
                                </div>
                            </div>
                            <div class="relative mt-2">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="window.location.href='{{ route('bigg-teachers-fond') }}'" class="btn w-40 bg-theme-6 text-white ml-5">{{ __('site.cancel') }}</button> 
                        <button type="submit" name="action" value="save" class="btn bg-theme-1 text-white ml-5">{{ __('site.save') }}</button>
                    </div>
                </div>
                <!-- END: Фонд нэмэх -->
            </form>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-10 overflow-auto lg:overflow-visible">
            @if($fonds->isEmpty())
                <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-17 text-theme-11">
                    <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> Мэдээлэл алга байна!
                </div>
            @else
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">Ангийн нэр</th>
                        <th class="text-center whitespace-nowrap">Хичээл</th>
                        <th class="text-center whitespace-nowrap">Цаг</th>
                        <th class="text-center whitespace-nowrap">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody>
                        <?php 
                            $i = 1;
                            $tsag = 0;
                        ?>
                        @foreach($fonds as $fond)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    {{ $i }}
                                </div>
                            </td>
                            <td>
                                <a href="" class="font-medium whitespace-nowrap">{{ $fond->angi }} {{ $fond->course }}{{ $fond->buleg }}</a>
                            </td>
                            <td class="text-center">{{ $fond->hicheel }}</td>
                            <td class="text-center">{{ $fond->tsag }}</td>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="javascript:;">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i> {{ __('site.edit') }}
                                    </a>
                                    <a class="flex items-center text-theme-6 delete_button" href="javascript:;" data-target="#delete-confirmation-modal" data-id="{{ $fond->fid }}">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> {{ __('site.delete') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            $i++;
                            $tsag += $fond->tsag;
                        ?>
                        @endforeach
                        <tr class="intro-x">
                            <td class="w-40"></td>
                            <td></td>
                            <td></td>
                            <td class="text-center text-pink-800 font-bold">{{ $tsag }}</td>
                            <td></td>
                        </tr>
                </tbody>
            </table>
            @endif
        </div>
        <!-- END: Data List -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal">
        <div class="modal__content">
            <form action="{{ route('bigg-teachers-fond-delete-ajax') }}" method="post">
            @csrf
                <input type="hidden" class="t_id" name="t_id" value="">
                <input type="hidden" name="tid" value="{{ $t_id }}" />
                <div class="p-5 text-center">
                    <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Сонгосон цагийн фонд устгахыг хүсэж байна уу?</div>
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