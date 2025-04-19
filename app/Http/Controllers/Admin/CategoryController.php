<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponse;
class CategoryController extends Controller
{
    
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Category::with('parentCategory')->get();
        
        return view('admin.category.category',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string',
            'image' => 'nullable|mimes:jpeg,png,jpg|max:5120'
        ]);

        if ($validatedData->fails()) {
            
            return $this->error($validatedData->errors()->first(),  400, []);
        }
    
        // Retrieve existing banner if updating
        $banner = Category::find($request->id);
        
        // Handle Image Upload
        $imagePath = $banner ? $banner->image : null;
    
        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.png';
            $request->image->move(public_path('/category'), $imageName);
            $imagePath = 'category/' . $imageName;
        }
    
        // Update or Create Home Banner
        $data = [
            'name' => $request->name, 
            'slug' => $request->slug,
            'image' => $imagePath,
        ];
        
        // Conditionally add the 'parent_category_id'
        $data['parent_category_id'] = $request->parent_category_id ?: null;
        
        $banner = Category::updateOrCreate(
            ['id' => $request->id],  
            $data
        );
    
        return response()->json(['message' => 'Category updated successfully'], 200);
    }
}

