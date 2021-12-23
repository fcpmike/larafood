<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use TenantTrait;

    protected $fillable = ['title', 'flag', 'price', 'description', 'image'];

    /**
     * return Categories
     */
    public function categories()
    {
        $this->belongsToMany(Category::class);
    }
}
