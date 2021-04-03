<?php

namespace App\Http\Controllers\BiGG;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadsController extends Controller
{
    public function index()
    {
        echo 'Uploads';
    }

    public function upload_ckeditor(Request $request)
    {
        $request->upload->move('uploads/files', $request->file('upload')
            ->getClientOriginalName());
        echo json_encode(array('file_name' => $request->file('upload')
            ->getClientOriginalName()));
    }
}
