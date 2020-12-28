<?php

namespace App\Http\Controllers;

use App\User;
use App\Forgot;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register',"confirm","resend","forgotPassword",'validateToken','resetPassword']]);
        
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

        
         if (! $token = auth('api')->attempt($validator->validated()) ) {
             return response()->json(['error' => 'wrong password']);
         }else{

            $isUserConfirm = $user->isUserEmailConfirm($email);

            if(!$isUserConfirm){
                return response()->json(['error' => 'user not confirm']);
            }
             
            return $this->createNewToken($token);
         }

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

            $isUserNotConfirm = $user->isUserEmailConfirm($email);
            if(!$isUserNotConfirm){
                return response()->json(['error' => 'user not confirm']);
            }

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
        $validator = Validator::make($req->all(),[
            'email' => "required|email",
            'password' => "required"
        ]);

        $u = new User;
        $email = $req->email;
        $password = $req->password;
        $user = $u->getByEmail($email);
        $code =$req->codeConfirmUser;
        $isConfirm = $u->tryConfirUserAndResetCode($user->id,$code);

        if(!$isConfirm){
            return response()->json(['error' => "wrong code"]);
        }

        $token = auth('api')->attempt($validator->validated());

        return $this->createNewToken($token);
        
    }

    public function forgotPassword(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'email' => 'required|email'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $email = $req->email;
        $f = new Forgot;
        $u = new User;
        $user = $u->getByEmail($email);
        $token = $u->encryption();

        $data['userId'] =$user->id;
        $data['token'] = $token;
    

        $forgotInfo = $f->createForgotTokenLink($data);

        \Mail::to($email)->send(new \App\Mail\ResetPassword($data));

        return response()->json([
            'data' => "email send"
        ]);

        
    }

    public function validateToken(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'token' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $f = new Forgot;
        $token = $req->token;
        

        $isValidToken = $f->isValid($token);

      

        if(!$isValidToken){
            return response()->json([
                'error' => "token not valid"
            ]);
        }
        return response()->json([
            'success' => true,
            "data" => "token valid"
        ]);
    }

    public function resetPassword(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'password' => 'required|min:8',
            'token' =>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $f = new Forgot;
        $token = $req->token;

        $userToUpdt = $f->getUserByToken($token);

        $user = User::find($userToUpdt->userId);
 
        $user->password = bcrypt($req->password);
        $user->save();

        $f->deleteByToken($token);

        return response()->json([
            'success' => "reset success",
            'data' => $user
        ]);

        
    }


    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }
}
