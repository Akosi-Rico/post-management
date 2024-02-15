<?php

namespace App\Models\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostRating extends Model
{
    use HasFactory;
    protected $guarded = [];

    const RATE_ONE = 1;
    const RATE_TWO = 2;
    const RATE_THREE = 3;
    const RATE_FOUR = 4;
    const RATE_FIVE = 5;
}
