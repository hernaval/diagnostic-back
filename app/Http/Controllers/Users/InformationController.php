<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\User;

use Validator;
class InformationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 0)
    {
        return auth()->user();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id =0)
    {
        // $validator =  Validator::make($req->all(),[
        //     'nomUser' => 'required',
        //     'prenomUser' => 'required',
        //     'fonctionUser' => 'required',
        //     'organisationUser' => 'required',
        //     'email' => 'required|email',
        // ]);

        // if($validator->fails()){
        //     return response()->json($validator->errors(), 422);
        // }

        $userToUpdate = auth('api')->user();
        $userToUpdate->update($req->all());

        return response()->json([
            'data' => $userToUpdate
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = 0)
    {
        $token = request()->header('Authorization');
        $userToDelete = auth('api')->user();
        //$userToDelete->delete();

        auth("api")->invalidate(true);

        return response()->json([
            'data' => "user deleted",
        ]);
        
    }
}
