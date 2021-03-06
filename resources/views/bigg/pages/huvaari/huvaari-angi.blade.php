@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Хичээлийн хуваарь</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            
        </div>
    </div>
     <!-- BEGIN: Hoverable Table -->
     <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Hoverable Table</h2>
        </div>
        <div class="p-5" id="hoverable-table">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table border-yellow-500" style="border:1px solid red !important">
                        <thead>
                            <tr>
                                <th class="border border-b-2 bg-indigo-900 dark:border-dark-5 whitespace-nowrap text-center">Цаг / Өдөр</th>
                                <th class="border border-b-2 bg-indigo-900 dark:border-dark-5 whitespace-nowrap text-center">Даваа</th>
                                <th class="border border-b-2 bg-indigo-900 dark:border-dark-5 whitespace-nowrap text-center">Мягмар</th>
                                <th class="border border-b-2 bg-indigo-900 dark:border-dark-5 whitespace-nowrap text-center">Лхагва</th>
                                <th class="border border-b-2 bg-indigo-900 dark:border-dark-5 whitespace-nowrap text-center">Пүрэв</th>
                                <th class="border border-b-2 bg-indigo-900 dark:border-dark-5 whitespace-nowrap text-center">Баасан</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $date = explode(":", config('settings.huvaari_ehleh'));

                                $tsag = $date[0];
                                $minu = $date[1];

                                $hicheelleh = config('settings.huvaari_urgeljleh');
                                $zavsar = config('settings.huvaari_zavsarlaga');
                                $ihzasvar = config('settings.huvaari_ih_zavsarlaga');
                                $hicheelleh_tsag = config('settings.huvaari_hicheelleh');

                                for($i = 1; $i <= $hicheelleh_tsag; $i++){

                                    if($i > 3){
                                        $ih_zasvar = $ihzasvar - $zavsar;
                                    }else{
                                        $ih_zasvar = 0;
                                    }

                                    $start = date("H:i", mktime($tsag, $minu + ($zavsar * ($i - 1)) + ($hicheelleh * ($i - 1)) + $ih_zasvar, 0, 0, 0, 2000));
                                    $end = date("H:i", mktime($tsag, $minu + ($zavsar * ($i - 1)) + ($hicheelleh * $i) + $ih_zasvar, 0, 0, 0, 2000));
                                ?>
                            <tr>
                                <td class="border border-b-2 hover:bg-indigo-800 bg-indigo-900 text-center dark:border-dark-5">
                                    <?=$i;?> - р цаг
                                    <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5"><?=$start.' - '.$end;?></div>
                                </td>
                                <td class="border hover:bg-indigo-800 cursor-pointer border-b-2 text-center dark:border-dark-5 modal_form" data-col="1" data-row="{{$i}}"></td>
                                <td class="border hover:bg-indigo-800 cursor-pointer border-b-2 text-center dark:border-dark-5 modal_form" data-col="2" data-row="{{$i}}"></td>
                                <td class="border hover:bg-indigo-800 cursor-pointer border-b-2 text-center dark:border-dark-5 modal_form" data-col="3" data-row="{{$i}}"></td>
                                <td class="border hover:bg-indigo-800 cursor-pointer border-b-2 text-center dark:border-dark-5 modal_form" data-col="4" data-row="{{$i}}"></td>
                                <td class="border hover:bg-indigo-800 cursor-pointer border-b-2 text-center dark:border-dark-5 modal_form" data-col="5" data-row="{{$i}}"></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
    <!-- END: Hoverable Table -->
    <!-- BEGIN: Modal Datepicker -->
    <div class="p-5" id="modal-datepicker">
        <div class="preview">
            <div class="text-center"> 
                <a href="javascript:;" class="button inline-block text-gray-700 border dark:border-dark-5 dark:text-gray-300 mr-3">Болих</a> 
                <a href="javascript:;" class="button inline-block bg-theme-1 text-white">Хадгалах</a> 
            </div>
            <div class="modal" id="huvaari-modal-preview">
                <div class="modal__content">
                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Filter by Date
                        </h2>
                        <button class="button border items-center text-gray-700 dark:border-dark-5 dark:text-gray-300 hidden sm:flex"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs </button>
                        <div class="dropdown sm:hidden">
                            <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-horizontal" class="w-5 h-5 text-gray-600 dark:text-gray-600"></i> </a>
                            <div class="dropdown-box w-40">
                                <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                                    <a href="javascript:;" class="flex items-center p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-12 sm:col-span-6">
                            <label>From</label>
                            <input class="datepicker input w-full border mt-2" data-single-mode="true">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label>To</label>
                            <input class="datepicker input w-full border mt-2" data-single-mode="true">
                        </div>
                    </div>
                    <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                        <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                        <button type="button" class="button w-20 bg-theme-1 text-white">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal Datepicker -->

@endsection

@section('style')
@endsection

@section('script')
@endsection