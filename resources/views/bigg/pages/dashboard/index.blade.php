@extends('../bigg.layout.side-menu')

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
            <!-- BEGIN: Хянах самбар -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Хянах самбар</h2>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="users" class="report-box__icon text-theme-10"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $students_count }}</div>
                                <div class="text-base text-gray-600 mt-1">Оюутнууд</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user" class="report-box__icon text-theme-11"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $teachers_count }}</div>
                                <div class="text-base text-gray-600 mt-1">Багш нар</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="briefcase" class="report-box__icon text-theme-12"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $angi_count }}</div>
                                <div class="text-base text-gray-600 mt-1">Ангиуд</div>
                            </div>
                        </div>
                    </div>
                    

                    
                </div>
            </div>
            <!-- END: Хянах самбар -->
            
        </div>
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection