<?php

namespace App\Http\Controllers\BiGG;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;

use App\Models\Hicheel;

class HicheelController extends Controller
{
    public function index()
    {
        $pageTitle = 'Хичээл';
        $pageName = 'hicheel';
        $hicheel = Hicheel::orderBy('created_at', 'desc')->paginate(10);

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'hicheels' => $hicheel
        ]);
    }

    public function add()
    {
        $pageTitle = 'Хичээл нэмэх';
        $pageName = 'hicheel';

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/add', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName
        ]);
    }

    public function store(Request $request)
    {

        $hicheel = new Hicheel;

        $hicheel->ner = Str::ucfirst($request->ner);
        $hicheel->tovch = Str::ucfirst($request->tovch);
        $user = Auth::guard('bigg')->user();
        $hicheel->save();

        activity('hicheel')
                ->performedOn($hicheel)
                ->causedBy($user)
                ->withProperties([
                    'new' => [
                        'ner' => $request->ner,
                        'tovch' => $request->tovch,
                    ]
                ])->log($hicheel->ner.' хичээл нэмэв.');

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('bigg-hicheel')->with('success', 'Хичээл амжилттай нэмэгдлээ!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Хичээл амжилттай нэмэгдлээ!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function edit($id)
    {
        $pageTitle = 'Хичээл засварлах';
        $pageName = 'hicheel';

        $hicheel = Hicheel::findOrFail($id);

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/edit', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'hicheel' => $hicheel
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::guard('bigg')->user();

        $hicheel = Hicheel::findOrFail($id);

        $ner = $hicheel->ner;
        $tovch = $hicheel->tovch;

        $hicheel->ner = Str::ucfirst($request->get("ner"));
        $hicheel->tovch = Str::ucfirst($request->get("tovch"));
        $hicheel->updated_at = Carbon::now();

        $hicheel->save();

        activity('hicheel')
                ->performedOn($hicheel)
                ->causedBy($user)
                ->withProperties([
                    'new' => [
                        'ner' => $request->ner,
                        'tovch' => $request->tovch,
                    ],
                    'old' => [
                        'ner' => $ner,
                        'tovch' => $tovch,
                    ],
                ])->log($hicheel->ner.' хичээл болгов.');

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('bigg-hicheel')->with('success', 'Хичээл засварлагдлаа нэмэгдлээ!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Хичээл засварлагдлаа нэмэгдлээ!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function destroy(Request $request, $id)
    {
        $user = Auth::guard('bigg')->user();
        $hicheel = Hicheel::findOrFail($id);
        $ner = $hicheel->ner;
        $hicheel->delete();

        activity('hicheel')
                ->performedOn($hicheel)
                ->causedBy($user)
                ->log($ner.' хичээл устгав.');

        return redirect()->route('hicheel')->with('success', 'Хичээл амжилттай нэмэгдлээ!'); 

    }

    public function delete(Request $request)
    {
        $user = Auth::guard('bigg')->user();
        $hicheel = Hicheel::findOrFail($request->get("t_id"));
        $ner = $hicheel->ner;
        $hicheel->delete();

        activity('hicheel')
                ->performedOn($hicheel)
                ->causedBy($user)
                ->log($ner.' хичээл устгав.');

        return redirect()->route('bigg-hicheel')->with('success', 'Хичээл амжилттай устгалаа!'); 
    }
}
