<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'type',
        'item_id',
        'exp_date',
        'batch',
        'amount',
        'donor_id',
        'source',
        'destination',
        'is_pending',
        'user_id',
        'warehouse_id',
    ] ;

    protected $casts = [
        'is_pending'=> 'boolean',
    ] ;
}
