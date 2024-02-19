<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Type extends Model
{
    use HasFactory;
    protected $table = 'types';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'type_id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';


    protected $fillable = [
        'name',
    ];
    protected static function booted(): void
    {
        static::creating(function (Type $type) {
            $this->type_id = (string) Str::slug($type->name);
        });
    }

    public function specifications()
    {
        return $this->hasMany(Specification::class, 'type_id', 'type_id');
    }

    public function components()
    {
        return $this->hasMany(Component::class, 'type_id', 'type_id');
    }
}
