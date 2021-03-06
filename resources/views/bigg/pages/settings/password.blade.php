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
                    <a class="flex items-center mt-5 text-theme-1 dark:text-theme-10 font-medium" href="{{route('bigg-settings-password')}}">
                        <i data-feather="lock" class="w-4 h-4 mr-2"></i> Нууц үг солих
                    </a>
                </div>
                <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                    <a class="flex items-center" href="{{route('bigg-settings-huvaari')}}">
                        <i data-feather="calendar" class="w-4 h-4 mr-2"></i> Хуваарь тохиргоо
                    </a>
                </div>
            </div>
        </div>
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Нууц үг солих -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">Нууц үг солих</h2>
                </div>
                <div class="p-5">
                    <div>
                        <label>Хуучин нууц үг</label>
                        <input type="password" class="input w-full border mt-2" />
                    </div>
                    <div class="mt-3">
                        <label>Шинэ нууц үг</label>
                        <input type="password" class="input w-full border mt-2" />
                    </div>
                    <div class="mt-3">
                        <label>Шинэ нууц үг давтах</label>
                        <input type="password" class="input w-full border mt-2" />
                    </div>
                    <button type="button" class="button bg-theme-1 text-white mt-4">Нууц үг солих</button>
                </div>
            </div>
            <!-- END: Нууц үг солих -->
        </div>
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection