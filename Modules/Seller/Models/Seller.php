<?php

namespace Modules\Seller\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Seller\Database\Factories\SellerFactory;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [];

    /**
     * @return SellerFactory
     */
    protected static function newFactory(): SellerFactory
    {
        return SellerFactory::new();
    }
}
