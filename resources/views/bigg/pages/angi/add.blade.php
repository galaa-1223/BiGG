@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Анги нэмэх</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <form class="validate-form-teacher" action="{{ route('bigg-angi-save') }}" method="post" enctype="multipart/form-data">
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
                                    <option value="">Багшгүй</option>
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
                                    <input type="text" name="course" class="input pl-12 w-full border col-span-4" value="1" minlength="1" maxlength="1" required data-pristine-integer-message="Тоо оруулна уу" data-pristine-minlength-message="1 тэмдэгт байх ёстой" data-pristine-maxlength-message="1 тэмдэгт байх ёстой" data-pristine-required-message="Курс хоосон байж болохгүй">
                                </div>
                            </div>
                            <div class="relative mt-2">
                                <div class="absolute top-0 left-0 rounded-l px-4 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">Бүлэг</div>
                                <div class="pl-8">
                                    <input type="text" name="buleg" class="input pl-20 w-full border col-span-4" value="А" minlength="1" maxlength="1" required data-pristine-required-message="Бүлэг хоосон байж болохгүй">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="window.location.href='{{ route('bigg-angi') }}'" class="button bg-theme-6 text-white ml-5">{{ __('site.cancel') }}</button> 
                        <button type="submit" name="action" value="save_and_new" class="button bg-theme-1 text-white ml-5">{{ __('site.save_and_new') }}</button> 
                        <button type="submit" name="action" value="save" class="button bg-theme-1 text-white ml-5">{{ __('site.save') }}</button>
                    </div>
                </div>
                <!-- END: Анги нэмэх -->
            </div>
        </form>
    </div> 
@endsection

@section('style')
@endsection

@section('script')
@endsection