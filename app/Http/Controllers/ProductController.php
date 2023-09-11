<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\View;
use App\Http\Requests\ProductPostRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImages;
use Session;
use DataTables;
use DB;

class ProductController extends Controller
{
    public function CreateProduct()
    {
        return View::make("products.create_product");
    }

    public function StoreProduct(ProductPostRequest $request)
    {
        $validated = $request->validated(); //input validation

        try {
            DB::beginTransaction(); // start transcation
            $product = Product::SaveProduct(null, $request);
            if ($product->save()) {
                $productimages = ProductImages::SaveImages(
                    $request->file("product_images"),
                    $product->id
                );
                $category = Category::SaveCategory(
                    $request->input("category"),
                    $product->id
                );

                if ($productimages && $category) {
                    DB::commit(); //commit the transaction
                    return redirect()
                        ->route("product.list")
                        ->with("success", "Product Created Succesfully");
                }
            }
        } catch (Exception $ex) {
            DB::rollback(); //abort the transaction
            return redirect()
                ->back()
                ->with("message", "Something Went Wrong");
        }
    }

    public function ProductList()
    {
        return View::make("products.index");
    }

    public function ProductListing()
    {
        $products = Product::select([
            "products.id",
            "products.product_name",
            "products.stock_quantity",
            "products.price",
            "products.in_stock",
            "products.status",
        ])->where("status", "=", 1);

        return Datatables::of($products)
            ->editColumn("status", function ($row) {
                if ($row->status == 1) {
                    $active_status =
                        '<a class="btn btn-xs btn-success-alt">Active</a>';
                } else {
                    $active_status =
                        '<a class="btn btn-xs btn-success-alt">Inactive</a>';
                }

                return $active_status;
            })
            ->editColumn("category", function ($row) {
                $category = Category::GetCategoryname($row->id);

                return $category;
            })
            ->editColumn("in_stock", function ($row) {
                if ($row->in_stock == 1) {
                    $Instock =
                        '<a class="btn btn-xs btn-success-alt">Instock</a>';
                } else {
                    $Instock =
                        '<a class="btn btn-xs btn-success-alt">Out of Stock</a>';
                }

                return $Instock;
            })
            ->AddColumn("action", function ($row) {
                return '
                                <a class="btn btn-primary" title="" data-toggle="tooltip" data-id="' .
                    $row->id .
                    '" style="padding:6px 13px;" id="updateproduct"><i class="fa fa-pencil"></i></a>
                                <a id="deleteProduct" class="btn btn-danger" title="" data-toggle="tooltip" data-id="' .
                    $row->id .
                    '" style="padding:6px 13px;"><i class="fa fa-times"></i></a>
                            ';
            })
            ->rawColumns(["status", "category", "in_stock", "action"])
            ->toJson();
    }

    public function GetProduct($id)
    {
        if ($id) {
            $product = [
                "product" => Product::find($id),
                "category" => Category::GetCategory($id),
                "product_images" => ProductImages::GetImages($id),
            ];
            return response()->json($product);
        }
    }

    public function UpdateProduct(ProductUpdateRequest $request)
    {
        $validator = $request->validated(); //input validation

        try {

            DB::beginTransaction(); // start transcation
            $product = Product::SaveProduct($request->id, $request);
            if ($product->save()) {
                if (Category::UpdateCategory($request) && ProductImages::UpdateImages($request)) {
                    DB::commit();
                    return response()->json(["message" => "success"], 200);
                }
            }
        } catch (Exception $ex) {
            DB::rollback(); //abort the transaction
            return redirect()
                ->back()
                ->with("message", "Something Went Wrong");
        }
    }

    public function Delete($product_id)
    {
        $product = Product::find($product_id);
        $product->status = 0;
        $product->timestamps = true;
        if ($product->save()) {
            $result = ["success" => 1];
        } else {
            $result = ["success" => 0];
        }
        return $result;
    }
}
