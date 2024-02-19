<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    protected $fillable = [
        'name',
        'description'
    ];

    public function computers()
    {
        return $this->hasMany(Computer::class);
    }

    public function components()
    {
        return $this->hasMany(Component::class, 'status_id', 'id');
    }
}
