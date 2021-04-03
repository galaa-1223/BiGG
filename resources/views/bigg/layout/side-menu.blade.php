@extends('../bigg/layout/main')

@section('head')
    <title>{{ $page_title.' :: '.config('app.bigg_title') }}</title>
@endsection

@section('content')
    @include('../bigg/layout/components/mobile-menu')
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a href="" class="intro-x flex items-center pl-5 pt-4">
                <img alt="BiGG system" class="w-8" src="{{ asset('dist/images/logo.svg') }}">
                <span class="hidden xl:block text-white text-lg ml-1">
                    <span class="font-medium">BiGG</span> system
                </span>
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                @foreach (config('app.bigg_side_menu') as $menu)
                    @if ($menu == 'devider')
                        <li class="side-nav__devider my-6"></li>
                    @else
                        <li>
                            <a href="{{ isset($menu['link']) ? $menu['link'] : 'javascript:;' }}" class="{{ $first_page_name == $menu['page_name'] ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="{{ $menu['icon'] }}"></i>
                                </div>
                                <div class="side-menu__title">
                                    {{ $menu['title'] }}
                                    @if (isset($menu['sub_menu']))
                                        <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                                    @endif
                                </div>
                            </a>
                            @if (isset($menu['sub_menu']))
                                <ul class="{{ $first_page_name == $menu['page_name'] ? 'side-menu__sub-open' : '' }}">
                                    @foreach ($menu['sub_menu'] as $subMenu)
                                        <li>
                                            <a href="{{ isset($subMenu['link']) ? $subMenu['link'] : 'javascript:;' }}" class="side-menu">
                                                <div class="side-menu__icon">
                                                    <i data-feather="{{ $subMenu['icon'] }}"></i>
                                                </div>
                                                <div class="side-menu__title">
                                                    {{ $subMenu['title'] }}
                                                    @if (isset($subMenu['sub_menu']))
                                                        <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                                                    @endif
                                                </div>
                                            </a>
                                            @if (isset($subMenu['sub_menu']))
                                                <ul class="side-menu__sub-open">
                                                    @foreach ($subMenu['sub_menu'] as $lastSubMenu)
                                                        <li>
                                                            <a href="#" class="side-menu">
                                                                <div class="side-menu__icon">
                                                                    <i data-feather="zap"></i>
                                                                </div>
                                                                <div class="side-menu__title">{{ $lastSubMenu['title'] }}</div>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            @include('../bigg/layout/components/top-bar')
            @yield('subcontent')
        </div>
        <!-- END: Content -->
    </div>
@endsection