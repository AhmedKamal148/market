<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /***************** Data Members *****************/
    protected $fillable =
        [
            'name',
            'description',
            'purchase_price',
            'sale_price',
            'stock',
            'image',
            'category_id',
        ];
    protected $appends = ['imageUrl', 'profit_percent'];
    private $path = "images\product\\";
    private $fullPath;


    /***************** Accessories *****************/
    public function getImageUrlAttribute()
    {
        return 'images/product/' . $this->image;
    }

    public function getProfitPercentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        if ($this->purchase_price == 0) {
            return $profit_percent = 0;
        }
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent, 2);
    }

    /***************** Relations *****************/
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order');
    }
}
