<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Model\TDimension;
use Illuminate\Support\Facades\DB;
use Validator;

class DimensionController extends Controller
{
  

    public function __construct()
    {
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return response()->json(
            TDimension::all()
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
            'nomDimension' =>  'required',
            "tQuestionnaireId" => "required"
            
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        return  response()->json(
            TDimension::create($validator->validated(),)
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
        //return the questionnaire and his mesures
        return response()->json(
            DB::table('TDimension')
       ->join('TMesure', 'TMesure.tDimensionId', '=', 'TDimension.id')
       ->where('TDimension.id', $id)
       ->get()
       
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
            TDimension::update($request->all())
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
        //delete mesure to dimension to questionnaire
        $dimensionToDelete = TDimension::find($id);

       $mesureToDelete = DB::table('TMesure')
        ->join('TDimension', 'TDimension.tMesureId', '=', 'TMesure.id')
        ->where('TDimension.id', $id)
        ->delete();
        $dimensionToDelete->delete();
        
    }
}
