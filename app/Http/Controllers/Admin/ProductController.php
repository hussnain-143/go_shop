<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttr;
use App\Models\ProductAttribute;
use App\Models\ProductAttrImage;
use App\Models\Size;
use App\Models\Tax;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponse;

class ProductController extends Controller
{
    use ApiResponse;

    /**
     *  Return Views Files
     */

    /**
     * list all products
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.product.listProduct', get_defined_vars());
    }
    public function add_product($id = 0)
    {


   
        
        if ($id == 0) {
            $product = new Product();
            $category = Category::all();
            $color = Color::all();
            $tax = Tax::all();
            $size = Size::all();
            $brand = Brands::all();
            $product_attr = new ProductAttr();
            $product_attr_images = new ProductAttrImage();
    

           
        } else {

            $product['id'] = $id;
            $category = Category::all();
            $color = Color::all();
            $tax = Tax::all();
            $size = Size::all();
            $brand = Brands::all();
            $product_attr = new ProductAttr();
            $product_attr_images = new ProductAttrImage();
    

            $validation = Validator::make($product, [
                'id' => 'required|exists:products,id',
            ]);
            if ($validation->fails()) {

            } else {
                $product = Product::where('id', $id)->with('attribute', 'productAttribute')->first();
            }
        }


//         echo '<pre>';
// print_r($product->toArray());
// echo '</pre>';
        return view('admin.product.manageProduct', get_defined_vars());
    }

    /**
     * add or update the product
     */
    public function store(Request $request)
    
    {      

        $rules = [
            'product_name' => 'required|string',
            'product_slug' => 'required|string',
            'description' => 'string',
            'product_itemcode' => 'required|string',
            'product_keywords' => 'required|string',
            'category' => 'required|exists:categories,id',
            'brand' => 'required|exists:brands,id',
            'tax' => 'required|exists:taxes,id',
            'color' => 'exists:colors,id',
            'size' => 'exists:sizes,id',
            'attribute_value_id' => 'exists:attribute_values,id'
        ];

        // Add image validation only if a new file is uploaded
        if ($request->hasFile('product_image')) {
            $rules['product_image'] = 'mimes:jpeg,png,jpg|max:5120';
        }

        $validatedData = Validator::make($request->all(), $rules);

        if ($validatedData->fails()) {
            return $this->error($validatedData->errors()->first(), 400, []);
        }

        // Retrieve existing banner if updating
        $product = Product::find($request->id);

        // Handle Image Upload
        $imagePath = $product ? $product->image : null;

        if ($request->hasFile('product_image')) {
            $imageName = uniqid() . '.png';
            $request->product_image->move(public_path('/product'), $imageName);
            $imagePath = 'product/' . $imageName;
        }

        // Update or Create Product
        $product = Product::updateOrCreate(

            ['id' => $request->id],
            [
                'name' => $request->product_name,
                'slug' => $request->product_slug,
                'image' => $imagePath,
                'description' => $request->description,
                'item_code' => $request->product_itemcode,
                'keywords' => $request->product_keywords,
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'tax_id' => $request->tax
            ]
        );

        $product = $product->id;

        ProductAttribute::where('product_id', $product)->delete();

        foreach ($request->attribute as $key => $value) {
            ProductAttribute::updateOrCreate([
                'product_id' => $product,
                'category_id' => $request->category,
                'attribute_value_id' => $value,
            ], [
                'product_id' => $product,
                'category_id' => $request->category,
                'attribute_value_id' => $value,
            ]);
        }
    


        $attrimage = [];
        if (!empty($request->imageValue)){
            foreach ($request->imageValue as $key => $val) {
                array_push($attrimage, $val);
            }
        }

        //  Product Attr
        if(!empty($request->sku)){
            foreach ($request->sku as $key => $val) {

                $product_attr = ProductAttr::updateOrCreate([
                    'id' => $request->product_attr_id[$key] ?? 0,
                ], [
                    'product_id' => $product,
                    'color_id' => $request->color[$key],
                    'size_id' => $request->size[$key],
                    'sku' => $request->sku[$key],
                    'impr' => $request->mrp[$key],
                    'price' => $request->price[$key],
                    'qty' => $request->qty[$key],
                    'length' => $request->length[$key],
                    'breadth' => $request->breadth[$key],
                    'height' => $request->height[$key],
                    'width' => $request->width[$key],

                ]);


                $product_attr = $product_attr->id;
                
                $img_val = 'attr_image_' . ($request->imageValue[$key] ?? null);

                if ($request->has($img_val)) {
                    
                    ProductAttrImage::where([
                        'product_id' => $product,
                        'product_attr_id' => $product_attr,
                    ])->delete();
                
                    foreach ($request->$img_val as $img) {
                        $imageName = uniqid() . '.png';
                        $img->move(public_path('/product/productAttr'), $imageName);
                        $imagePath = 'product/productAttr/' . $imageName;
                
                        ProductAttrImage::create([
                            'product_id' => $product,
                            'product_attr_id' => $product_attr,
                            'image_path' => $imagePath
                        ]);
                    }
                }


            }
            return response()->json(['message' => 'Product updated successfully'], 200);
        }else{
            return response()->json(['message' => 'Please set the Product Attributes '], 400);
        }

    }

    public function getAttribute(Request $request)
    {

        $cat = $request->cat;
        $data = CategoryAttribute::where('category_id', $cat)->with('attribute', 'values')->get();

        return $this->success(['data' => $data], 'Successfully Update');
    }

    public function removeAttribute(Request $request){

        $delete = DB::table($request->table)->where('id', $request->id)->delete();

        if($delete){
            return response()->json(['message' => 'Item deleted successfully'],);
        }
        else{
            return response()->json(['message' => 'Item not deleted'], 400);
        }
    }


}
