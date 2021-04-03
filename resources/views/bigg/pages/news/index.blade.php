@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{ $page_title }} талбар</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button type="button" class="btn box bg-theme-1 text-white mr-2 flex items-center ml-auto sm:ml-0">
                <i class="w-4 h-4 mr-2" data-feather="eye"></i> Preview
            </button>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12">
        @if(!count($newss))
                <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-17 text-theme-11">
                    <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> Мэдээлэл алга байна!
                </div>
            @else
            <table id="table" class="table table-report mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">Гарчиг</th>
                        <th class="whitespace-nowrap text-center">Хэнд</th>
                        <th class="text-center whitespace-nowrap">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $i = 1;?>
                        @foreach($newss as $news)
                        <tr class="intro-x">
                            <td class="w-10">
                                <div class="flex">
                                <?=(($newss->currentpage()-1) * $newss->perpage() + $i);?>
                                </div>
                            </td>
                            <td>
                                <a href="#" class="font-medium whitespace-nowrap">{{ $news->title }}</a>
                            </td>
                            <td class="text-center">
                                <a href="#" class="font-medium whitespace-nowrap">{{ $news->to }}</a>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ url('bigg/news/edit/'.$news->id) }}">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i> {{ __('site.edit') }}
                                    </a>
                                    <a class="flex items-center text-theme-6 delete_button" href="javascript:;" data-id="{{ $news->id }}" data-target="#delete-confirmation-modal">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> {{ __('site.delete') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++;?>
                        @endforeach
                </tbody>
            </table>
            @endif
            {{ $newss->links() }}
        </div>
    </div> 
    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <div class="modal-body p-0"> 
                    <form action="{{ route('bigg-news-delete-ajax') }}" method="post">
                    @csrf
                        <input type="hidden" class="t_id" name="t_id" value="">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">Сонгосон тэнхимийг устгахыг хүсэж байна уу?</div>
                            <div class="text-gray-600 mt-2">Баазаас нэг мөсөн устгагдахыг анхаарна уу!</div>
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="btn w-24 dark:border-dark-5 dark:text-gray-300 mr-1">{{ __('site.cancel') }}</button>
                            <button type="submit" class="modal_delete_button btn w-24 bg-theme-6 text-white">{{ __('site.delete') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
@endsection

@section('style')
@endsection

@section('script')
@endsection