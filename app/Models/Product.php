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
        return $this->belongsToMany(Category::class);
    }

    /**
     * Categories not linked with this produtc
     */
    public function categoriesAvailable($filter = null)
    {
        return Category::whereNotIn('categories.id', function($query) {
            $query->select('category_product.category_id')
                    ->from('category_product')
                    ->whereRaw("category_product.product_id={$this->id}");
        })->where(function ($queryFilter) use ($filter){
            if ($filter) {
                $queryFilter->where('categories.name', 'LIKE', "%{$filter}%");
            }
        })->paginate();
    }
}
