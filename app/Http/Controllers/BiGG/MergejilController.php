<?php

namespace App\Http\Controllers\BiGG;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\Mergejil;
use App\Models\MergejilTurul;

class MergejilController extends Controller
{
    public function index()
    {
        $pageTitle = 'Мэргэжил';
        $pageName = 'mergejil';

        $mergejil = Mergejil::orderBy('ner', 'asc')->get();

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'mergejils' => $mergejil,
            'user' => Auth::guard('bigg')->user()
        ]);
    }

    public function add()
    {
        $pageTitle = 'Мэргэжил нэмэх';
        $pageName = 'mergejil';

        $bolovsrol = MergejilTurul::orderBy('ner', 'asc')->get();

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/add', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'bolovsrols' => $bolovsrol,
            'user' => Auth::guard('bigg')->user()
        ]);
    }

    public function store(Request $request)
    {

        $mergejil = new Mergejil;

        $mergejil->ner = Str::ucfirst($request->ner);
        $mergejil->bolovsrol = $request->bolovsrol;
        $mergejil->jil = $request->jil;

        $mergejil->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('bigg-mergejil')->with('success', 'Мэргэжил амжилттай нэмэгдлээ!');
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Мэргэжил амжилттай нэмэгдлээ!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function edit($id)
    {
        $pageTitle = 'Мэргэжил засварлах';
        $pageName = 'mergejil';

        $teacher = mergejil::findOrFail($id);

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/edit', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'teacher' => $teacher,
            'user' => Auth::guard('bigg')->user()
        ]);
    }

    public function update(Request $request, $id)
    {
        $mergejil = mergejil::findOrFail($id);

        $mergejil->ner = Str::ucfirst($request->ner);
        $mergejil->course = $request->course;
        $mergejil->buleg = Str::ucfirst($request->buleg);
        $mergejil->m_id = $request->m_id;
        $mergejil->b_id = $request->b_id;

        $mergejil->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('bigg-mergejil')->with('success', 'Мэргэжил амжилттай засварлагдлаа!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Мэргэжил амжилттай засварлагдлаа!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function destroy(Request $request, $id)
    {
        $member = mergejil::findOrFail($id);
        $member->delete();

        return redirect()->route('mergejil')->with('success', 'Мэргэжил устгагдлаа нэмэгдлээ!'); 

    }

    public function delete(Request $request)
    {
        $member = mergejil::findOrFail($request->get("t_id"));
        $member->delete();
        return redirect()->route('bigg-mergejil')->with('success', 'Мэргэжил амжилттай устгалаа!'); 
    }
}
