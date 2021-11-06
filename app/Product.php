<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $guarded = [];

    /**
     * 1-n
     * Tao lien ket vs product_images
     * Get the product_id for the product_image.
     */
    public function images()
    {
        return $this->hasMany(Product_image::class, 'product_id');
    }

    /**
     * n-n
     * Tao lien ket vs Tags
     * 
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    /**
     * 1-n
     * Tao lien ket vs categories
     * 
     */
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * 1-n
     * Tao lien ket vs categories
     * 
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
