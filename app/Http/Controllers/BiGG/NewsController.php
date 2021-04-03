<?php

namespace App\Http\Controllers\BiGG;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        $pageTitle = 'Зар, мэдээ мэдээлэл';
        $pageName = 'news';
        $news = News::orderBy('created_at', 'desc')->paginate(9);

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'newss' => $news
        ]);
    }

    public function add()
    {
        $pageTitle = 'Зар, мэдээ мэдээлэл нэмэх';
        $pageName = 'news';

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

        $news = new news;
        $news->ner = Str::ucfirst($request->ner);
        $tovch = '';
        $newsuud = explode(" ", $request->ner);
        foreach($newsuud as $t):
            $tovch .= Str::ucfirst(Str::substr($t, 0, 1));
        endforeach;
        $news->tovch = $tovch;
        $news->save();

        $activity = Activity::all()->last();

        $activity->description;
        $activity->subject;
        $activity->causer;
        $activity->changes;

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('bigg-news')->with('success', 'Зар, мэдээ мэдээлэл амжилттай нэмэгдлээ!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Зар, мэдээ мэдээлэл амжилттай нэмэгдлээ!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function edit($id)
    {
        $pageTitle = 'Зар, мэдээ мэдээлэл засварлах';
        $pageName = 'news';

        $news = News::findOrFail($id);

        $activeMenu = activeMenu($pageName);

        return view('bigg/pages/'.$pageName.'/edit', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'news' => $news,
            'user' => Auth::guard('bigg')->user()
        ]);

    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $news->ner = Str::ucfirst($request->ner);
        $news->tovch = Str::upper($request->tovch);

        $news->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('bigg-news')->with('success', 'Зар, мэдээ мэдээлэл амжилттай засварлагдлаа!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Зар, мэдээ мэдээлэл амжилттай засварлагдлаа!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function destroy(Request $request, $id)
    {
        $member = News::findOrFail($id);
        $member->delete();

        return redirect()->route('news')->with('success', 'Зар, мэдээ мэдээлэл устгагдлаа нэмэгдлээ!'); 

    }

    public function delete(Request $request)
    {
        $member = News::findOrFail($request->get("t_id"));
        $member->delete();
        return redirect()->route('bigg-news')->with('success', 'Зар, мэдээ мэдээлэл амжилттай устгалаа!'); 
    }
}
