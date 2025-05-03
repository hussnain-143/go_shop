<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Models\Color;
use App\Models\HomeBanner;
use App\Models\Product;
use App\Models\ProductAttr;
use App\Models\ProductAttribute;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class HomeController extends Controller
{
    use ApiResponse;

    public function HomeSetupApi()
    {
        $data = [];
        $data['banner'] = HomeBanner::get();
        $data['category'] = Category::with('products:id,category_id,name,slug,image,item_code')->get();
        $data['brands'] = Brands::get();
        $data['product'] = Product::with('productAttribute')->select('id','category_id','name','slug','image','item_code')->get();

        return $this->success($data, 'Data retrieved successfully', 200, []);
    }

    public function HomeCategoryApi()
    {
        $data = Category::with('subCategory')->whereNull('parent_category_id')->get();
        return $this->success($data, 'Data retrieved successfully', 200, []);
    }

    public function CategoryApi(Request $request)
    {
        $slug = $request->slug;
        $attribute = $request->attribute ?? [];
        $brand = $request->brand ?? [];
        $color = $request->color ?? [];
        $size = $request->size ?? [];
        $highprice = $request->highprice;
        $lowprice = $request->lowprice;

        $category = Category::where('slug', $slug)->first();

        if ($category) {
            $product = $this->getFilterProducts($category->id, $size, $color, $brand, $attribute, $highprice, $lowprice);

            if (empty($category->parent_category_id)) {
                $cat = Category::where('parent_category_id', $category->id)->get();
            } else {
                $cat = Category::where('parent_category_id', $category->parent_category_id)
                    ->where('id', '!=', $category->id)
                    ->get();
            }
        } else {
            $category = Category::first();
            $product = Product::with('productAttribute')
                ->where('category_id', $category->id)
                ->select('id','name','slug','image','item_code')
                ->paginate(10);

            if (empty($category->parent_category_id)) {
                $cat = Category::where('parent_category_id', $category->id)->get();
            } else {
                $cat = Category::where('parent_category_id', $category->parent_category_id)
                    ->where('id', '!=', $category->id)
                    ->get();
            }
        }

        $prices = ProductAttr::selectRaw('MIN(CAST(price AS DECIMAL)) as lowPrice, MAX(CAST(price AS DECIMAL)) as highPrice')->first();
        $lowPrice = $prices->lowPrice;
        $highPrice = $prices->highPrice;
        $brands = Brands::get();
        $sizes = Size::get();
        $colors = Color::get();
        $attributes = CategoryAttribute::where('category_id', $category->id)->with('attribute')->get();

        return $this->success(compact('category', 'product', 'cat', 'lowPrice', 'highPrice', 'brands', 'sizes', 'colors', 'attributes'), 'Data retrieved successfully', 200, []);
    }

    private function getFilterProducts($category_id, $size, $color, $brand, $attribute, $highprice, $lowprice)
    {
        $query = Product::where('category_id', $category_id);

        if (!empty($brand)) {
            $query->whereIn('brand_id', $brand);
        }

        $productIds = $query->pluck('id');

        if (!empty($attribute)) {
            $productIds = ProductAttribute::whereIn('attribute_value_id', $attribute)
                ->whereIn('product_id', $productIds)
                ->pluck('product_id')
                ->unique();
        }

        $attrQuery = ProductAttr::whereIn('product_id', $productIds);

        if (!empty($size)) {
            $attrQuery->whereIn('size_id', $size);
        }

        if (!empty($color)) {
            $attrQuery->whereIn('color_id', $color);
        }

        if ($lowprice !== null && $highprice !== null && $lowprice !== '' && $highprice !== '') {
            $attrQuery->whereBetween('price', [$lowprice, $highprice]);
        }

        $finalProductIds = $attrQuery->pluck('product_id')->unique();

        return Product::with('productAttribute')
            ->whereIn('id', $finalProductIds)
            ->select('id','name','slug','image','item_code')
            ->paginate(10);
    }
}
