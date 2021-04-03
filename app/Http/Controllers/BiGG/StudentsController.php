<?php

namespace App\Http\Controllers\BiGG;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;

use App\Models\Angi;
use App\Models\MergejilBagsh;
use App\Models\Students;

class StudentsController extends Controller
{
    public function index()
    {
        $pageTitle = 'Оюутан';
        $pageName = 'students';
        $students = Students::orderBy('created_at', 'desc')->get();

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'students' => $students
        ]);
    }

    public function add()
    {
        $pageTitle = 'Оюутан нэмэх';
        $pageName = 'students';

        $angi = Angi::orderBy('created_at', 'desc')->get();
        $mergejil = MergejilBagsh::orderBy('created_at', 'desc')->get();

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/add', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'angis' => $angi
        ]);
    }

    public function store(Request $request)
    {

        $member = new Students;

        if ($request->hasFile('image')) {

            $date = Str::slug(Carbon::now());
            $imageName = Str::slug($request->code) . '-' . $date;
            $image = Image::make($request->file('image'))->save(public_path('/uploads/students/') . $imageName . '.jpg')->encode('jpg','50');
            $image->fit(300, 300);
            $image->save(public_path('/uploads/students/thumbs/' .$imageName.'.jpg'));
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
        $member->a_id = $request->get("a_id");
        $member->phone = $request->get("phone");
        $member->address = $request->get("address");


        $member->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('students')->with('success', 'Оюутан амжилттай нэмэгдлээ!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Оюутан амжилттай нэмэгдлээ!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function edit($id)
    {
        $pageTitle = 'Оюутан засварлах';
        $pageName = 'students';

        $student = Students::findOrFail($id);

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/edit', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'student' => $student
        ]);
    }

    public function update(Request $request, $id)
    {
        $member = Students::findOrFail($id);

        if ($request->hasFile('image')) {

            $date = Str::slug(Carbon::now());
            $imageName = Str::slug($request->code) . '-' . $date;
            $image = Image::make($request->file('image'))->save(public_path('/uploads/Students/') . $imageName . '.jpg')->encode('jpg','50');
            $image->fit(300, 300);
            $image->save(public_path('/uploads/Students/thumbs/' .$imageName.'.jpg'));
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
                return redirect()->route('Students')->with('success', 'Оюутан засварлагдлаа нэмэгдлээ!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Оюутан засварлагдлаа нэмэгдлээ!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function destroy(Request $request, $id)
    {
        $member = Students::findOrFail($id);
        $member->delete();

        return redirect()->route('students')->with('success', 'Оюутан устгагдлаа нэмэгдлээ!'); 

    }

    public function delete(Request $request)
    {
        $member = Students::findOrFail($request->get("t_id"));
        $member->delete();
        return redirect()->route('bigg-students')->with('success', 'Оюутан амжилттай устгалаа!'); 
    }
}
