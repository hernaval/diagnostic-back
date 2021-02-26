<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\User;
use Illuminate\Support\Facades\Storage;
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
        $userToUpdate = auth('api')->user();

        $userToUpdate->update($req->all());
        
        $userToUpdate->telephoneUser = $req->codeUser."".$req->numeroUser;
        $userToUpdate->save();

        return response()->json([
            'data' => $userToUpdate
        ]);
    }

    public function changeAvatar(Request $req)
    {
        $userToUpdate = auth('api')->user();

        $input = $req->all();

            if(isset($input['avatar']) && $input['avatar']->isFile()){
                $posterPath = Storage::disk('s3')->put('images', $input["avatar"]);
                Storage::disk('s3')->setVisibility($posterPath, 'public');

                $userToUpdate->avatar = Storage::disk('s3')->url($posterPath);
                $userToUpdate->save();

                return response()->json(
                    ['data' => $userToUpdate]
                );
            }else{
                return response()->json(
                    ['error' => "error when upload file or missing"]
                );
            }

    }

    public function changePassword(Request $req)
    {
         $validator =  Validator::make($req->all(),[
            'password' => 'required',
            'newPassword' =>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        
        $userToUpdate = auth('api')->user();

        if (! $token = auth('api')->attempt([
            'password' => $req->password,
            'email' => $userToUpdate->email
        ]) ) {
            return response()->json(['error' => 'wrong password']);
        }

            if($req->password == $req->newPassword){
                return response()->json(['error' => 'need new password']);

            }

            $userToUpdate->password = bcrypt($req->newPassword);
            $userToUpdate->save();

        

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
        $userToDelete->delete();

        auth("api")->invalidate(true);

        return response()->json([
            'data' => "user deleted",
        ]);
        
    }
}
