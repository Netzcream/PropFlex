<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'uuid', 'code', 'province_id'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
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
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
