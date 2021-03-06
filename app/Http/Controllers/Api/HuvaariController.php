<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Teachers;
use App\Models\Angi;
use App\Models\Huvaari;

class HuvaariController extends Controller
{
    public function angiList(Request $request)
    {
        $angi = array();

        if(!$request->has('sorters') && !$request->has('filters')){

            $angi = Angi::select('angi.*', 'teachers.ner as bagsh_ner', 'teachers.ovog as bagsh_ovog')
                            ->join('teachers', 'teachers.id', '=', 'angi.b_id')
                            ->orderBy('ner', 'asc')
                            ->get();


            // $response = response()->json($angi,200, [], JSON_UNESCAPED_UNICODE);

            // $response->header('Content-Type', 'application/html');
            // $response->header('charset', 'utf-8');

            // return $response;
        }elseif($request->has('filters') && !$request->has('sorters')){
            // if(!$request->filters[0]['field']){
                $angi = Angi::select('angi.id', 'angi.ner', 'angi.ovog', 'angi.image','angi.code', 'angi_mergejil.ner as mergejil', 'tenhim.ner as tenhim', 'tenhim.tovch')
                                ->join('angi_mergejil', 'angi_mergejil.id', '=', 'angi.mb_id')
                                ->join('tenhim', 'tenhim.id', '=', 'angi.t_id')
                                ->where($request->filters[0]['field'], $request->filters[0]['type'], $request->filters[0]['value']."%")
                                ->orderBy('ner', 'asc')
                                ->get();
            // }else{
            //     $angi = Angi::select('angi.id', 'angi.ner', 'angi.ovog', 'angi.image','angi.code', 'angi_mergejil.ner as mergejil', 'tenhim.ner as tenhim', 'tenhim.tovch')
            //                     ->join('angi_mergejil', 'angi_mergejil.id', '=', 'angi.mb_id')
            //                     ->join('tenhim', 'tenhim.id', '=', 'angi.t_id')
            //                     ->orderBy('ner', 'asc')
            //                     ->get();
            // }

        }else{
            $angi = Angi::select('angi.id', 'angi.ner', 'angi.ovog', 'angi.image','angi.code', 'angi_mergejil.ner as mergejil', 'tenhim.ner as tenhim', 'tenhim.tovch')
                            ->join('angi_mergejil', 'angi_mergejil.id', '=', 'angi.mb_id')
                            ->join('tenhim', 'tenhim.id', '=', 'angi.t_id')
                            ->orderBy($request->sorters[0]['field'], $request->sorters[0]['dir'])
                            ->get();
        }

        $json = array(
            "last_page" => 1,
            "data" => $angi
        );

        return $json;

    }

    public function teacherList(Request $request)
    {
        $teacher = array();

        if(!$request->has('sorters') && !$request->has('filters')){

            $teacher = Teachers::select('teachers.id', 'teachers.ner', 'teachers.ovog', 'teachers.image','teachers.code', 'teacher_mergejil.ner as mergejil', 'tenhim.ner as tenhim', 'tenhim.tovch')
                            ->join('teacher_mergejil', 'teacher_mergejil.id', '=', 'teachers.mb_id')
                            ->join('tenhim', 'tenhim.id', '=', 'teachers.t_id')
                            ->orderBy('ner', 'asc')
                            ->get();


            // $response = response()->json($teacher,200, [], JSON_UNESCAPED_UNICODE);

            // $response->header('Content-Type', 'application/html');
            // $response->header('charset', 'utf-8');

            // return $response;
        }elseif($request->has('filters') && !$request->has('sorters')){
            // if(!$request->filters[0]['field']){
                $teacher = Teachers::select('teachers.id', 'teachers.ner', 'teachers.ovog', 'teachers.image','teachers.code', 'teacher_mergejil.ner as mergejil', 'tenhim.ner as tenhim', 'tenhim.tovch')
                                ->join('teacher_mergejil', 'teacher_mergejil.id', '=', 'teachers.mb_id')
                                ->join('tenhim', 'tenhim.id', '=', 'teachers.t_id')
                                ->where($request->filters[0]['field'], $request->filters[0]['type'], $request->filters[0]['value']."%")
                                ->orderBy('ner', 'asc')
                                ->get();
            // }else{
            //     $teacher = Teachers::select('teachers.id', 'teachers.ner', 'teachers.ovog', 'teachers.image','teachers.code', 'teacher_mergejil.ner as mergejil', 'tenhim.ner as tenhim', 'tenhim.tovch')
            //                     ->join('teacher_mergejil', 'teacher_mergejil.id', '=', 'teachers.mb_id')
            //                     ->join('tenhim', 'tenhim.id', '=', 'teachers.t_id')
            //                     ->orderBy('ner', 'asc')
            //                     ->get();
            // }

        }else{
            $teacher = Teachers::select('teachers.id', 'teachers.ner', 'teachers.ovog', 'teachers.image','teachers.code', 'teacher_mergejil.ner as mergejil', 'tenhim.ner as tenhim', 'tenhim.tovch')
                            ->join('teacher_mergejil', 'teacher_mergejil.id', '=', 'teachers.mb_id')
                            ->join('tenhim', 'tenhim.id', '=', 'teachers.t_id')
                            ->orderBy($request->sorters[0]['field'], $request->sorters[0]['dir'])
                            ->get();
        }

        $json = array(
            "last_page" => 1,
            "data" => $teacher
        );

        return $json;

    }
}
