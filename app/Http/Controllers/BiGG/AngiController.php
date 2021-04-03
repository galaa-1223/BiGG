<?php

namespace App\Http\Controllers\BiGG;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\Angi;
use App\Models\Tenhim;
use App\Models\Teachers;
use App\Models\Mergejil;
use App\Models\MergejilTurul;

class AngiController extends Controller
{
    public function index()
    {
        $pageTitle = 'Ангиуд';
        $pageName = 'angi';

//         $search = $request['search'];
// $members = DB::table('users')
//           ->select('users.id','users.name','users.lname','users.email','users.phone','users.address_1','users.address_2','users.city','users.postcode','users.unit','users.photo','users.created_at','countries.name as country')
//           ->join('countries','users.country','=','countries.id')
//           ->where(function($query) {
//             $query->where('users.name', 'like' , '%'. $search .'%')
//               ->orWhere('users.lname', 'like' , '%'. $search .'%')
//               ->orWhere('users.email', 'like' , '%'. $search .'%');
//             })
//           ->where('users.is_active', '!=', 2)
//           ->get();

        $angi = Angi::select('angi.*')
                            ->orderBy('ner', 'asc')
                            ->paginate(10);
        $teachers = Teachers::orderBy('ner', 'desc')->get();

        $mergejil = Mergejil::orderBy('ner', 'asc')->get();
        $bolovsrol = MergejilTurul::orderBy('ner', 'asc')->get();

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'mergejils' => $mergejil,
            'bolovsrols' => $bolovsrol,
            'teachers' => $teachers,
            'angiud' => $angi
        ]);
    }

    public function add()
    {
        $pageTitle = 'Анги нэмэх';
        $pageName = 'angi';

        // $tenhims = Tenhim::orderBy('ner', 'desc')->get();
        $teachers = Teachers::orderBy('ner', 'desc')->get();

        $mergejil = Mergejil::orderBy('ner', 'asc')->get();
        $bolovsrol = MergejilTurul::orderBy('ner', 'asc')->get();

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/add', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'mergejils' => $mergejil,
            'bolovsrols' => $bolovsrol,
            'teachers' => $teachers
        ]);
    }

    public function store(Request $request)
    {
        dd($request);

        $angi = new Angi;

        $mergejil = Mergejil::findOrFail($request->m_id);

        $tovch = '';
        $ners = explode(" ", $mergejil->ner);
        foreach($ners as $t):
            $tovch .= Str::lower(Str::substr($t, 0, 1));
        endforeach;

        $angi->tovch = $tovch.' '.$request->course.Str::lower($request->buleg);

        $angi->ner = Str::ucfirst($mergejil->ner);
        $angi->course = $request->course;
        $angi->buleg = Str::lower($request->buleg);
        $angi->m_id = $request->m_id;
        $angi->b_id = $request->b_id;

        $angi->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('bigg-angi')->with('success', 'Анги амжилттай нэмэгдлээ!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Анги амжилттай нэмэгдлээ!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function edit($id)
    {
        $pageTitle = 'Анги засварлах';
        $pageName = 'angi';

        $angi = Angi::findOrFail($id);
        $teachers = Teachers::orderBy('ner', 'desc')->get();

        $mergejil = Mergejil::orderBy('ner', 'asc')->get();
        $bolovsrol = MergejilTurul::orderBy('ner', 'asc')->get();

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/edit', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'angi' => $angi,
            'mergejils' => $mergejil,
            'bolovsrols' => $bolovsrol,
            'teachers' => $teachers,
            'user' => Auth::guard('bigg')->user()
        ]);

    }

    public function update(Request $request, $id)
    {
        $angi = Angi::findOrFail($id);

        $angi->ner = Str::ucfirst($request->ner);
        $angi->tovch = Str::upper($request->tovch);

        $angi->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('bigg-angi')->with('success', 'Анги амжилттай засварлагдлаа!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Анги амжилттай засварлагдлаа!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function destroy(Request $request, $id)
    {
        $member = angi::findOrFail($id);
        $member->delete();

        return redirect()->route('angi')->with('success', 'Анги устгагдлаа нэмэгдлээ!'); 

    }

    public function delete(Request $request)
    {
        $member = angi::findOrFail($request->get("t_id"));
        $member->delete();
        return redirect()->route('bigg-angi')->with('success', 'Анги амжилттай устгалаа!'); 
    }
}
