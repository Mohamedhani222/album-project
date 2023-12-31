<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['name','user_id','path'];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'album_id');
    }


}
