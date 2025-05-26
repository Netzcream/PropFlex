<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Contact extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'property_id',
        'name',
        'email',
        'phone',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
        });
    }


    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
