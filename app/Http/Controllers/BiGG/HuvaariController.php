<?php

namespace App\Http\Controllers\BiGG;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\Huvaari;
use App\Models\Teachers;

class HuvaariController extends Controller
{
    public function index()
    {
        $pageTitle = 'Хичээлийн хуваарь';
        $pageName = 'huvaari';
        $huvaari = Huvaari::orderBy('created_at', 'desc')->paginate(9);
        $teachers = Teachers::orderBy('created_at', 'desc')->get();

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'huvaari' => $huvaari,
            'teachers' => $teachers,
            'user' => Auth::guard('bigg')->user()
        ]);
    }

    public function add()
    {
        $pageTitle = 'Хичээл нэмэх';
        $pageName = 'huvaari';

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/add', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('bigg')->user()
        ]);
    }

    public function bagsh($id)
    {
        $pageTitle = 'Багшийн хуваарь';
        $pageName = 'huvaari';

        $teacher = Teachers::select('teachers.id', 'teachers.ner', 'teachers.ovog', 'teachers.image','teachers.code', 'teacher_mergejil.ner as mergejil')
                            ->join('teacher_mergejil', 'teacher_mergejil.id', '=', 'teachers.mb_id')
                            ->orderBy('ner', 'asc')
                            ->findOrFail($id);

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/huvaari-bagsh', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'teacher' => $teacher,
            'user' => Auth::guard('bigg')->user()
        ]);
    }

    public function angi($id)
    {
        $pageTitle = 'Анги хуваарь';
        $pageName = 'huvaari';

        $teachers = Teachers::orderBy('created_at', 'desc')->get();

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/huvaari-angi', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'teachers' => $teachers,
            'user' => Auth::guard('bigg')->user()
        ]);
    }

    public function shalgalt()
    {
        $pageTitle = 'Шалгалт хуваарь';
        $pageName = 'huvaari';

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/shalgalt', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('bigg')->user()
        ]);
    }
}
