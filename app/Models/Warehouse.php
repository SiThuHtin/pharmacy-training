<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state_id',
        'township_id',
        'has_parent',
        'parent_id',
        'user_id',
    ] ;
    protected $casts = [
        'has_parent'=> 'boolean',
    ] ;
}
