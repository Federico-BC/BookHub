<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favoritos extends Model
{
    protected $fillable = [
        "user_id",
        "olid"
    ];
}
