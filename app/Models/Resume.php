<?php

namespace App\Models;

// use Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resume extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'companies' => 'array',
    ];

    // /**
    //  *
    //  * @return \Illuminate\Database\Eloquent\Casts\Attribute
    //  */
    // protected function companies(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => json_decode($value, true),
    //         set: fn ($value) => json_encode($value),
    //     );
    // }
}
