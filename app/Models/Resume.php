<?php

namespace App\Models;

// use Attribute;
use App\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resume extends Model
{
    use HasFactory;
    use UuidTrait;

    protected $guarded = ['id'];

    protected $casts = [
        'companies' => 'array',
    ];

    /**
     * keyType
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * incrementing
     *
     * @var bool
     */
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
