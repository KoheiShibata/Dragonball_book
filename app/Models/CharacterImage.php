<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Character;

class CharacterImage extends Model
{
    use HasFactory;

    
    protected $table = "character_images";

    protected $guarded = [
        'id'
    ];
}
