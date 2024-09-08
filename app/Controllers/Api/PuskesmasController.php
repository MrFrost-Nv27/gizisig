<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Models\Cfhens\DiseaseModel;
use App\Models\Gizisig\Puskesmas;

class PuskesmasController extends BaseApi
{
    protected $modelName = Puskesmas::class;

    public function validateCreate(&$request)
    {
        return $this->validate([
            'nama' => 'required',
        ]);
    }
}
