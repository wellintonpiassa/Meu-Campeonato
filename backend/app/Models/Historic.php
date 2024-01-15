<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'championship_id',
        'first_place_team_id',
        'second_place_team_id',
        'third_place_team_id',
        'fourth_place_team_id'
    ];
}
