<?php

namespace App\Models\Gizisig;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    protected $table = 'sig_model';
    protected $fillable = [
        'epsilon',
        'minpts',
        'score',
    ];
}