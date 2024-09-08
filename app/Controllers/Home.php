<?php

namespace App\Controllers;
use App\Models\Cfhens\RuleModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('pages/panel/index', [
            'page' => "dashboard",
        ]);
    }
    public function perpuskesmas(): string
    {
        return view('pages/panel/perpuskesmas', [
            'page' => "perpuskesmas",
        ]);
    }
    public function klasterisasi(): string
    {
        return view('pages/panel/klasterisasi', [
            'page' => "klasterisasi",
        ]);
    }
}
