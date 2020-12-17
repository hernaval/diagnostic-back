<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register',"confirm","resend","index"]]);
    }

    public function index(){
        
        return response()->json(auth()->user());
        
    }

    public function login(Request $req)
    {
        $input = $req->all();
        $validator = Validator::make($req->all(),[
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $user = new User;
        $email = $input['email'];
        $isUserExist = $user->isUserEmailExist($email);
        

        if(!$isUserExist){
            return response()->json(['error' => 'user not exist']);
        }

        $isUserConfirm = $user->isUserEmailConfirm($email);

        if(!$isUserConfirm){
            return response()->json(['error' => 'user not confirm']);
        }

        
         if (! $token = auth('api')->attempt($validator->validated()) ) {
             return response()->json(['error' => 'wrong password'], 401);
         }

         return $this->createNewToken($token);


    }

    public function register(Request $req)
    {
        //$input = $req->all();
        $validator = Validator::make($req->all(),[
            'nomUser' => 'required',
            'prenomUser' => 'required',
            'fonctionUser' => 'required',
            'organisationUser' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $email = $req->email;
        $user = new User;
        $isUserExist = $user->isUserEmailExist($email);

        if($isUserExist){
            return response()->json(['error' => 'user exist']);
        }

        $code = User::randomPass(6);

        $newUser = User::create(array_merge(
            $validator->validated(),
            [
                'password' => bcrypt($req->password),
                'codeConfirmUser' => $code
            ]
        ));

        $maildata["fullname"] =$req->prenomUser." ".$req->nomUser;
        $maildata["username"] = $req->email;
        $maildata["code"] = $code;

        \Mail::to($maildata["username"])->send(new \App\Mail\SendCode($maildata)); 

        return response()->json([
            'message' => "user registered",
            "data" => $newUser
        ]);

    }

    public function resend(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'email' => "required|email"
        ]);

        $u = new User;
        $email = $req->email;
        $user = $u->getByEmail($email);

        $newCode = User::randomPass(6);

        $maildata["fullname"] =$user->prenomUser." ".$user->nomUser;
        $maildata["username"] = $req->email;
        $maildata["code"] = $newCode;

        \Mail::to($maildata["username"])->send(new \App\Mail\SendCode($maildata));
        
        $user->codeConfirmUser = $newCode;
        $user->save();

        return response()->json(['message' => "code send"]);

    }

    public function confirm(Request $req)
    {
        
        $u = new User;
        $email = $req->email;
        $user = $u->getByEmail($email);
        $code =$req->codeConfirmUser;
        $isConfirm = $u->tryConfirUserAndResetCode($user->id,$code);

        if(!$isConfirm){
            return response()->json(['error' => "wrong code"]);
        }

        return response()->json(['message' => "can login"]);
        
    }


    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
