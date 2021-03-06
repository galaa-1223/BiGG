<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Teachers;
use App\Models\Students;

class StatisticController extends Controller
{
    private $status_code = 200;
    private $error_code = 500;

    public function index() 
    {
        
        $stats = [
            "teachers_count" => Teachers::count(),
            "students_count" => Students::count()
        ];
        // $response = response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);

        // $response->header('Content-Type', 'application/json');
        // $response->header('charset', 'utf-8');
        return response()->json(["status" => $this->status_code, "success" => true, "message" => "Амжилттай!", "data" => $stats]);

        // return $response;
    }
}
