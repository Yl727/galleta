<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cookie extends Model
{
    /**
     * Coloca los campos que el usuario podra modificar
     */
    protected $fillable = [
        'message'
    ];
}
