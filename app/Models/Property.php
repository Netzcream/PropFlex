<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class Property extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'code',
        'uuid',
        'title',
        'description',
        'price',
        'currency',
        'province_id',
        'city_id',
        'neighborhood_id',
        'address',
        'property_type_id',
        'property_operation_type_id',
        'property_status_id',
        'rooms',
        'bathrooms',
        'surface',
        'slug',
        'latitude',
        'longitude',
        'is_published',
        'published_at',
        'expires_at',
        'is_featured',
    ];
    protected $casts = [

        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        $property = $this->where('slug', $value)->first();
        if (! $property && preg_match('/^[0-9a-fA-F\-]{36}$/', $value)) {
            $property = $this->where('uuid', $value)->first();
        }
        if (! $property && is_numeric($value)) {
            $property = $this->where('id', $value)->first();
        }
        return $property ?? abort(404);
    }



    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function propertyOperationType()
    {
        return $this->belongsTo(PropertyOperationType::class);
    }

    public function propertyStatus()
    {
        return $this->belongsTo(PropertyStatus::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }
    public function features()
    {
        return $this->belongsToMany(PropertyFeature::class, 'property_property_feature');
    }


    // Ejemplo de cómo podrías registrar los tipos:
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photos')
            ->useFallbackUrl('/img/placeholder.png')
            ->useFallbackPath(public_path('/img/placeholder.png'));

        $this->addMediaCollection('plans');

        $this->addMediaCollection('featured');
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
    public function visits()
    {
        return $this->hasMany(PropertyVisit::class);
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(200)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(1200)
            ->height(800)
            ->sharpen(8);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoredByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
