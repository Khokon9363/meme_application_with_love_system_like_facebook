<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loves()
    {
        return $this->hasMany(Love::class, 'meme_id' ,'id');
    }

}
