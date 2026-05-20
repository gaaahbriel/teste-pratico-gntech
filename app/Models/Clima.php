<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Model;

class Clima extends Model
{
    protected $table = 'climas';

    protected $fillable = [
        'cidade',
        'temperatura',
        'sensacao_termica',
        'umidade',
        'clima',
        'vento'
    ];

    protected function cidade(): Attribute
    {
        return Attribute::make(
        set: fn ($value) => mb_convert_encoding(
            $value,
            'UTF-8',
            'UTF-8'
        )
    );
    }
}
