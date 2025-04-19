<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponse;
class TaxesController extends Controller
{
    
    
        use ApiResponse;
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $items = Tax::all();
            
            return view('admin.taxes.taxes',get_defined_vars());
        }
    
        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $validatedData =  Validator::make($request->all(), [
                'tax' => 'required|string',
            ]);
    
            if ($validatedData->fails()) {
                
                return $this->error($validatedData->errors()->first(),  400, []);
            }
        
            // Update or Create Home Banner
            $color = Tax::updateOrCreate(
                ['id' => $request->id],  
                [
                    'tax' => $request->tax, 
                ]
            );
        
            return response()->json(['message' => 'Tax updated successfully'], 200);
        }
    }
    

