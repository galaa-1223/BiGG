<!-- BEGIN: Top Bar -->
<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <a href="" class="">{{ __('site.home') }}</a>
        <i data-feather="chevron-right" class="breadcrumb__icon"></i>
        <a href="/bigg/{{ $page_name }}" class="breadcrumb--active">{{ $page_title }}</a>
    </div>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Мэдэгдэл -->
    <div class="intro-x dropdown mr-auto sm:mr-6">
        <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false"> <i data-feather="bell" class="notification__icon dark:text-gray-300"></i> </div>
        <div class="notification-content pt-2 dropdown-menu">
            <div class="notification-content__box dropdown-menu__content box dark:bg-dark-6">
                <div class="notification-content__title">Мэдэгдэл</div>
                @foreach($notifications as $notification)
                <div class="cursor-pointer relative flex items-center mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                    <img alt="BiGG system" class="rounded-full" src="{{ ($user->image == null) ? asset('dist/images/Blank-avatar.png') : asset('uploads/users/thumbs/'.$user->image)}}">
                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden w-full">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">{{ $notification->name }}</a> 
                            <div class="text-xs text-gray-500 ml-auto whitespace-nowrap">{{ date("H:i", strtotime($notification->updated_at)) }}</div>
                        </div>
                        <div class="w-full truncate text-gray-600 mt-0.5">{{ $notification->description }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- END: Мэдэгдэл -->
    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false">
            <img alt="{{ config('settings.site_name') }}" src="{{ ($user->image == null) ? asset('dist/images/Blank-avatar.png') : asset('uploads/users/thumbs/'.$user->image)}}">
        </div>
        <div class="dropdown-menu w-56">
            <div class="dropdown-menu__content box bg-theme-26 dark:bg-dark-6 text-white">
                <div class="p-4 border-b border-theme-27 dark:border-dark-3">
                    <div class="font-medium">{{ $user->name }}</div>
                    <div class="text-xs text-theme-41 dark:text-gray-600">{{ $user->email }}</div>
                </div>
                <div class="p-2">
                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="user" class="w-4 h-4 mr-2"></i> {{ __('site.profile') }}
                    </a>
                </div>
                <div class="p-2">
                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="lock" class="w-4 h-4 mr-2"></i> {{ __('site.change_password') }}
                    </a>
                </div>
                <div class="p-2 border-t border-theme-27 dark:border-dark-3">
                    <a href="{{ url('bigg/logout') }}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> {{ __('site.logout') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->