<?php

namespace App\Http\Controllers\BiGG;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\Hicheel;

class HicheelController extends Controller
{
    public function index()
    {
        $pageTitle = 'Хичээл';
        $pageName = 'hicheel';
        $hicheel = Hicheel::orderBy('created_at', 'desc')->paginate(9);

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'hicheels' => $hicheel,
            'user' => Auth::guard('bigg')->user()
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
            'page_name' => $pageName,
            'user' => Auth::guard('bigg')->user()
        ]);
    }

    public function store(Request $request)
    {

        $hicheel = new Hicheel;

        $hicheel->ner = Str::ucfirst($request->ner);

        $hicheel->save();

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

        $teacher = Teachers::findOrFail($id);

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
        $member = Hicheel::findOrFail($id);

        if ($request->hasFile('image')) {

            $date = Str::slug(Carbon::now());
            $imageName = Str::slug($request->code) . '-' . $date;
            $image = Image::make($request->file('image'))->save(public_path('/uploads/hicheel/') . $imageName . '.jpg')->encode('jpg','50');
            $image->fit(300, 300);
            $image->save(public_path('/uploads/hicheel/thumbs/' .$imageName.'.jpg'));
            $member->image = $imageName.'.jpg';
        }

        $member->ner = Str::ucfirst($request->get("ner"));
        $member->ovog = Str::ucfirst($request->get("ovog"));
        $member->urag = Str::ucfirst($request->get("urag"));
        $member->code = $request->get("code");
        $member->register = $request->get("register");
        $member->huis = $request->get("huis");
        $member->tursun = $request->get("tursun");
        $member->email = $request->get("email");
        $member->password = $request->get("password");
        $member->phone = $request->get("phone");
        $member->address = $request->get("address");
        $member->updated_at = Carbon::now();

        $member->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('hicheel')->with('success', 'Хичээл засварлагдлаа нэмэгдлээ!'); 
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
        $member = Hicheel::findOrFail($id);
        $member->delete();

        return redirect()->route('hicheel')->with('success', 'Хичээл устгагдлаа нэмэгдлээ!'); 

    }

    public function delete(Request $request)
    {
        $member = Hicheel::findOrFail($request->get("t_id"));
        $member->delete();
        return redirect()->route('bigg-hicheel')->with('success', 'Хичээл амжилттай устгалаа!'); 
    }
}
