<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'editable',
        'user_id',
    ];
    protected $casts = [
        'editable'=> 'boolean',
    ];
}
