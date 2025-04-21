<?php

namespace App\Models;

use App\Models\Singer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class song extends Model
{
    use HasFactory;
    public function singers(){
        return $this->belongsToMany(Singer::class,'singer_songs');
    }
}
