<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Model\TMesure;
use Illuminate\Support\Facades\DB;
use Validator;

class MesureController extends Controller
{
  

    public function __construct()
    {
        
    }
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return response()->json(
            TMesure::all()
        );
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phraseMesure' =>  'required',
            "tDimensionId" => "required"
            
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        return  response()->json(
            TMesure::create($validator->validated())
            )    ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(
            TMesure::find($id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json(
            TMesure::update($request->all())
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TMesure::find($id)->delete();
    }
}
