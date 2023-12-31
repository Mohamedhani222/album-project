<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['name','path','album_id'];
    use HasFactory;


    public function album()
    {
        return $this->belongsTo(Album::class,'album_id');
    }
}
