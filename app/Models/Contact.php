<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    // 挿入可能な列を設定する
    protected $fillable = [
        "name", "category", "email", "detail",
    ];
}
