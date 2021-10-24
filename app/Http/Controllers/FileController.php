<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function up($req)
    {
        if(!$req->hasFile('audio')) {
            return response()->json(['upload_file_not_found'], 400);
        }else{
            $params_a_file = $request->file('audio');
            $originalFileName = $params_a_file->getClientOriginalName();
            $size = $params_a_file->getSize();
            $file_ext = $params_a_file->getClientOriginalExtension();
            $path = $params_a_file->storeAs('/public/audio',$originalFileName);
            return $path;
        }    
    }
}
