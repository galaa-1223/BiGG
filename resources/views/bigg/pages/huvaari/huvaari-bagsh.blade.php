@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Багшийн хичээлийн хуваарь</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            
        </div>
    </div>
     <!-- BEGIN: Huvaari bagsh -->
     <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">{{ Str::substr($teacher->ovog, 0, 1) }}. {{ $teacher->ner }}</h2>
            <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5">{{ $teacher->mergejil }}</div>
        </div>
        <div class="p-5" id="hoverable-table">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table border-yellow-500 huvaari-table" style="border:1px solid red !important">
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
                                <td class="border hover:bg-indigo-800 cursor-pointer border-b-2 text-center dark:border-dark-5 modal_form table-1-{{$i}}" data-number="1" data-udur="{{$i}}" data-col="Даваа" data-row="{{$i}}-р цаг">
                                <div id="a{{$i}}" class="rounded-md flex px-2 py-2 my-2 bg-theme-12 text-theme-1 text-center huvaari-event">fdsfsda</div>
                                </td>
                                <td class="border hover:bg-indigo-800 cursor-pointer border-b-2 text-center dark:border-dark-5 modal_form table-2-{{$i}}" data-number="2" data-udur="{{$i}}" data-col="Мягмар" data-row="{{$i}}-р цаг"></td>
                                <td class="border hover:bg-indigo-800 cursor-pointer border-b-2 text-center dark:border-dark-5 modal_form table-3-{{$i}}" data-number="3" data-udur="{{$i}}" data-col="Лхагва" data-row="{{$i}}-р цаг"></td>
                                <td class="border hover:bg-indigo-800 cursor-pointer border-b-2 text-center dark:border-dark-5 modal_form table-4-{{$i}}" data-number="4" data-udur="{{$i}}" data-col="Пүрэв" data-row="{{$i}}-р цаг"></td>
                                <td class="border hover:bg-indigo-800 cursor-pointer border-b-2 text-center dark:border-dark-5 modal_form table-5-{{$i}}" data-number="5" data-udur="{{$i}}" data-col="Баасан" data-row="{{$i}}-р цаг"></td>
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
    <!-- END: Huvaari bagsh -->
    <!-- BEGIN: Modal Datepicker -->
    <div class="p-5" id="modal-datepicker">
        <div class="preview">
            <div class="text-center"> 
                <a href="{{ route('bigg-huvaari') }}" class="button inline-block text-gray-700 border dark:border-dark-5 dark:text-gray-300 mr-3">Болих</a> 
                <a href="javascript:;" class="button inline-block bg-theme-1 text-white">Хадгалах</a> 
            </div>
            <div class="modal" id="huvaari-modal-preview">
                <div class="modal__content">
                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Хуваарь оруулах
                        </h2>
                    </div>
                    <div class="p-5 grid grid-cols-12 gap-4">
                        <div class="col-span-12 sm:col-span-6">
                            <label>Өдөр:</label>
                            <input class="huvaari-udur input w-full border mt-2" value="" disabled />
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label>Цаг:</label>
                            <input class="huvaari-tsag input w-full border mt-2" value="" disabled />
                        </div>
                    </div>
                    <div class="px-5 grid grid-cols-12 gap-4">
                        <div class="col-span-12 sm:col-span-6">
                            <label>Хичээл:</label>
                            <div class="mt-2">
                                <select class="tail-select w-full" id="huvaari-hicheel">
                                    <option value="1">Бүтэн цагаар</option>
                                    <option value="2">Дээгүүр/Доогуур 7 хоног</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                        </div>
                    </div>          
                    <div class="px-5 pt-5 grid grid-cols-12 gap-4 mt-5">
                        <div class="col-span-12">
                            <label class="huvaari-garchig1">Орох хичээл:</label>
                            <div class="mt-2">
                                <select data-search="true" class="tail-select w-full huvaari-deeguur">
                                    <option value="0">Хичээлгүй</option>
                                    <option value="2">Тэнхим 2</option>
                                    <option value="3">Тэнхим 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 grid grid-cols-12 gap-4">
                        <div class="col-span-12 huvaari-dooguur-container">
                            <label class="huvaari-garchig2">Доогуур 7 хоног:</label>
                            <div class="mt-2">
                                <select data-search="true" class="tail-select w-full huvaari-dooguur">
                                    <option value="0">Хичээлгүй</option>
                                    <option value="2">Тэнхим 2</option>
                                    <option value="3">Тэнхим 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                        <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Болих</button>
                        <button type="button" class="button w-20 bg-theme-1 text-white" id="huvaari-insert">Оруулах</button>
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