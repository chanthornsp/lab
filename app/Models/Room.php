<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';


    protected $fillable = [
        'room_id',
        'name',
        'description',
        'capacity',
        'status',
        'user_id',
    ];
}
