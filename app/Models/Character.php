<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CharacterImage;

class Character extends Model
{
    use HasFactory;

    protected $table = "characters";

    protected $guarded = [
        'id'
    ];

}
