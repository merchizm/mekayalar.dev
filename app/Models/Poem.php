<?php

namespace App\Models;

use App\Enums\PostEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poem extends Model
{
    protected $table = 'poems';

    protected $fillable = [
        'title',
        'content',
        'status',
        'wrote_at'
    ];

    protected $casts = [
        'wrote_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'status' => PostEnum::class
    ];

}
