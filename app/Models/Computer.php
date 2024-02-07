<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    protected $table = 'computers';

    protected $fillable  = [
        'computer_id',
        'name',
        'description',
        'room_id',
        'status_id',
    ];

    protected $primaryKey = 'computer_id';
    protected $keyType = 'string';
    public $incrementing = false;
}
