<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
        {{ $h_id }}. {{ $asuult->asuult }}
    </div>
    <div class="p-5" id="striped-rows-table">
        <div class="preview">
            <div class="overflow-x-auto">
                <table class="table">
                    <tbody>
                        <?php 
                        $i = 1;
                        $zuv = json_decode($asuult->zuv, true); 
                        $hariultuud = json_decode($asuult->hariultuud, true);
                        ?>
                        @foreach($hariultuud as $key => $hariult)
                        <?php
                        if(array_search($key,$zuv) !== false){
                            $theme = 'bg-theme-9';
                        }else{
                            $theme = '';
                        } 
                        ?>
                        <tr class="bg-gray-200 <?=$theme;?>">
                            <td class="border-b w-10"><?=useg($i);?>.</td>
                            <td class="border-b">{{ $hariult }}</td>
                        </tr>
                        <?php $i++;?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
        <button type="button" class="button w-full bg-theme-7 text-white mt-3">Хариулт засах</button>
    </div>
</div>