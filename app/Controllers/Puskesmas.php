<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Gizisig\Puskesmas as Model;

class Puskesmas extends BaseController
{
    public function __construct()
    {
        $this->config = config('Theme');
        $this->data['config'] = $this->config;
        $this->data['page'] = "puskesmas";
    }
    public function index(): string
    {
        $this->data['items'] = Model::all();
        return view('pages/panel/puskesmas/index',  $this->data);
    }

    public function add(): string
    {
        return view('pages/panel/puskesmas/add',  $this->data);
    }

    public function edit($id): string
    {
        $this->data['item'] = Model::find($id);
        return view('pages/panel/puskesmas/edit',  $this->data);
    }
}