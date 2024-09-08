<?php

namespace App\Models\Gizisig;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'sig_result';
    protected $fillable = [
        'id_model', 'id_pasien', 'cluster', 'score'
    ];
}