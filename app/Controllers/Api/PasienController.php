<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Libraries\DBSCAN;
use App\Models\Gizisig\Pasien;
use Phpml\Math\Distance\Euclidean;

class PasienController extends BaseApi
{
    protected $modelName = Pasien::class;

    public function validateCreate(&$request)
    {
        return $this->validate([
            'nama' => 'required',
        ]);
    }

    public function distance()
    {
        $pasien = Pasien::all();
        if ($pasien->count() == 0) {
            return $this->response->setJSON([
                'message' => 'Data tidak ditemukan',
                'status' => 404,
            ]);
        }
        $distances = [];

        $distanceMetric = new Euclidean();

        foreach ($pasien as $x) {
            foreach ($pasien as $y) {
                $distances[$x->id][$y->id] = $distanceMetric->distance(array_values($x->getIndexParameter()), array_values($y->getIndexParameter()));
            }
        }

        return $this->respond($distances);
    }

    public function dbscan()
    {
        $data = $this->request->getVar();
        $pasien = Pasien::all();
        if ($pasien->count() == 0) {
            return $this->response->setJSON([
                'message' => 'Data tidak ditemukan',
                'status' => 404,
            ]);
        }

        $dbscan = new DBSCAN($data['epsilon'], $data['minpts']);

        return $this->respond([
            'message' => 'Berhasil',
            'data' => $dbscan->cluster($pasien),
            'distances' => [],
        ]);
    }
}