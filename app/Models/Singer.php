<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    use HasFactory;
    public function songs(){
        return $this->belongsToMany(song::class,'singer_songs');
    }
}
