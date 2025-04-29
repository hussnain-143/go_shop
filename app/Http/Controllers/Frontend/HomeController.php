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


        return $this->success($data, 'data retrieved successfully', 200, []);
    }

    public function HomeCategoryApi(){
        $data = Category::with('subCategory')->where('parent_category_id', null)->get();
        return $this->success($data, 'data retrieved successfully', 200, []);
    }

    public function CategoryApi($slug = null){

        $category = Category::where('slug', $slug)->first();
        if( isset($category->id) ){
            $product = Product::with('productAttribute')->where('category_id', $category->id)->select('id','name','slug', 'image', 'item_code')->paginate(10);

        if ($category->parent_category_id == null || $category->parent_category_id == ''){
            $cat = Category::where('parent_category_id', $category->id)->get();
        } 
        else{
            $cat = Category::where('parent_category_id', $category->parent_category_id)->where('id', '!=', $category->id)->get();
        }
    } else{

        $category = Category::first();

        $product = Product::with('productAttribute')->where('category_id', $category->id)->select('id','name','slug', 'image', 'item_code')->paginate(10);

        if ($category->parent_category_id == null || $category->parent_category_id == ''){
            $cat = Category::where('parent_category_id', $category->id)->get();
        } 
        else{
            $cat = Category::where('parent_category_id', $category->parent_category_id)->where('id', '!=', $category->id)->get();
        }

        
    }


    $prices = ProductAttr::selectRaw('MIN(CAST(price AS DECIMAL)) as lowPrice, MAX(CAST(price AS DECIMAL)) as highPrice')->first();
    $lowPrice = $prices->lowPrice;
    $highPrice = $prices->highPrice;
    $brands = Brands::get();
    $size = Size::get();
    $color = Color::get();
    $attributes = CategoryAttribute::where('category_id', $category->id)->with('attribute')->get();

    return $this->success( get_defined_vars(), 'data retrieved successfully', 200, []);
}

}