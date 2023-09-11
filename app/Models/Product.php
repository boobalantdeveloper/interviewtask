<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        "product_name",
        "unit_type",
        "category",
        "product_images",
        "price",
        "discount_percentage",
        "discount_price",
        "taxable_percentage",
        "taxable_amount",
        "in_stock",
        "stock_quantity",
    ];
    public function images()
    {
        return $this->hasMany("App\ProductImages", "product_id");
    }

    public function categories()
    {
        return $this->belongsToMany("App\Category", "product_id");
    }

    public static function SaveProduct($id = null, $request)
    {
        $product = $id == null ? new Product() : Product::find($id);
        $product->product_name = $request->product_name;
        $product->unit_type = $request->unit_type;
        $product->price = $request->price;
        $product->discount_percentage = $request->discount_percentage;
        $product->discount_price = $request->discount_price;
        $product->discount_from = $request->discount_from
            ? $request->discount_from
            : null;
        $product->discount_to = $request->discount_to
            ? $request->discount_to
            : null;
        $product->taxable_percentage = $request->taxable_percentage;
        $product->taxable_amount = $request->taxable_amount;
        $product->in_stock = $request->in_stock;
        $product->stock_quantity = $request->stock_quantity;
        $product->status = $request->status;

        return $product;
    }
}
