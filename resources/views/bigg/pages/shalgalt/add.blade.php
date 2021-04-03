@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{ $page_title }}</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <form class="validate-form-teacher" action="{{ route('bigg-shalgalt-save') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- BEGIN: Шалгалт нэмэх -->
                <div class="intro-y box p-5">
                    <div class="input-form">
                        <label class="flex flex-col sm:flex-row">
                        Шалгалтын нэр: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Криллээр бичнэ</span>
                        </label>
                        <input type="text" name="ner" class="input w-full border mt-2" minlength="2" required data-pristine-minlength-message="2 тэмдэгдээс дээш байх ёстой" data-pristine-required-message="Багшийн мэргэжлийн нэр хоосон байж болохгүй"/>
                    </div>
                    <div class="input-form mt-3">
                        <label class="flex flex-col sm:flex-row">
                        Тусламжийн үг: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Криллээр бичнэ</span>
                        </label>
                        <textarea class="input w-full border mt-2" name="help" placeholder="Шалгалтын тусламж болон заавар бичих"></textarea>
                    </div>
                    <div class="input-form mt-3">
                        <label class="flex flex-col sm:flex-row">
                        Ангиуд:
                        </label>
                        <div class="mt-2">
                            <select data-placeholder="Анги сонгоно уу!" name="angiud[]" data-search="true" class="tail-select w-full" multiple>
                                @if($angis->isEmpty())
                                    <option value="0">Анги хоосон байна!</option>
                                @else
                                    @foreach($angis as $angi)
                                    <option value="{{ $angi->id }}">{{ $angi->ner }} {{ $angi->course }}{{ $angi->buleg }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="input-form mt-3">
                        <label class="flex flex-col sm:flex-row">
                        Хугацаа: 
                        </label>
                        <input data-daterange="true" name="range" class="datepicker input w-full border mt-2 block"> 
                    </div>
                    <div class="input-form mt-3">
                        <label class="flex flex-col sm:flex-row">
                        Эхлэх, дуусах хугацаа: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Цаг : Минут - Цаг : Минут</span>
                        </label>
                        <div class="inline-flex text-lg border rounded-md p-1 mt-3 col-span-4">
                            <select name="tsags" class="px-2 outline-none appearance-none bg-transparent">
                                @for($i = 0; $i <= 23; $i++)
                                <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                            <span class="px-2">:</span>
                            <select name="minuts" class="px-2 outline-none appearance-none bg-transparent">
                                @for($i = 0; $i <= 55; $i+=5)
                                <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                        </div> - 
                        <div class="inline-flex text-lg border rounded-md p-1 mt-3 col-span-4">
                            <select name="tsage" class="px-2 outline-none appearance-none bg-transparent">
                                @for($i = 0; $i <= 23; $i++)
                                <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                            <span class="px-2">:</span>
                            <select name="minute" class="px-2 outline-none appearance-none bg-transparent">
                                @for($i = 0; $i <= 55; $i+=5)
                                <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="input-form mt-3">
                        <label class="flex flex-col sm:flex-row">
                        Тэнцэх оноо:
                        </label>
                        <div class="relative mt-2"> 
                            <input type="number" name="tentseh" class="input pr-12 w-full border col-span-4" placeholder="Хувь" value="80" />
                            <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">%</div>
                        </div>
                    </div>
                    <div class="input-form mt-3">
                        <label class="flex flex-col sm:flex-row">
                        Шалгалт бөглөх цаг: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Хоосон байвал цаггүй шалгалт авна</span>
                        </label>
                        <div class="relative mt-2"> 
                            <input type="number" name="shalgalt" class="input pr-12 w-full border col-span-4" placeholder="Минутаар бичнэ. Жиш нь: 80" value="" />
                            <div class="absolute top-0 right-0 rounded-r w-20 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">минут</div>
                        </div>
                        <div class="text-xs text-gray-600 mt-2">Минут дуусмагч автоматаар шалгалт дуусгах болно.</div>
                    </div>
                    <div class="input-form mt-5">
                        <div class="form-check">
                            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                                    <input data-target="#input" name="is_shalgalt" class="show-code input input--switch border" type="checkbox" checked>
                                    <div class="ml-3">Нэг удаа шалгалт өгнө</div>
                                </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="window.location.href='{{ route('bigg-shalgalt') }}'" class="button w-40 bg-theme-6 text-white ml-5">{{ __('site.cancel') }}</button> 
                        <button type="submit" name="action" value="save" class="button w-40 bg-theme-1 text-white ml-5">{{ __('site.save') }}</button>
                    </div>
                </div>
                <!-- END: Шалгалт нэмэх -->
            </div>
        </form>
    </div> 
@endsection

@section('style')
@endsection

@section('script')
@endsection