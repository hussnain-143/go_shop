<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Category;
use App\Models\HomeBanner;
use App\Models\Product;
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
}
