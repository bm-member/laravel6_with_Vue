<?php

namespace App\Http\Controllers;

class LocalizationController extends Controller
{
    public function index($lang)
    {
        session(['locale' => $lang]);
        return back();
    }
}
