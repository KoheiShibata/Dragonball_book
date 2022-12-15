<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Character;
use Illuminate\Database\Eloquent\SoftDeletes;

class CharacterImage extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = "character_images";

    protected $guarded = [
        'id'
    ];

    public function character() {
        return $this->belongsTo(Character::class);
    }

}
