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
                    <table class="table border-yellow-500 huvaari-table">
                        <thead>
                            <tr>
                                <th class="border border-b-2 bg-theme-1 dark:border-dark-5 whitespace-nowrap text-white text-center w-20">Цаг / Өдөр</th>
                                <th class="border border-b-2 bg-theme-1 dark:border-dark-5 whitespace-nowrap text-white text-center w-1/6">Даваа</th>
                                <th class="border border-b-2 bg-theme-1 dark:border-dark-5 whitespace-nowrap text-white text-center w-1/6">Мягмар</th>
                                <th class="border border-b-2 bg-theme-1 dark:border-dark-5 whitespace-nowrap text-white text-center w-1/6">Лхагва</th>
                                <th class="border border-b-2 bg-theme-1 dark:border-dark-5 whitespace-nowrap text-white text-center w-1/6">Пүрэв</th>
                                <th class="border border-b-2 bg-theme-1 dark:border-dark-5 whitespace-nowrap text-white text-center w-1/6">Баасан</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // dd($huvaariud);
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
                                <td class="border border-b-1 bg-theme-2 text-center">
                                    <?=$i;?> - р цаг
                                    <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5"><?=$start.' - '.$end;?></div>
                                </td>
                                <td class="border hover:bg-theme-31 cursor-pointer border-b-2 text-center modal_form table-1-{{$i}}" data-udur="1" data-number="{{$i}}" data-col="Даваа" data-row="{{$i}}-р цаг">
                                    <?php
                                    foreach($huvaariud as $huvaari):
                                        if($huvaari->udur == 1 && $huvaari->tsag == $i):
                                    ?>
                                    <div class="box-border p-1 bg-theme-12 zoom-in huvaari_view">
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'buten'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        <?php }?>

                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'duuren'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        <?php }elseif($huvaari->huvaari == 'dooguur' && $huvaari->type == 'duuren'){?>
                                            <div class="box-border p-1 bg-theme-9 zoom-in">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        </div>
                                        <? } ?>
                                        
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                            <div class="box-border p-1 bg-theme-9 zoom-in">
                                                <div class="font-medium text-base">Хичээлгүй</div>
                                            </div>
                                        <? } ?>

                                        <?php if($huvaari->huvaari == 'dooguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base">Хичээлгүй</div>
                                            <div class="box-border p-1 bg-theme-9 zoom-in">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        </div>
                                        <? } ?>
                                        <div class="hidden hicheel_closed w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">x</div>
                                    </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </td>
                                <td class="border hover:bg-theme-31 cursor-pointer border-b-2 text-center modal_form table-2-{{$i}}" data-udur="2" data-number="{{$i}}" data-col="Мягмар" data-row="{{$i}}-р цаг">
                                    <?php
                                    foreach($huvaariud as $huvaari):
                                        if($huvaari->udur == 2 && $huvaari->tsag == $i):
                                    ?>
                                    <div class="box-border p-1 bg-theme-12 zoom-in huvaari_view">
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'buten'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        <?php }?>

                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'duuren'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        <?php }elseif($huvaari->huvaari == 'dooguur' && $huvaari->type == 'duuren'){?>
                                            <div class="box-border p-1 bg-theme-9 zoom-in">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        </div>
                                        <? } ?>
                                        
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                            <div class="box-border p-1 bg-theme-9 zoom-in">
                                                <div class="font-medium text-base">Хичээлгүй</div>
                                            </div>
                                        <? } ?>

                                        <?php if($huvaari->huvaari == 'dooguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base">Хичээлгүй</div>
                                            <div class="box-border p-1 bg-theme-9 zoom-in">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        </div>
                                        <? } ?>
                                        <div class="hidden hicheel_closed w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">x</div>
                                    </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </td>
                                <td class="border hover:bg-theme-31 cursor-pointer border-b-2 text-center modal_form table-3-{{$i}}" data-udur="3" data-number="{{$i}}" data-col="Лхагва" data-row="{{$i}}-р цаг">
                                    <?php
                                    foreach($huvaariud as $huvaari):
                                        if($huvaari->udur == 3 && $huvaari->tsag == $i):
                                    ?>
                                    <div class="box-border p-1 bg-theme-12 zoom-in huvaari_view">
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'buten'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        <?php }?>

                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'duuren'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        <?php }elseif($huvaari->huvaari == 'dooguur' && $huvaari->type == 'duuren'){?>
                                            <div class="box-border p-1 bg-theme-9 zoom-in">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        </div>
                                        <? } ?>
                                        
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                            <div class="box-border p-1 bg-theme-9 zoom-in">
                                                <div class="font-medium text-base">Хичээлгүй</div>
                                            </div>
                                        <? } ?>

                                        <?php if($huvaari->huvaari == 'dooguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base">Хичээлгүй</div>
                                            <div class="box-border p-1 bg-theme-9 zoom-in">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        </div>
                                        <? } ?>
                                        <div class="hidden hicheel_closed w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">x</div>
                                    </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </td>
                                <td class="border hover:bg-theme-31 cursor-pointer border-b-2 text-center modal_form table-4-{{$i}}" data-udur="4" data-number="{{$i}}" data-col="Пүрэв" data-row="{{$i}}-р цаг">
                                    <?php
                                    foreach($huvaariud as $huvaari):
                                        if($huvaari->udur == 4 && $huvaari->tsag == $i):
                                    ?>
                                    <div class="box-border p-1 bg-theme-12 zoom-in huvaari_view">
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'buten'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        <?php }?>

                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'duuren'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        <?php }elseif($huvaari->huvaari == 'dooguur' && $huvaari->type == 'duuren'){?>
                                            <div class="box-border p-1 bg-theme-9 zoom-in">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        </div>
                                        <? } ?>
                                        
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                            <div class="box-border p-1 bg-theme-9 zoom-in">
                                                <div class="font-medium text-base">Хичээлгүй</div>
                                            </div>
                                        <? } ?>

                                        <?php if($huvaari->huvaari == 'dooguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base">Хичээлгүй</div>
                                            <div class="box-border p-1 bg-theme-9 zoom-in">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        </div>
                                        <? } ?>
                                        <div class="hidden hicheel_closed w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">x</div>
                                    </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </td>
                                <td class="border hover:bg-theme-31 cursor-pointer border-b-2 text-center modal_form table-5-{{$i}}" data-udur="5" data-number="{{$i}}" data-col="Баасан" data-row="{{$i}}-р цаг">
                                    <?php
                                    foreach($huvaariud as $huvaari):
                                        if($huvaari->udur == 5 && $huvaari->tsag == $i):
                                    ?>
                                    <div class="box-border p-1 bg-theme-12 zoom-in huvaari_view">
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'buten'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        <?php }?>

                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'duuren'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        <?php }elseif($huvaari->huvaari == 'dooguur' && $huvaari->type == 'duuren'){?>
                                            <div class="box-border p-1 bg-theme-9 zoom-in">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        </div>
                                        <? } ?>
                                        
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                            <div class="box-border p-1 bg-theme-9 zoom-in">
                                                <div class="font-medium text-base">Хичээлгүй</div>
                                            </div>
                                        <? } ?>

                                        <?php if($huvaari->huvaari == 'dooguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base">Хичээлгүй</div>
                                            <div class="box-border p-1 bg-theme-9 zoom-in">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="text-gray-600"><?=$huvaari->angi_tovch;?></div>
                                        </div>
                                        <? } ?>
                                        <div class="hidden hicheel_closed w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">x</div>
                                    </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="col-span-12 text-center mt-10">
                        <form class="validate-form-teacher" action="{{ route('bigg-huvaari-save') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="b_id" value="{{ $b_id }}" />
                            <input type="hidden" id="huvaaries" name="huvaaries" value="12" /> 
                            <input type="hidden" id="delete_huvaaries" name="delete_huvaaries" value="34" /> 
                            <a href="{{ route('bigg-huvaari') }}" class="btn inline-block text-gray-700 border dark:border-dark-5 dark:text-gray-300 mr-3">Болих</a> 
                            <button type="submit" class="btn inline-block bg-theme-1 text-white huvaari_save">Хадгалах</button> 
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- END: Huvaari bagsh -->
    <!-- BEGIN: Modal Content -->
    <div id="huvaari-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Хуваарь оруулах</h2>
                </div> <!-- END: Modal Header -->
                <!-- BEGIN: Modal Body -->
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6"> 
                        <label for="modal-form-udur" class="form-label">Өдөр:</label> 
                        <input id="" class="huvaari-udur form-control w-full border mt-2" value="" disabled />
                    </div>
                    <div class="col-span-12 sm:col-span-6"> 
                        <label for="modal-form-tsag" class="form-label">Цаг:</label> 
                        <input class="huvaari-tsag form-control w-full border mt-2" value="" disabled />
                    </div>
                    <div class="col-span-12 sm:col-span-8"> 
                        <label for="huvaari-hicheel" class="form-label">Хичээл:</label> 
                        @if($fonds->isEmpty())
                            <input type="text" value="" class="form-control w-full border mt-2 bg-gray-100 cursor-not-allowed huvaari-hicheel" id="huvaari-hicheel" placeholder="Фонд ороогүй байна!" disabled>
                        @else
                        <select class="form-select" id="huvaari-hicheel">
                            <option value="1">Бүтэн цагаар</option>
                            <option value="2">Дээгүүр/Доогуур 7 хоног</option>
                        </select>
                        @endif
                    </div>
                    <div class="col-span-12 sm:col-span-8"> 
                        <label for="huvaari-deeguur" class="form-label">Орох хичээл:</label> 
                        @if($fonds->isEmpty())
                            <input type="text" value="" class="form-control w-full border bg-gray-100 cursor-not-allowed huvaari-deeguur" id="huvaari-deeguur" placeholder="Фонд ороогүй байна!" disabled>
                        @else
                        <select class="form-select w-full huvaari-deeguur" id="huvaari-deeguur">
                            <option value="">Хичээлгүй</option>
                            @foreach($fonds as $fond)
                            <option value="{{ $fond->fid }}" data-id="{{ $fond->fid }}" data-hicheel="{{ $fond->hicheel_tovch }}" data-angi="{{ $fond->tovch }}">{{ $fond->hicheel }} /{{ $fond->tovch }}/ {{ $fond->tsag }} цаг</option>
                            @endforeach
                        </select>
                        @endif

                    </div>
                    <div class="col-span-12 sm:col-span-4">
                        <label for="huvaari-angi-deeguur-kabinet" class="form-label">Кабинет:</label> 
                        <input id="huvaari-angi-deeguur-kabinet" class="huvaari-angi-deeguur-kabinet form-control w-full border" value="" />
                    </div>
                    <div class="col-span-12 sm:col-span-8 huvaari-dooguur-container">  
                        <label for="huvaari-dooguur" class="form-label">Доогуур 7 хоног:</label> 
                        @if($fonds->isEmpty())
                            <input type="text" value="" class="form-control w-full border bg-gray-100 cursor-not-allowed huvaari-dooguur" id="huvaari-dooguur" placeholder="Фонд ороогүй байна!" disabled>
                        @else
                        <select class="form-select w-full huvaari-dooguur" id="huvaari-dooguur">
                            <option value="0">Хичээлгүй</option>
                            @foreach($fonds as $fond)
                            <option value="{{ $fond->fid }}" data-id="{{ $fond->fid }}" data-hicheel="{{ $fond->hicheel_tovch }}" data-angi="{{ $fond->tovch }}">{{ $fond->hicheel }} /{{ $fond->tovch }}/ {{ $fond->tsag }} цаг</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                    <div class="col-span-12 sm:col-span-4 huvaari-dooguur-container"> 
                        <label for="huvaari-angi-dooguur-kabinet" class="form-label">Кабинет:</label> 
                        <input id="huvaari-angi-dooguur-kabinet" class="huvaari-angi-dooguur-kabinet form-control w-full border" value="" />
                    </div>
                </div> <!-- END: Modal Body -->
                <!-- BEGIN: Modal Footer -->
                <div class="modal-footer text-right"> 
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Болих</button> 
                    <button type="submit" class="btn btn-primary w-20" id="huvaari-insert">Оруулах</button> 
                </div> 
                <!-- END: Modal Footer -->
            </div>
        </div>
    </div> 
    <!-- END: Modal Content -->
    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <div class="modal-body p-0"> 
                    <!-- <form action="{{ route('bigg-tenhim-delete-ajax') }}" method="post">
                    @csrf
                        <input type="hidden" class="t_id" name="t_id" value=""> -->
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">Сонгосон хуваарийг устгахыг хүсэж байна уу?</div>
                            <div class="text-gray-600 mt-2">Хадгалах товч дээр дарвал хуваарь хадгалагдана.</div>
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="btn w-24 dark:border-dark-5 dark:text-gray-300 mr-1">{{ __('site.cancel') }}</button>
                            <button type="button" class="modal_delete_button2 btn w-24 bg-theme-6 text-white">{{ __('site.delete') }}</button>
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