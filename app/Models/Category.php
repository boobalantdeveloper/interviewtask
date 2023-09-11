<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "category";

    public function products()
    {
        return $this->belongsToMany("App\Product", "product_id");
    }

    public static function GetCategory($product_id)
    {
        if ($product_id) {
            $getcategory = Category::select("category_name")
                ->where("product_id", "=", $product_id)
                ->where("status", "=", 1)
                ->get();
            return $getcategory;
        }
    }
    public static function SaveCategory($category = [], $product_id)
    {
        if ($category > 0) {
            foreach ($category as $cat) {
                $SaveCategory = new Category();
                $SaveCategory->category_name = $cat;
                $SaveCategory->product_id = $product_id;
                $SaveCategory->save();
            }
            return true;
        }
    }

    public static function GetCategoryname($product_id)
    {
        if ($product_id) {
            $category_list = "";
            $getcategory = Category::select("category_name")
                ->where("product_id", "=", $product_id)
                ->where("status", "=", 1)
                ->get();

            foreach ($getcategory as $category) {
                if ($getcategory->last() == $category) {
                    $category_list .= $category->category_name;
                } else {
                    $category_list .= $category->category_name . ",";
                }
            }

            return $category_list;
        }
    }

    public static function UpdateCategory($request)
    {
        if ($request->id) {
            foreach ($request->category as $category) {
                $categoryupdate = Category::select("category_name")
                    ->where("product_id", "=", $request->id)
                    ->where("category_name", "=", $category)
                    ->where("status", "=", 1)
                    ->first();
                if ($categoryupdate == "") {
                    $SaveCategory = new Category();
                    $SaveCategory->category_name = $category;
                    $SaveCategory->product_id = $request->id;
                    $SaveCategory->save();
                }
            }
            $unset = Category::select("id")
                ->where("product_id", "=", $request->id)
                ->where("status", "=", 1)
                ->whereNotIn("category_name", $request->category)
                ->get();
            if ($unset != "") {
                foreach ($unset as $remove) {
                    $remove_category = Category::find($remove->id)->delete();
                }
            }
            return true;
        }
    }
}
