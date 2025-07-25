<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Neighborhood extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'uuid', 'code', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }


    public function properties()
    {
        return $this->hasMany(Property::class);
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
}
