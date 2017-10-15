<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Log;

class AuthJWTController extends Controller {

    public function index(){
        return response()->json(array(
            'auth' => Auth::User(),
            'users' => User::all()
        ));
    }

    public function logout(){
        JWTAuth::unsetToken();
        
        return response()->json(array(
            'success' => true
        ));
    }

    public function authenticate(Request $request){
        $credentials = Input::only('email', 'password');

        try{

            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(array(
                    'error' => 'bad_credentials',
                ), 401);
            }

        }catch(JWTException $e){
            return response()->json(array(
                'error' => 'token_creation_error',
            ), 500);
        }

        return response()->json(compact('token'));
    }

    public function createRole(Request $request){
        $role = new Role();
        $role->name = $request->input('name');
        $role->save();

        return response()->json('created');
    }

    public function createPermission(Request $request){
        $viewUsers = new Permission();
        $viewUsers->name = $request->input('name');
        $viewUsers->save();

        return response()->json('created');
    }

    public function attachRole(Request $request){
        $role = Role::where('name', '=', $request->input('role'))->first();
        $user = User::where('email', '=', $request->input('email'))->first();
        $user->roles()->attach($role->id);
        
        return response()->json('attached');
    }

    public function attachPermission(Request $request){
        $role = Role::where('name', '=', $request->input('role'))->first();
        $permission = Permission::where('name', '=', $request->input('permission'))->first();

        $role->attachPermission($permission);

        return response()->json('attached');
    }

}