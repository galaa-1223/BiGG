<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Students;

class StudentsController extends Controller
{
    private $status_code = 200;
    private $error_code = 500;

    public function studentLogin(Request $request)
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

        $student_code_status = Students::where("code", $request->code)->first();

        if(!is_null($student_code_status))
        {
            $password_status = Students::where("code", $request->code)->where("password", $request->password)->first();

            if(!is_null($password_status)) {
                $student = $this->studentDetail($request->code);

                return response()->json(["status" => $this->status_code, "success" => true, "message" => "Амжилттай нэвтэрлээ!", "data" => $student]);
            
            } else {
                return response()->json(["status" => "failed", "success" => false, "message" => "Нууц үг худлаа байна!"], $this->error_code);
            }

        } else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Бүртгэлтэй кодтой багш алба байна!"], $this->error_code);
        }
    }

    public function studentDetail($code) 
    {
        $student = array();

        if($code != "") {
            $student = Students::where("code", $code)->first();
            return $student;
        }
    }

    public function studentList(Request $request)
    {
        $student = array();

        if(!$request->has('sorters') && !$request->has('filters')){

            $student = Students::select('students.id', 'students.ner', 'students.ovog', 'students.image','students.code', 'students.status', 'angi.ner as angi', 'angi.course', 'angi.buleg')
                            ->join('angi', 'angi.id', '=', 'students.a_id')
                            ->orderBy('ner', 'asc')
                            ->get();


            // $response = response()->json($student,200, [], JSON_UNESCAPED_UNICODE);

            // $response->header('Content-Type', 'application/html');
            // $response->header('charset', 'utf-8');

            // return $response;
        }elseif($request->has('filters') && !$request->has('sorters')){
            // if(!$request->filters[0]['field']){
                $student = Students::select('students.id', 'students.ner', 'students.ovog', 'students.image','students.code', 'student_mergejil.ner as mergejil', 'tenhim.ner as tenhim', 'tenhim.tovch')
                                ->join('student_mergejil', 'student_mergejil.id', '=', 'students.mb_id')
                                ->join('tenhim', 'tenhim.id', '=', 'students.t_id')
                                ->where($request->filters[0]['field'], $request->filters[0]['type'], $request->filters[0]['value']."%")
                                ->orderBy('ner', 'asc')
                                ->get();
            // }else{
            //     $student = Students::select('students.id', 'students.ner', 'students.ovog', 'students.image','students.code', 'student_mergejil.ner as mergejil', 'tenhim.ner as tenhim', 'tenhim.tovch')
            //                     ->join('student_mergejil', 'student_mergejil.id', '=', 'students.mb_id')
            //                     ->join('tenhim', 'tenhim.id', '=', 'students.t_id')
            //                     ->orderBy('ner', 'asc')
            //                     ->get();
            // }

        }else{
            $student = Students::select('students.id', 'students.ner', 'students.ovog', 'students.image','students.code', 'student_mergejil.ner as mergejil', 'tenhim.ner as tenhim', 'tenhim.tovch')
                            ->join('student_mergejil', 'student_mergejil.id', '=', 'students.mb_id')
                            ->join('tenhim', 'tenhim.id', '=', 'students.t_id')
                            ->orderBy($request->sorters[0]['field'], $request->sorters[0]['dir'])
                            ->get();
        }

        $json = array(
            "last_page" => 1,
            "data" => $student
        );

        return $json;

    }

    public function studentQuery(Request $request){
        // $json = array(
        //     "last_page" => 4,
        //     "data" => $student
        // );

        return $request;
    }
}
