<?php

namespace App\Http\Controllers\BiGG;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

use App\Models\MergejilBagsh;

class MergejilBagshController extends Controller
{
    public function index()
    {
        $pageTitle = 'Багшийн мэргэжил';
        $pageName = 'mergejil_bagsh';
        $mergejil_bagsh = MergejilBagsh::orderBy('created_at', 'desc')->paginate(9);

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'mergejil_bagshs' => $mergejil_bagsh
        ]);
    }

    public function add()
    {
        $pageTitle = 'Багшийн мэргэжил нэмэх';
        $pageName = 'mergejil_bagsh';

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/add', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName
        ]);
    }

    public function store(Request $request)
    {

        $mergejil_bagsh = new MergejilBagsh;

        $mergejil_bagsh->ner = Str::ucfirst($request->ner);

        $mergejil_bagsh->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('bigg-mergejil_bagsh')->with('success', 'Багшийн мэргэжил амжилттай нэмэгдлээ!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Багшийн мэргэжил амжилттай нэмэгдлээ!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function edit($id)
    {
        $pageTitle = 'Багшийн мэргэжил засварлах';
        $pageName = 'mergejil_bagsh';

        $mergejilBagsh = MergejilBagsh::findOrFail($id);

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/edit', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'mergejilBagsh' => $mergejilBagsh
        ]);
    }

    public function update(Request $request, $id)
    {
        $mergejil_bagsh = MergejilBagsh::findOrFail($id);

        $mergejil_bagsh->ner = Str::ucfirst($request->ner);

        $mergejil_bagsh->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('bigg-mergejil_bagsh')->with('success', 'Багшийн мэргэжил амжилттай засварлагдлаа!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Багшийн мэргэжил амжилттай засварлагдлаа!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function destroy(Request $request, $id)
    {
        $member = MergejilBagsh::findOrFail($id);
        $member->delete();

        return redirect()->route('mergejil_bagsh')->with('success', 'Багшийн мэргэжил устгагдлаа нэмэгдлээ!'); 

    }

    public function delete(Request $request)
    {
        // $user = Auth::guard('bigg')->user();
        $mergejil_bagsh = MergejilBagsh::findOrFail($request->get("t_id"));
        // $ner = $hicheel->ner;
        $mergejil_bagsh->delete();

        // activity('hicheel')
        //         ->performedOn($hicheel)
        //         ->causedBy($user)
        //         ->log($ner.' хичээл устгав.');

        return redirect()->route('bigg-mergejil_bagsh')->with('success', 'Багшийн мэргэжил амжилттай устгалаа!'); 
    }
}
