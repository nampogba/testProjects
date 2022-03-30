<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'nameProduct',
        'slug',
        'productCat_id',
        'price',
        'origin',
        'barcode',
        'productionArea',
        'resource',
        'producer',
        'importers',
        'distributor',
        'transporters',
        'manager',
        'storageConditions',
        'description',
        'contentProduct',
        'ingredient',
        'usesProduct',
        'userManual',
        'avatar',
        'verifications',
        'status',
    ];
}
