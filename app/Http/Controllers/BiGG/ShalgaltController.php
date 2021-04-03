<?php

namespace App\Http\Controllers\Bigg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

use App\Models\Shalgalt;
use App\Models\Asuult;
use App\Models\Angi;

class ShalgaltController extends Controller
{
    public function index()
    {
        $pageTitle = 'Шалгалт';
        $pageName = 'shalgalt';

        $shalgalts = Shalgalt::All();

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'shalgalts' => $shalgalts
        ]);
    }

    public function add()
    {
        $pageTitle = 'Шалгалт нэмэх';
        $pageName = 'shalgalt';

        $angis = Angi::orderBy('ner', 'asc')->get();

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/add', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'angis' => $angis
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);

        $shalgalt = new Shalgalt;

        $shalgalt->ner = Str::ucfirst($request->get("ner"));
        $shalgalt->help = Str::ucfirst($request->get("help"));
        $shalgalt->angiud = json_encode($request->get("angiud"), JSON_NUMERIC_CHECK);
        $date = explode(" - ", $request->get("range"));
        $shalgalt->start = $date[0].' '.$request->get("tsags").':'.$request->get("minuts").':00';
        $shalgalt->end = $date[1].' '.$request->get("tsage").':'.$request->get("minute").':00';
        $shalgalt->tentseh = $request->get("tentseh");
        $shalgalt->shalgalt = $request->get("shalgalt");
        $shalgalt->is_shalgalt = $request->get("is_shalgalt");

        $shalgalt->save();

        return redirect()->route('bigg-shalgalt')->with('success', 'Шалгалт амжилттай нэмэгдлээ!'); 

    }

    public function asuult($id)
    {
        $pageTitle = 'Асуулт';
        $pageName = 'shalgalt';

        $notifications = Notification::select('activity_log.description', 'activity_log.updated_at', 'biggs.name as name', 'biggs.email as email')
                            ->join('biggs', 'biggs.id', '=', 'activity_log.causer_id')
                            ->limit(5)
                            ->orderBy('updated_at', 'desc')->get();

        $shalgalt = Shalgalt::findOrFail($id);
        $asuults = Asuult::orderBy('id', 'asc')->get();

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/asuult', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'shalgalt' => $shalgalt,
            'id' => $id,
            'asuults' => $asuults
        ]);
    }

    public function asuult_add($id)
    {
        $pageTitle = 'Асуулт нэмэх';
        $pageName = 'shalgalt';

        $shalgalt = Shalgalt::findOrFail($id);

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/asuult-add', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'shalgalt' => $shalgalt,
            'id' => $id
        ]);
    }

    public function asuult_store(Request $request, $id)
    {
        $asuult = new Asuult;
        
        $asuult->asuult = Str::ucfirst($request->asuult);

        if($request->hariult_songolt == 'neg'){
            $asuult->hariultuud = json_encode($request->hariult, JSON_UNESCAPED_UNICODE);
            $asuult->zuv = json_encode($request->zuv, JSON_NUMERIC_CHECK);
        }elseif($request->hariult_songolt == 'olon'){
            $asuult->hariultuud = json_encode($request->hariult2, JSON_UNESCAPED_UNICODE);
            $asuult->zuv = json_encode($request->zuv2, JSON_NUMERIC_CHECK);
        }

        $asuult->type = $request->hariult_songolt;
        $asuult->sh_id = $id;

        $asuult->save();

        return redirect()->route('bigg-shalgalt-asuult', $id)->with('success', 'Шалгалтын хариултууд амжилттай нэмэгдлээ!'); 

    }

    public function asuult_delete(Request $request)
    {
        $user = Auth::guard('bigg')->user();
        $asuult = Asuult::findOrFail($request->get("t_id"));
        $ner = $asuult->asuult;
        $asuult->delete();

        activity('asuult')
                ->performedOn($asuult)
                ->causedBy($user)
                ->log($ner.' шалгалтын асуулт устгав.');

        return redirect()->route('bigg-shalgalt-asuult', $request->get("a_id"))->with('success', 'Шалгалтын асуулт амжилттай устгалаа!'); 
    }

    public function ajax_hariult(Request $request){

        $asuult = Asuult::where('id', $request->id)->first();

        return view('bigg/ajax/hariult', [
            'id'   => $request->id,
            'h_id' => $request->h_id,
            'asuult' => $asuult,
        ]);
    }

    public function ajax_hariult_add(Request $request){

        return view('bigg/ajax/hariult-add', [
            'id' => $request->id
        ]);
    }

    public function shalgalt_delete(Request $request)
    {
        $user = Auth::guard('bigg')->user();
        $shalgalt = Shalgalt::findOrFail($request->get("t_id"));

        Asuult::where('sh_id', '=', $shalgalt->id)->delete();

        $ner = $shalgalt->ner;
        $shalgalt->delete();

        activity('shalgalt')
                ->performedOn($shalgalt)
                ->causedBy($user)
                ->log($ner.' шалгалт устгав.');

        return redirect()->route('bigg-shalgalt')->with('success', 'Шалгалт амжилттай устгалаа!'); 
    }
}