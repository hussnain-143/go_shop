<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponse;

class ColorController extends Controller
{
    
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Color::all();
        
        return view('admin.manageColor',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  Validator::make($request->all(), [
            
            'text' => 'required|string',
            'value' =>  'required|string'
        ]);

        if ($validatedData->fails()) {
            
            return $this->error($validatedData->errors()->first(),  400, []);
        }
    
       
    
        // Update or Create Home Banner
        $color = Color::updateOrCreate(
            ['id' => $request->id],  
            [
                'text' => $request->text, 
                'value' => $request->value,
            ]
        );
    
        return response()->json(['message' => 'Color updated successfully'], 200);
    }
}
