<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualMessage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function country()
    // {
    //     return $this->belongsTo(Country::class , 'country_id')->where('country_id', '!=', 0);
    // }
}
