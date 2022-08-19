<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    /*****************************************************/
    /***************** Data Members *****************/
        protected $fillable=
            [
                'name' ,
                'description',
                'purchase_price',
                'sale_price',
                'stock',
                'image',
                'category_id',
            ];
        protected $appends = ['imageUrl' ,'profit_percent'];
        private  $path = "images\product\\";
        private $fullPath ;
    /*****************************************************/


    /*****************************************************/
        /***************** Relations *****************/
        public  function  category()
        {
            return $this->belongsTo(Category::class,'category_id' , 'id');
        }
    /*****************************************************/

    /*****************************************************/
        /***************** Accessories *****************/
        public  function getImageUrlAttribute()
        {
            $this->fullPath = $this->path . $this->image;

            if(file_exists($this->fullPath))
            {
                if(str_contains($this->fullPath,'jpg')||
                    str_contains($this->fullPath,'png')||
                    str_contains($this->fullPath,'jpeg')) {
                    return $this->fullPath;
                }
                else{
                    // return default image;
                    return 'images/product/default/no_product.jpg';
                }
            }
            else{
                // return default image;
                return 'images/product/default/no_product.jpg';
            }
        }

        public function getProfitPercentAttribute()
        {
            $profit = $this->sale_price - $this->purchase_price ;
            if($this->purchase_price == 0){
                return $profit_percent = 0;
            }
            $profit_percent = $profit * 100 / $this->purchase_price;
            return  number_format($profit_percent,2)  ;
        }
    /*****************************************************/

}
