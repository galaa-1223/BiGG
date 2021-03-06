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
            <form class="validate-form-teacher" action="{{ route('bigg-mergejil-save') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- BEGIN: Анги нэмэх -->
                <div class="intro-y box p-5">
                    <div class="input-form">
                        <label class="flex flex-col sm:flex-row">
                        Мэргэжлийн нэр: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Криллээр бичнэ</span>
                        </label>
                        <input type="text" name="ner" placeholder="Авто засварчин" class="input w-full border mt-2" minlength="2" required data-pristine-minlength-message="2 тэмдэгдээс дээш байх ёстой" data-pristine-required-message="Багшийн мэргэжлийн нэр хоосон байж болохгүй"/>
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
                        <button type="button" onclick="window.location.href='{{ route('bigg-mergejil') }}'" class="button w-40 bg-theme-6 text-white ml-5">{{ __('site.cancel') }}</button> 
                        <button type="submit" name="action" value="save_and_new" class="button w-40 bg-theme-1 text-white ml-5">{{ __('site.save_and_new') }}</button> 
                        <button type="submit" name="action" value="save" class="button w-40 bg-theme-1 text-white ml-5">{{ __('site.save') }}</button>
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