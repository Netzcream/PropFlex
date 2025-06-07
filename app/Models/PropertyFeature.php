<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PropertyFeature extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'uuid', 'code', 'icon'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function __toString()
    {
        return $this->name;
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class);
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
