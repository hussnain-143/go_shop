<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponse;
class BrandsController extends Controller
{
    
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Brands::all();
        
        return view('admin.brands.brand',get_defined_vars());
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
        $banner = Brands::find($request->id);
        
        // Handle Image Upload
        $imagePath = $banner ? $banner->image : null;
    
        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.png';
            $request->image->move(public_path('/brands'), $imageName);
            $imagePath = 'brands/' . $imageName;
        }
    
        // Update or Create Home Banner
        $banner = Brands::updateOrCreate(
            ['id' => $request->id],  
            [
                'name' => $request->name, 
                'slug' => $request->slug,
                'image' => $imagePath,
            ]
        );
    
        return response()->json(['message' => 'Brand updated successfully'], 200);
    }
}

