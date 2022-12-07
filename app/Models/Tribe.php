<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tribe extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "tribes";

    protected $guarded = [
        'id'
    ];
}
