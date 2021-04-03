<?php

namespace App\Http\Controllers\BiGG;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Settings;

class SettingsController extends Controller
{

    public function index()
    {

        $pageTitle = 'Хувийн мэдээлэл';
        $pageName = 'settings';

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName
        ]);
    }

    public function password()
    {

        $pageTitle = 'Нууц үг солих';
        $pageName = 'settings';

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/password', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName
        ]);
    }

    public function huvaari()
    {

        $pageTitle = 'Хуваарь тохиргоо';
        $pageName = 'settings';

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/huvaari', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName
        ]);
    }
}
