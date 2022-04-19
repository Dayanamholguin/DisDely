<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuienesController extends Controller
{
    public function index()
    {
        return view('quienes.index');
    }
}