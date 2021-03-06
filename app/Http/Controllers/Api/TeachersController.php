<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Teachers;

class TeachersController extends Controller
{
    private $status_code = 200;
    private $error_code = 500;

    public function teacherLogin(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                "code" => "required",
                "password" => "required"
            ]
        );

        if($validator->fails())
        {
            return response()->json([
                "status" => "failed",
                "validation_error" => $validator->errors(),
            ],500);
        }

        $teacher_code_status = Teachers::where("code", $request->code)->first();

        if(!is_null($teacher_code_status))
        {
            $password_status = Teachers::where("code", $request->code)->where("password", $request->password)->first();

            if(!is_null($password_status)) {
                $teacher = $this->teacherDetail($request->code);

                return response()->json(["status" => $this->status_code, "success" => true, "message" => "Амжилттай нэвтэрлээ!", "data" => $teacher]);
            
            } else {
                return response()->json(["status" => "failed", "success" => false, "message" => "Нууц үг худлаа байна!"], $this->error_code);
            }

        } else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Бүртгэлтэй кодтой багш алба байна!"], $this->error_code);
        }
    }

    public function teacherDetail($code) 
    {
        $teacher = array();

        if($code != "") {
            $teacher = Teachers::where("code", $code)->first();
            return $teacher;
        }
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

    public function teacherQuery(Request $request){
        // $json = array(
        //     "last_page" => 4,
        //     "data" => $teacher
        // );

        return $request;
    }

    public function teacherFond(Request $request)
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
