<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponse;

class AttributeController extends Controller
{
    
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Attribute::all();
        
        return view('admin.attributes.attribute',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  Validator::make($request->all(), [
            
            'name' => 'required|string',
            'slug' =>  'required|string'
        ]);

        if ($validatedData->fails()) {
            
            return $this->error($validatedData->errors()->first(),  400, []);
        }
    
        // Update or Create Home Banner
        $color = Attribute::updateOrCreate(
            ['id' => $request->id],  
            [
                'name' => $request->name, 
                'slug' => $request->slug,
            ]
        );
    
        return response()->json(['message' => 'Attribute updated successfully'], 200);
    }
}

