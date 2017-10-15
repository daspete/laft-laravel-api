<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use JWTAuthException;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\User;

class ApiController extends Controller {

    public function users(){
        return response()->json(User::all());
    }

    // public function __construct(){
    //     $this->user = new User;
    // }

    // public function login(Request $request){
    //     $credentials = $request->only('email', 'password');
    //     $token = null;

    //     try{

    //         if(!$token = JWTAuth::attempt($credentials)){
    //             return response()->json(array(
    //                 'response' => 'error',
    //                 'message' => 'invalid_email_or_password',
    //             ), 401);
    //         }

    //     }catch(JWTAtuthException $e){
    //         return response()->json(array(
    //             'response' => 'error',
    //             'message' => 'failed_to_create_token',
    //         ), 500);
    //     }

    //     return response()->json(array(
    //         'response' => 'success',
    //         'result' => array(
    //             'token' => $token
    //         ),
    //     ));
    // }

    // public function getAuthUser(Request $request){
    //     $user = JWTAuth::toUser($request->token);

    //     return response()->json(array(
    //         'result' => $user
    //     ));
    // }

}