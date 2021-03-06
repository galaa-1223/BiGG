@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Тохиргоо талбар</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="{{ config('settings.site_name') }}" class="rounded-full" src="{{ ($user->image == null) ? asset('dist/images/Blank-avatar.png') : asset('uploads/users/thumbs/'.$user->image)}}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">{{ $user->name }}</div>
                        <div class="text-gray-600">{{ $user->email }}</div>
                    </div>
                </div>
                <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                    <a class="flex items-center" href="{{route('bigg-settings')}}">
                        <i data-feather="activity" class="w-4 h-4 mr-2"></i> Хувийн мэдээлэл
                    </a>
                    <a class="flex items-center mt-5" href="{{route('bigg-settings-password')}}">
                        <i data-feather="lock" class="w-4 h-4 mr-2"></i> Нууц үг солих
                    </a>
                </div>
                <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                    <a class="flex items-center text-theme-1 dark:text-theme-10 font-medium" href="{{route('bigg-settings-huvaari')}}">
                        <i data-feather="calendar" class="w-4 h-4 mr-2"></i> Хуваарь тохиргоо
                    </a>
                </div>
            </div>
        </div>
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Хуваарь тохиргоо -->
            <form class="validate-form-teacher" action="{{ route('bigg-teachers-save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">Хуваарь тохиргоо</h2>
                </div>
                <div class="p-5">
                    <div class="input-form">
                        <label class="flex flex-col sm:flex-row">
                            Хичээлийн эхлэх цаг: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Цаг, Минут</span>
                        </label>
                        <input type="text" name="huvaari_ehleh" class="input w-full border mt-2" placeholder="08:30" value="{{config('settings.huvaari_ehleh')}}" required data-pristine-required-message="Хичээлийн эхлэх цаг хоосон байж болохгүй"/>
                    </div>
                    <div class="input-form mt-3">
                        <label class="flex flex-col sm:flex-row">
                            Өдрийн хичээллэх цаг: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Тоо</span>
                        </label>
                        <input type="text" name="huvaari_hicheelleh" class="input w-full border mt-2" placeholder="7" value="{{config('settings.huvaari_hicheelleh')}}" required data-pristine-required-message="Өдрийн хичээллэх цаг хоосон байж болохгүй"/>
                    </div>
                    <div class="input-form mt-3">
                        <label class="flex flex-col sm:flex-row">
                            Хичээлийн үргэлжлэх хугацаа: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Минут</span>
                        </label>
                        <input type="text" name="huvaari_urgeljleh" class="input w-full border mt-2" placeholder="80" value="{{config('settings.huvaari_urgeljleh')}}" required data-pristine-required-message="Хичээлийн үргэлжлэх хугацаа хоосон байж болохгүй"/>
                    </div>
                    <div class="input-form mt-3">
                        <label class="flex flex-col sm:flex-row">
                            Засварлагааны хугацаа: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Минут</span>
                        </label>
                        <input type="text" name="huvaari_zavsarlaga" class="input w-full border mt-2" placeholder="5" value="{{config('settings.huvaari_zavsarlaga')}}" required data-pristine-required-message="Засварлагааны хугацаа хоосон байж болохгүй"/>
                    </div>
                    <div class="input-form mt-3">
                        <label class="flex flex-col sm:flex-row">
                            Их завсарлага: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Минут</span>
                        </label>
                        <input type="text" name="huvaari_ih_zavsarlaga" class="input w-full border mt-2" placeholder="30" value="{{config('settings.huvaari_ih_zavsarlaga')}}" required data-pristine-required-message="Их завсарлага хоосон байж болохгүй"/>
                    </div>
                    <button type="submit" name="action" value="save" class="button bg-theme-1 text-white mt-4">{{ __('site.save') }}</button>
                </div>
            </div>
            </form>
            <!-- END: Change Password -->
        </div>
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection