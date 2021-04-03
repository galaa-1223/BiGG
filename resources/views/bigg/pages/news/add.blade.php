@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Зар, мэдээ мэдээлэл нэмэх</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button type="button" class="btn box bg-theme-1 text-white mr-2 flex items-center ml-auto sm:ml-0">
                <i class="w-4 h-4 mr-2" data-feather="save"></i> Хадгалах
            </button>
        </div>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Post Content -->
        <div class="intro-y col-span-12 lg:col-span-8">
            <input type="text" class="intro-y form-control py-3 px-4 box pr-10 placeholder-theme-13" placeholder="Гарчиг">
            <div class="post intro-y overflow-hidden box mt-5">
                <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                    <div class="font-medium flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                        <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Агуулга
                    </div>
                    <div class="mt-5">
                        <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
                    </div>
                </div>
                <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5 mt-5">
                    <div class="font-medium flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                        <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Caption & Images
                    </div>
                    <div class="mt-5">
                        <div>
                            <label for="post-form-7" class="form-label">Caption</label>
                            <input id="post-form-7" type="text" class="form-control" placeholder="Write caption">
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Upload Image</label>
                            <div class="border-2 border-dashed dark:border-dark-5 rounded-md pt-4">
                                <div class="flex flex-wrap px-4">
                                   
                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                            <img class="rounded-md" alt="Midone Tailwind HTML Admin Template" src="">
                                            <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">
                                                <i data-feather="x" class="w-4 h-4"></i>
                                            </div>
                                        </div>
                                </div>
                                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                    <i data-feather="image" class="w-4 h-4 mr-2"></i> <span class="text-theme-1 dark:text-theme-10 mr-1">Upload a file</span> or drag and drop
                                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Post Content -->
        <!-- BEGIN: Post Info -->
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y box p-5">
                <div>
                    <label for="post-form-2" class="form-label">Post Date</label>
                    <input class="datepicker form-control" id="post-form-2" data-single-mode="true">
                </div>
                <div class="mt-3">
                    <label for="post-form-4" class="form-label">Tags</label>
                    <select data-placeholder="Select your favorite actors" class="tail-select w-full" id="post-form-4" multiple>
                        <option value="1" selected>Leonardo DiCaprio</option>
                        <option value="2">Johnny Deep</option>
                        <option value="3" selected>Robert Downey, Jr</option>
                        <option value="4">Samuel L. Jackson</option>
                        <option value="5">Morgan Freeman</option>
                    </select>
                </div>
                <div class="form-check flex-col items-start mt-3">
                    <label for="post-form-5" class="form-check-label ml-0 mb-2">Published</label>
                    <input id="post-form-5" class="form-check-switch" type="checkbox">
                </div>
                <div class="form-check flex-col items-start mt-3">
                    <label for="post-form-6" class="form-check-label ml-0 mb-2">Show Author Name</label>
                    <input id="post-form-6" class="form-check-switch" type="checkbox">
                </div>
            </div>
        </div>
        <!-- END: Post Info -->
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection