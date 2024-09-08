<?php

namespace App\Models\Gizisig;

use Illuminate\Database\Eloquent\Model;

class Puskesmas extends Model
{
    protected $table = 'sig_puskesmas';
    protected $fillable = [
        'nama',
        'alamat',
        'latitude',
        'longitude',
    ];
}