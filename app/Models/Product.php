<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'subcategory_id','type','Ad_title','Ad_descrp','location','payment_options',
        'price','name','phone','contact_method','user_id'
    ];
    public function productImage(){
        return $this->hasMany(ProductImage::class,'product_id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
