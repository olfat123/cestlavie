<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function country()
    {
        return $this->belongsTo(Country::class , 'country_id');
    }
}
