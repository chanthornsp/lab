<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public static function booted()
    {
        static::creating(function ($computer) {
            // computed computer id on creating
            // ex: room id + pc name = computer id
            $computer->computer_id = (string) Str::slug($computer->room_id . '-' . $computer->name, '-');
        });
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
