<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tribe extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = "tribes";

    protected $guarded = [
        'id'
    ];
}
