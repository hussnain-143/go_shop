<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\CategoryAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponse;
class CategoryAttributeController extends Controller
{
    
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = CategoryAttribute::with('category', 'attribute')->get();
        $categories = Category::all();
        $attributes = Attribute::all();
        
        return view('admin.category.categoryAttribute',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  Validator::make($request->all(), [
            
            'category_id' => 'required|exists:categories,id',
            'attribute_id' =>  'required|exists:attributes,id',
        ]);

        if ($validatedData->fails()) {
            
            return $this->error($validatedData->errors()->first(),  400, []);
        }
    
       
    
        // Update or Create Home Banner
        $color = CategoryAttribute::updateOrCreate(
            ['id' => $request->id],  
            [
                'category_id' => $request->category_id, 
                'attribute_id' => $request->attribute_id,
            ]
        );
    
        return response()->json(['message' => 'Category & Attribute updated successfully'], 200);
    }
}

