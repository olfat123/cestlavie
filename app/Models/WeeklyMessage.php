<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyMessage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $dates = ['sent_at'];

    public function country()
    {
        return $this->belongsTo(Country::class , 'country_id');
    }
}
