<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CharacterImage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use SoftDeletes;
    use HasFactory;


    protected $table = "characters";

    protected $guarded = [
        'id'
    ];

    public function character_images()
    {
        return $this->hasMany(CharacterImage::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleted(function ($character) {
            $character->character_images()->delete();
        });
    }
}
