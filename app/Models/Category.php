<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function logs(){
        return $this->hasMany(Log::class,'category_id');
    }

    public function tasks(){
        return $this->hasMany(Task::class,'category_id');
    }

}
