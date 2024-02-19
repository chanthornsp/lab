<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;
    protected $table = 'specifications';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'specification_id';


    protected $fillable = [
        'name',
        'capacity',
        'unit',
        'type_id',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'type_id');
    }

    public function components()
    {
        return $this->hasMany(Component::class, 'specification_id', 'specification_id');
    }
}
