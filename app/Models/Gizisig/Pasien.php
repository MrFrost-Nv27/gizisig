<?php

namespace App\Models\Gizisig;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'sig_pasien';
    protected $fillable = [
        'nama',
        'ortu',
        'alamat',
        'latitude',
        'longitude',
        'jk',
        'tgl_lahir',
        'usia',
        'bb',
        'tb',
        'bb_u',
        'tb_u',
        'bb_tb',
    ];

    public function getIndexParameter(array $p = [])
    {
        return [
            'bb' => $this->bb,
            'tb' => $this->tb,
            'usia' => $this->usia,
        ];
    }
}
