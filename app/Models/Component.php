<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;
    protected $table = 'components';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'component_id';

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
        'model',
        'manufacturer',
        'quantity',
        'status_id',
        'user_id',
        'type_id',
        'specification_id',
    ];

    protected static function booted()
    {
        static::creating(function (Component $component) {
            // $component->component_id = (string) Str::uuid();
            $component->user_id = auth()->user()->id;
        });
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'type_id');
    }

    public function specification()
    {
        return $this->belongsTo(Specification::class, 'specification_id', 'specification_id');
    }
}
