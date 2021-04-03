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
            <form class="validate-form-teacher validate-form" action="{{ route('bigg-mergejil_bagsh-edit', $mergejilBagsh->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- BEGIN: Тэнхим нэмэх -->
                <div class="intro-y box p-5">
                    <div class="input-form">
                        <label class="flex flex-col sm:flex-row">
                        Тэнхимийн нэр: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Криллээр бичнэ</span>
                        </label>
                        <input type="text" name="ner" placeholder="Компьютерийн үндэс" value="{{ $mergejilBagsh->ner }}" class="form-control w-full border mt-2" minlength="2" required data-pristine-minlength-message="2 тэмдэгдээс дээш байх ёстой" data-pristine-required-message="Тэнхимийн нэр хоосон байж болохгүй"/>
                    </div>
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('bigg-mergejil_bagsh') }}" type="submit" class="btn w-40 bg-theme-1 text-white ml-5">Болих</a>
                        <button type="submit" name="action" value="save" class="btn w-40 bg-theme-1 text-white ml-5">{{ __('site.edit') }}</button>
                    </div>
                </div>
                <!-- END: Тэнхим нэмэх -->
            </form>
        </div>
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection