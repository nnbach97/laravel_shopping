<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    // Sử dụng sort Delete
    use SoftDeletes;
    //
    protected $fillable = [
        'name',
        'parent_id',
        'slug'
    ];
}
