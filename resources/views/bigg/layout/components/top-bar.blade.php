<!-- BEGIN: Top Bar -->
<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <a href="" class="">{{ __('site.home') }}</a>
        <i data-feather="chevron-right" class="breadcrumb__icon"></i>
        <a href="/bigg/{{ $page_name }}" class="breadcrumb--active">{{ $page_title }}</a>
    </div>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
            <img alt="BiGG system" src="{{ ($user->image == null) ? asset('dist/images/Blank-avatar.png') : asset('uploads/users/thumbs/'.$user->image)}}">
        </div>
        <div class="dropdown-box w-56">
            <div class="dropdown-box__content box bg-theme-38 dark:bg-dark-6 text-white">
                <div class="p-4 border-b border-theme-40 dark:border-dark-3">
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
                <div class="p-2 border-t border-theme-40 dark:border-dark-3">
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