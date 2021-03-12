<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Model\TQuestionnaire;
use Illuminate\Support\Facades\DB;
use Validator;


class QuestionnaireController extends Controller
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
            TQuestionnaire::all()
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
            'nomQuestionnaire' => 'required',
            'jsonQuestionnaire' => "required"
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        return  response()->json(
            TQuestionnaire::create($validator->validated())
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
             DB::table('TQuestionnaire')
        ->join('TDimension', 'TDimension.tQuestionnaireId', '=', 'TQuestionnaire.id')
        ->where('TQuestionnaire.id', $id)
        ->get()
        
        );
    }

    public function get($titre)
    {
        $qTitre = TQuestionnaire::where(['nomQuestionnaire' => $titre])->first();
       /* return response()->json(
            DB::table('TQuestionnaire')
       ->join('TDimension', 'TDimension.tQuestionnaireId', '=', 'TQuestionnaire.id')
       ->where('TQuestionnaire.nomQuestionnaire', $titre)
       ->get() 
        );*/

        return response()->json($qTitre);

        
       
       
       
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
        $qTUpdat = TQuestionnaire::find($id);

        
        return response()->json(
            $qTUpdat->update($request->all())
        );
    }//

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete mesure to dimension to questionnaire
        $questionnaireToDelete = TQuestionnaire::find($id);

       $dimensionToDelete = DB::table('TDimension')
        ->join('TQuestionnaire', 'TDimension.tQuestionnaireId', '=', 'TQuestionnaire.id')
        ->where('TQuestionnaire.id', $id)
        ->get();

        //delete from tRestitution
        foreach ($dimensionToDelete as $dimension) {
            $mesureToDelete = DB::table('TMesure')
            ->join('TDimension', 'TDimension.id', '=', 'TMesure.tDimensionId')
            ->where('TDimension.id', $dimension->id)
            ->delete();
            # code...
        }

        $dimensionToDelete->delete();
        $questionnaireToDelete->delete();
    }
    
    public function deleteByName($titre)
    {
        //delete mesure to dimension to questionnaire
        $questionnaireToDelete = TQuestionnaire::where(['nomQuestionnaire' =>$titre])->delete();

       /*$dimensionToDelete = DB::table('TDimension')
        ->join('TQuestionnaire', 'TDimension.tQuestionnaireId', '=', 'TQuestionnaire.id')
        ->where('TQuestionnaire.nomQuestionnaire', $questionnaireToDelete->id)
        ->get();

        //delete from tRestitution
        foreach ($dimensionToDelete as $dimension) {
            $mesureToDelete = DB::table('TMesure')
            ->join('TDimension', 'TDimension.id', '=', 'TMesure.tDimensionId')
            ->where('TDimension.id', $dimension->id)
            ->delete();
            # code...
        }

        $dimensionToDelete->delete();
        $questionnaireToDelete->delete(); */

        return response()->json("ok");
    }
}
