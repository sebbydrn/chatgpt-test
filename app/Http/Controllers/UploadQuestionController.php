<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadQuestionController extends Controller
{
    public function index()
    {
        return view('upload');
    }
}
