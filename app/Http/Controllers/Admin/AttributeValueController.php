<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponse;

class AttributeValueController extends Controller
{
    
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = AttributeValue::with('attribute')->get();
        $attributes = Attribute::all();
        
        return view('admin.attributes.attributeValue',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  Validator::make($request->all(), [

            'attribute_id' => 'required|exists:attributes,id',
            'value' =>  'required|string'
        ]);

        if ($validatedData->fails()) {
            
            return $this->error($validatedData->errors()->first(),  400, []);
        }
    
       
    
        // Update or Create Home Banner
        $color = AttributeValue::updateOrCreate(
            ['id' => $request->id],  
            [
                'attribute_id' => $request->attribute_id, 
                'value' => $request->value,
            ]
        );
    
        return response()->json(['message' => 'Attribute value updated successfully'], 200);
    }
}

