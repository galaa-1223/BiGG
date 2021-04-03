<?php
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

if(!function_exists('activeMenu')) 
{
    function activeMenu($pageName, $type = 'app.bigg_side_menu')
    {
        $firstPageName = '';
        $secondPageName = '';
        $thirdPageName = '';

        
        foreach (config($type) as $menu) {
            if ($menu !== 'devider' && $menu['page_name'] == $pageName && empty($firstPageName)) {
                $firstPageName = $menu['page_name'];
            }

            if (isset($menu['sub_menu'])) {
                foreach ($menu['sub_menu'] as $subMenu) {
                    if ($subMenu['page_name'] == $pageName && empty($secondPageName) && $subMenu['page_name'] != 'dashboard') {
                        $firstPageName = $menu['page_name'];
                        $secondPageName = $subMenu['page_name'];
                    }

                    if (isset($subMenu['sub_menu'])) {
                        foreach ($subMenu['sub_menu'] as $lastSubmenu) {
                            if ($lastSubmenu['page_name'] == $pageName) {
                                $firstPageName = $menu['page_name'];
                                $secondPageName = $subMenu['page_name'];
                                $thirdPageName = $lastSubmenu['page_name'];
                            }       
                        }
                    }
                }
            }
        }
        

        return [
            'first_page_name' => $firstPageName,
            'second_page_name' => $secondPageName,
            'third_page_name' => $thirdPageName
        ];
    }
}

if(!function_exists('useg')) 
{
    function useg($too)
    {
        $useg = array(
            1 => 'а', 
            2 => 'б', 
            3 => 'в', 
            4 => 'г',
            5 => 'д', 
            6 => 'е', 
            7 => 'ё', 
            8 => 'ж'
        );
        

        return $useg[$too];
    }
}

if(!function_exists('latin')) 
{
    function latin($too)
    {
        $useg = array(
            1 => 'a', 
            2 => 'b', 
            3 => 'c', 
            4 => 'd',
            5 => 'e', 
            6 => 'f', 
            7 => 'g', 
            8 => 'h'
        );
        

        return $useg[$too];
    }
}