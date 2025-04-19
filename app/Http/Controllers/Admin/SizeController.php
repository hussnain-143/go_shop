<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponse;

class SizeController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Size::all();

        return view('admin.manageSize',get_defined_vars());
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  Validator::make($request->all(), [
            'text' => 'string',
        ]);

        if ($validatedData->fails()) {
            
            return $this->error($validatedData->errors()->first(),  400, []);
        }
    
        // Update or Create Home Banner
        $size = Size::updateOrCreate(
            ['id' => $request->id],  
            [
                'text' => $request->text, 
            ]
        );
    
        return response()->json(['message' => 'Size updated successfully'], 200);
    }
}
