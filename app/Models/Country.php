<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tokens(){
        return $this->hasMany(Token::class , 'country_id');
    }

    public function countAndroid(){
       return $this->tokens->where('os','android')->count();
    }

    public function countIos(){
        return $this->tokens->where('os','ios')->count();
    }

    public function wMessages(){
        return $this->hasMany(WeeklyMessage::class , 'country_id');
    }

    public function wVerses(){
        return $this->hasMany(WeeklyVerse::class , 'country_id');
    }
}
