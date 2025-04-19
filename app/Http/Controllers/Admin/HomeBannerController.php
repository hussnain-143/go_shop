<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponse;

class HomeBannerController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = HomeBanner::all();
        return view('admin.homeBanner',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  Validator::make($request->all(), [
            'text' => 'required|string',
            'link' => 'required|string',
            'image' => 'nullable|mimes:jpeg,png,jpg|max:5120'
        ]);

        if ($validatedData->fails()) {
            
            return $this->error($validatedData->errors()->first(),  400, []);
        }
    
        // Retrieve existing banner if updating
        $banner = HomeBanner::find($request->id);
        
        // Handle Image Upload
        $imagePath = $banner ? $banner->image : null;
    
        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.png';
            $request->image->move(public_path('/home-banners'), $imageName);
            $imagePath = 'home-banners/' . $imageName;
        }
    
        // Update or Create Home Banner
        $banner = HomeBanner::updateOrCreate(
            ['id' => $request->id],  
            [
                'text' => $request->text, 
                'link' => $request->link,
                'image' => $imagePath,
            ]
        );
    
        return response()->json(['message' => 'Home Banner updated successfully'], 200);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
