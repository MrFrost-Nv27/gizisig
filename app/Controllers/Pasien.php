<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Gizisig\Pasien as Model;

class Pasien extends BaseController
{
    public function __construct()
    {
        $this->config = config('Theme');
        $this->data['config'] = $this->config;
        $this->data['page'] = "pasien";
    }
    public function index(): string
    {
        $this->data['items'] = Model::all();
        return view('pages/panel/pasien/index',  $this->data);
    }

    public function add(): string
    {
        return view('pages/panel/pasien/add',  $this->data);
    }

    public function edit($id): string
    {
        $this->data['item'] = Model::find($id);
        return view('pages/panel/pasien/edit',  $this->data);
    }
}