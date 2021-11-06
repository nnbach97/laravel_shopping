<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $guarded = [];

    /**
     * Tao lien ket vs product_images
     * Get the product_id for the product_image.
     */
    public function images()
    {
        return $this->hasMany(Product_image::class, 'product_id');
    }
}
