@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Үйл явдал</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="btn bg-theme-1 text-white shadow-md mr-2">Үйл явдал нэмэх</button>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Events -->
        <div class="col-span-12">
            <div class="box p-5">
                <div class="full-calendar" id="calendar"></div>
            </div>
        </div>    
    </div>
    <!-- BEGIN: Slide Over Content -->
    <div id="calendar-over-preview" class="modal modal-slide-over" data-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <a data-dismiss="modal" href="javascript:;">
                    <i data-feather="x" class="w-8 h-8 text-gray-500"></i>
                </a>
                <!-- BEGIN: Slide Over Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Broadcast Message</h2>
                    <button class="btn btn-outline-secondary hidden sm:flex">
                        <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs
                    </button>
                    <div class="dropdown sm:hidden">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false">
                            <i data-feather="more-horizontal" class="w-5 h-5 text-gray-600 dark:text-gray-600"></i>
                        </a>
                        <div class="dropdown-menu w-40">
                            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                <a href="javascript:;" class="flex items-center p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                    <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Slide Over Header -->
                <!-- BEGIN: Slide Over Body -->
                <div class="modal-body">
                    <div>
                        <label for="modal-form-1" class="form-label">From</label>
                        <input id="modal-form-1" type="text" class="form-control" placeholder="example@gmail.com">
                    </div>
                    <div class="mt-3">
                        <label for="modal-form-2" class="form-label">To</label>
                        <input id="modal-form-2" type="text" class="form-control" placeholder="example@gmail.com">
                    </div>
                    <div class="mt-3">
                        <label for="modal-form-3" class="form-label">Subject</label>
                        <input id="modal-form-3" type="text" class="form-control" placeholder="Important Meeting">
                    </div>
                    <div class="mt-3">
                        <label for="modal-form-4" class="form-label">Has the Words</label>
                        <input id="modal-form-4" type="text" class="form-control" placeholder="Job, Work, Documentation">
                    </div>
                    <div class="mt-3">
                        <label for="modal-form-5" class="form-label">Doesn't Have</label>
                        <input id="modal-form-5" type="text" class="form-control" placeholder="Job, Work, Documentation">
                    </div>
                    <div class="mt-3">
                        <label for="modal-form-6" class="form-label">Size</label>
                        <select id="modal-form-6" class="form-select">
                            <option>10</option>
                            <option>25</option>
                            <option>35</option>
                            <option>50</option>
                        </select>
                    </div>
                </div>
                <!-- END: Slide Over Body -->
                <!-- BEGIN: Slide Over Footer -->
                <div class="modal-footer text-right w-full absolute bottom-0">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                    <button type="button" class="btn btn-primary w-20">Send</button>
                </div>
                <!-- END: Slide Over Footer -->
            </div>
        </div>
    </div>
    <!-- END: Slide Over Content -->
@endsection

@section('style')
@endsection

@section('script')
@endsection