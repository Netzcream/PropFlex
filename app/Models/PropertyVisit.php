<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PropertyVisit extends Model
{
    protected $fillable = ['property_id', 'ip_address'];
}
