@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <form class="validate-form-teacher" action="{{ route('teachers-edit', $teacher->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- BEGIN: Үндсэн мэдээлэл -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">Үндсэн мэдээлэл</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-4">
                            <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                                <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img id="preview-image" class="rounded-md" alt="BiGG systems 1.0" src="{{ ($teacher->image == null) ? asset('dist/images/Blank-avatar.png') : asset('uploads/teachers/thumbs/'.$teacher->image)}}">
                                    <div id="remove-image" title="Зургийг устгах уу?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full cursor-pointer text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2 hidden">
                                        <i data-feather="x" class="w-4 h-4"></i>
                                    </div>
                                </div>
                                <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                    <button type="button" class="button w-full bg-theme-1 text-white cursor-pointer">Зураг солих</button>
                                    <input type="file" name="image" id="image" accept="image/png, image/jpeg" class="w-full h-full top-0 left-0 absolute opacity-0">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-8">
                            <div class="input-form">
                                <label class="flex flex-col sm:flex-row">
                                    Багшийн нэр: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Криллээр бичнэ</span>
                                </label>
                                <input type="text" name="ner" value="{{ $teacher->ner }}" class="input w-full border mt-2" minlength="2" required data-pristine-minlength-message="2 тэмдэгдээс дээш байх ёстой" data-pristine-required-message="Багшийн нэр хоосон байж болохгүй"/>
                            </div>
                            <div class="input-form mt-3">
                                <label class="flex flex-col sm:flex-row">
                                Эцгийн нэр: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Криллээр бичнэ</span>
                                </label>
                                <input type="text" name="ovog" value="{{ $teacher->ovog }}" class="input w-full border mt-2" minlength="2" required data-pristine-minlength-message="2 тэмдэгдээс дээш байх ёстой" data-pristine-required-message="Багшийн нэр хоосон байж болохгүй"/>
                            </div>
                            <div class="input-form mt-3">
                                <label class="flex flex-col sm:flex-row">
                                Ургийн овог: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Криллээр бичнэ</span>
                                </label>
                                <input type="text" name="urag" value="{{ $teacher->urag }}" class="input w-full border mt-2" minlength="2" required data-pristine-minlength-message="2 тэмдэгдээс дээш байх ёстой" data-pristine-minlength-message="2 тэмдэгдээс дээш байх ёстой" data-pristine-required-message="Багшийн нэр хоосон байж болохгүй"/>
                            </div>
                            <div class="input-form mt-3">
                                <label class="flex flex-col sm:flex-row">
                                Багшийн код: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Тоо оруулна</span>
                                </label>
                                <input type="integer" name="code" value="{{ $teacher->code }}" class="input w-full border mt-2" minlength="8" maxlength="8" required data-pristine-integer-message="Тэмдэгт оруулна уу" data-pristine-minlength-message="8 тэмдэгт байх ёстой" data-pristine-maxlength-message="8 тэмдэгт байх ёстой" data-pristine-required-message="Багшийн код хоосон байж болохгүй"/>
                            </div>
                            <div class="input-form mt-3">
                                <label class="flex flex-col sm:flex-row">
                                Тэнхим:
                                </label>
                                <div class="mt-2">
                                    <select data-search="true" class="tail-select w-full">
                                        <option value="1">Тэнхим 1</option>
                                        <option value="2">Тэнхим 2</option>
                                        <option value="3">Тэнхим 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-form mt-3">
                                <label class="flex flex-col sm:flex-row">
                                    Мэргэжил:
                                </label>
                                <div class="mt-2">
                                    <select data-search="true" class="tail-select w-full">
                                        <option value="1">Компьютерийн багш</option>
                                        <option value="2">Тогоочийн багш</option>
                                        <option value="3">Барилгын багш</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Үндсэн мэдээлэл -->
            <!-- BEGIN: Хувийн мэдээлэл -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">Хувийн мэдээлэл</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-6">
                            <div class="input-form">
                                <label class="flex flex-col sm:flex-row">
                                Регистрийн дугаар: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Жишээ: ЧЛ85032971</span>
                                </label>
                                <input type="text" name="register" value="{{ $teacher->register }}" class="input w-full border mt-2" placeholder="ҮҮ000000" required data-pristine-required-message="Регистрийн дугаар хоосон байж болохгүй"/>
                            </div>
                            <div class="input-form mt-3">
                                <label class="flex flex-col sm:flex-row">
                                Хүйс:
                                </label>
                                <select name="huis" id="huis" class="input w-full border mt-2">
                                    <option value="er">Эрэгтэй</option>
                                    <option value="em">Эмэгтэй</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-6">
                            <div class="input-form">
                                <label class="flex flex-col sm:flex-row">
                                Төрсөн огноо: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Жишээ: 2000-12-31</span>
                                </label>
                                <input type="text" name="tursun" value="{{ $teacher->tursun }}" class="input w-full border mt-2" placeholder="YYYY-MM-DD" required  data-pristine-required-message="Төрсөн огноо хоосон байж болохгүй"/>
                            </div>
                            
                        </div>
                        <div class="col-span-12">
                            <div class="input-form">
                                <label class="flex flex-col sm:flex-row">
                                Гэрийн хаяг: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Криллээр бичнэ</span>
                                </label>
                                <textarea name="address" id="address" class="input w-full border mt-2">{{ $teacher->address }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Хувийн мэдээлэл -->
            <!-- BEGIN: Нэмэлт мэдээлэл -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">Нэмэлт мэдээлэл</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-6">
                            <div class="input-form mt-3">
                                <label class="flex flex-col sm:flex-row">
                                Имэйл хаяг: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Жишээ: bayaraa@gmail.com</span>
                                </label>
                                <input type="email" name="email" value="{{ $teacher->email }}" class="input w-full border bg-gray-100 mt-2" minlength="6" required data-pristine-email-message="Имэйл хаяг бичнэ үү" data-pristine-minlength-message="6 тэмдэгдээс дээш байх ёстой" data-pristine-required-message="Имэйл хоосон байж болохгүй"/>
                            </div>
                            
                            <div class="input-form mt-3">
                                <label class="flex flex-col sm:flex-row">
                                Нууц үг: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Нууц үгийг солиж болно</span>
                                </label>
                                <input type="text" name="password" value="{{ $teacher->password }}" class="input w-full border mt-2" minlength="4" value="{{ rand(1000,9999) }}" required data-pristine-minlength-message="4 тэмдэгдээс дээш байх ёстой" data-pristine-required-message="Нууц үг хоосон байж болохгүй"/>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-6">
                            <div class="input-form mt-3">
                                <label class="flex flex-col sm:flex-row">
                                Утасны дугаар: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Жишээ: 99117788</span>
                                </label>
                                <input type="text" name="phone" value="{{ $teacher->phone }}" class="input w-full border mt-2" minlength="8" required data-pristine-minlength-message="8 тэмдэгдээс дээш байх ёстой" data-pristine-required-message="Утасны дугаар хоосон байж болохгүй"/>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="window.location.href='{{ route('teachers') }}'" class="button w-40 bg-theme-6 text-white ml-5">{{ __('site.cancel') }}</button> 
                        <button type="submit" name="action" value="save_and_new" class="button w-40 bg-theme-1 text-white ml-5">{{ __('site.save_and_new') }}</button> 
                        <button type="submit" name="action" value="save" class="button w-40 bg-theme-1 text-white ml-5">{{ __('site.save') }}</button>
                    </div>
                </div>
            </div>
            <!-- END: Нэмэлт мэдээлэл -->
            </form>
        </div>
        <!-- BEGIN: Profile Menu -->
        <!-- END: Profile Menu -->

    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection