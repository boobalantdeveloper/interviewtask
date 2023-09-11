<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;

    protected $table = "product_images";

    protected $fillable = ["image_url", "product_id"];

    public function product()
    {
        return $this->belongsTo("App\Product", "product_id");
    }

    public static function SaveImages($images = [], $product_id)
    {
        if ($images > 0) {
            foreach ($images as $image) {
                $images = new ProductImages();
                $destinationPath = "public/custom_images/products";
                $filename = strtolower(trim($image->getClientOriginalName()));
                $name = time() . rand(100, 999) . $filename;
                $image->move($destinationPath, $name);
                $images->image_url = $name;
                $images->product_id = $product_id;
                $images->save();
            }
            return true;
        }
    }
    public static function GetImages($product_id)
    {
        if ($product_id) {
            $getimages = ProductImages::select("image_url","id")
                ->where("product_id", "=", $product_id)
                ->get();
            return $getimages;
        }
    }
    public static function UpdateImages($request)
    {
        if ($request) {
               if($request->old_images!=""){
                $decode=json_decode($request->old_images);
                $unset = ProductImages::select("id","image_url")
                ->where("product_id", "=", $request->id)
                ->whereNotIn("id",$decode)
                ->get();
            if ($unset != "") {
                foreach ($unset as $remove) {
                    $remove_images = ProductImages::find($remove->id)->delete();
                    unlink('public/custom_images/products/'.$remove->image_url);
                }
            }
               }
              if($request->product_images>0){
            foreach ($request->product_images as $image) {
                $images = new ProductImages();
                $destinationPath = "public/custom_images/products";
                $filename = strtolower(trim($image->getClientOriginalName()));
                $name = time() . rand(100, 999) . $filename;
                $image->move($destinationPath, $name);
                $images->image_url = $name;
                $images->product_id = $request->id;
                $images->save();
            }
           }
            return true;
        }
    }
}
