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
        <div class="intro-y col-span-12 lg:col-span-8">
            <form class="validate-form-teacher" action="{{ route('bigg-tenhim-save') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- BEGIN: Анги нэмэх -->
                <div class="intro-y box p-5">
                    <div class="input-form">
                        <label class="flex flex-col sm:flex-row">
                        {{ $page_title }} нэр: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Криллээр бичнэ</span>
                        </label>
                        <input type="text" name="ner" placeholder="Ерөнхий эрдмийн тэнхим" class="form-control w-full border mt-2" minlength="2" required data-pristine-minlength-message="2 тэмдэгдээс дээш байх ёстой" data-pristine-required-message="Багшийн мэргэжлийн нэр хоосон байж болохгүй"/>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="window.location.href='{{ route('bigg-tenhim') }}'" class="btn w-40 bg-theme-6 text-white ml-5">{{ __('site.cancel') }}</button> 
                        <button type="submit" name="action" value="save_and_new" class="btn w-40 bg-theme-1 text-white ml-5">{{ __('site.save_and_new') }}</button> 
                        <button type="submit" name="action" value="save" class="btn w-40 bg-theme-1 text-white ml-5">{{ __('site.save') }}</button>
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