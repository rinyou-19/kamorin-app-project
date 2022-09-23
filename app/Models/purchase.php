<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase extends Model
{
    use HasFactory;

    // 挿入可能な列を設定する
    protected $fillable = [
        "race_day", "race_course", "grade", "race_name",
        "dirt_or_turf", "distance", "purchase_m",
        "return_m", "balance_m", "axis_h",
        "purchase_method", "jockey", "father",
        "mother_father", "condition_course", "user"
    ];
}
