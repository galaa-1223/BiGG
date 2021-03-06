@extends('../bigg/layout/' . $layout)

@section('head')
    <title>Нэвтрэх :: BiGG systems</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="BiGG systems" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
                    <span class="text-white text-lg ml-3">
                        <span class="font-medium">BiGG</span> systems
                    </span>
                </a>
                <div class="my-auto">
                    <img alt="BiGG systems" class="-intro-x w-1/2 -mt-16" src="{{ asset('dist/images/vector.svg') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">{ Админ талбар }</div>
                    <div class="-intro-x mt-5 text-lg text-white dark:text-gray-500">Томоохон амжилт нь урьдчилан төлөвлөж бодсон олон жижиг зүйлээс бүрддэг.</div>
                </div>
            </div>
            <!-- END: Login Info --> 
            <!-- BEGIN: Login Form -->
            
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">{{ __('site.sys_sign_in') }}</h2>
                    <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">Томоохон амжилт нь урьдчилан төлөвлөж бодсон олон жижиг зүйлээс бүрддэг.</div>
                    <div class="intro-x mt-8">
                        <form id="login-form">
                            <input type="text" name="email" id="input-email" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="{{ __('site.email') }}" />
                            <div id="error-email" class="login__input-error w-5/6 text-theme-6 mt-2"></div>
                            <input type="password" name="password" id="input-password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="{{ __('site.password') }}" />
                            <div id="error-password" class="login__input-error w-5/6 text-theme-6 mt-2"></div>
                        </form>
                    </div>
                    <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                        <div class="flex items-center mr-auto">
                            <input type="checkbox" class="input border mr-2" id="input-remember-me">
                            <label class="cursor-pointer select-none" for="input-remember-me">{{ __('site.remember_me') }}</label>
                        </div>
                        <a href="">{{ __('site.forget_password') }}?</a>
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button id="btn-login" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top">{{ __('site.login') }}</button>
                    </div>
                </div>
            </div>
            
            <!-- END: Login Form -->
        </div>
    </div>    
@endsection

@section('script')
    <script>
        cash(function () {
            async function login() {
                // Reset state
                cash('#login-form').find('.input').removeClass('border-theme-6')
                cash('#login-form').find('.login__input-error').html('')

                // Post form
                let email = cash('#input-email').val()
                let password = cash('#input-password').val()
                let rememberMe = cash('#input-remember-me').val()
                
                // Loading state
                cash('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
                await helper.delay(1500)

                axios.post(`login`, {
                    email: email,
                    password: password,
                    remember_me: rememberMe
                }).then(res => {
                    location.href = 'dashboard'
                }).catch(err => {
                    // console.log(err)
                    cash('#btn-login').html('{{ __('site.login') }}')
                    if (err.response.data.message != 'Wrong email or password.') {
                        //  console.log(err.response.data.errors);
                        if(err.response.data.errors.email[0] == 'The email field is required.'){
                            cash(`#input-email`).addClass('border-theme-6')
                            cash(`#error-email`).html('{{ __('site.required_email') }}')
                        }

                        if(err.response.data.errors.email[0] == 'The email must be a valid email address.'){
                            cash(`#input-email`).addClass('border-theme-6')
                            cash(`#error-email`).html('{{ __('site.required_email_valid') }}')
                        }

                        if(err.response.data.errors.email[0] == 'The selected email is invalid.'){
                            cash(`#input-email`).addClass('border-theme-6')
                            cash(`#error-email`).html('{{ __('site.required_email_selected') }}')
                        }

                        if(err.response.data.errors.password[0] == 'The password field is required.'){
                            cash(`#input-password`).addClass('border-theme-6')
                            cash(`#error-password`).html('{{ __('site.required_password') }}')
                        }


                        // for (const [key, val] of Object.entries(err.response.data.errors.email)) {
                        //     if(err.response.data.errors.email[0] == 'The email field is required.'){
                        //         cash(`#input-${key}`).addClass('border-theme-6')
                        //         cash(`#error-${key}`).html('Hello')
                        //     }else{
                        //         cash(`#input-${key}`).addClass('border-theme-6')
                        //         cash(`#error-${key}`).html(val)
                        //     }
                    
                        // }
                    } else {
                        cash(`#input-password`).addClass('border-theme-6')
                        cash(`#error-password`).html('{{ __('site.wrong_email_password') }}')
                    }
                })
            }

            cash('#login-form').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    login()
                }
            })
            
            cash('#btn-login').on('click', function() {
                login()
            })
        })
    </script>
@endsection