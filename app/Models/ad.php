<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ad extends Model
{
    protected $fillable = ['user_id', 'media_type', 'media_path','title','mobile'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
