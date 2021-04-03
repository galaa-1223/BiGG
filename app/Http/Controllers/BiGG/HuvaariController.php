<?php

namespace App\Http\Controllers\BiGG;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

use App\Models\Huvaari;
use App\Models\Teachers;
use App\Models\Fond;

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
            'teachers' => $teachers
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
            'page_name' => $pageName
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

        $fonds = Fond::select('fond.id as fid', 'fond.t_id', 'fond.tsag as tsag', 'teachers.id', 'angi.ner as angi', 'angi.course as course', 'angi.buleg as buleg', 'angi.tovch', 'hicheel.ner as hicheel', 'hicheel.tovch as hicheel_tovch')
                            ->join('teachers', 'teachers.id', '=', 'fond.t_id')
                            ->join('angi', 'angi.id', '=', 'fond.a_id')
                            ->join('hicheel', 'hicheel.id', '=', 'fond.h_id')
                            ->orderBy('angi', 'asc')
                            ->where('fond.t_id', $id)->get();
        $huvaariud = Huvaari::select('huvaari.*', 'fond.h_id as h_id', 'fond.a_id as a_id', 'hicheel.tovch as hicheel', 'angi.tovch as angi_tovch')
                            ->join('fond', 'fond.id', '=', 'huvaari.f_id')
                            ->join('hicheel', 'hicheel.id', '=', 'fond.h_id')
                            ->join('angi', 'angi.id', '=', 'fond.a_id')
                            ->where('huvaari.b_id', $id)->get();

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/huvaari-bagsh', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'teacher' => $teacher,
            'fonds' => $fonds,
            'huvaariud' => $huvaariud,
            'b_id' => $id
        ]);
    }

    public function store(Request $request)
    {
        $dataSet = [];
        $huvaari = new Huvaari;

        $huvaaries = json_decode($request->huvaaries, true);
        $deleties = json_decode($request->delete_huvaaries, true);

        $bagsh_id = $request->b_id;

        foreach($deleties as $delete){
            Huvaari::where('b_id', '=', $bagsh_id)
                    ->where('udur', '=', $delete[0])
                    ->where('tsag', '=', $delete[1])->delete();
        }

        foreach ($huvaaries as $key => $value) {
            
            if($value[3] != 0 && $value[4] != 0){
                $angi = $value[5];
                $fid = $value[3];

                $dataSet[] = [
                    'b_id'  => $bagsh_id,
                    'udur'  => $value[1],
                    'tsag'  => $value[2],
                    'angi'  => $angi,
                    'f_id'  => $fid,
                    'huvaari'  => 'deeguur',
                    'type'  => 'duuren',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

                $angi2 = $value[6];
                $fid2 = $value[4];

                $dataSet[] = [
                    'b_id'  => $bagsh_id,
                    'udur'  => $value[1],
                    'tsag'  => $value[2],
                    'angi'  => $angi2,
                    'f_id'  => $fid2,
                    'huvaari'  => 'dooguur',
                    'type'  => 'duuren',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

            }elseif($value[3] == 0 && $value[4] != 0){
                $angi = $value[6];
                $fid = $value[4];

                $dataSet[] = [
                    'b_id'  => $bagsh_id,
                    'udur'  => $value[1],
                    'tsag'  => $value[2],
                    'angi'  => $angi,
                    'f_id'  => $fid,
                    'huvaari'  => 'dooguur',
                    'type'  => 'hagas',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }elseif($value[3] != 0 && $value[4] == 0){
                $angi = $value[5];
                $fid = $value[3];
                $type = ($value[7] == 1)?'buten':'hagas';

                $dataSet[] = [
                    'b_id'  => $bagsh_id,
                    'udur'  => $value[1],
                    'tsag'  => $value[2],
                    'angi'  => $angi,
                    'f_id'  => $fid,
                    'huvaari'  => 'deeguur',
                    'type'  => $type,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }

        }

        Huvaari::insert($dataSet);
        
        return redirect('bigg/huvaari/bagsh/'.$bagsh_id)->with('success', 'Хуваарь амжилттай хадгалагдлаа!'); 
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
            'teachers' => $teachers
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
            'page_name' => $pageName
        ]);
    }
}
