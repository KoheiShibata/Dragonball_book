<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnqueteAnswer extends Model
{
    use SoftDeletes;
    use HasFactory;


    protected $table = "enquete_answers";

    protected $guarded = [
        "id"
    ];
}
