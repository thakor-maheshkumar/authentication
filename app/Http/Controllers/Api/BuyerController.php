<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Validator;
use App\Models\User;
use Hash;

class BuyerController extends Controller
{
    public function latest()
    {
        $store=Store::latest('id')->first();
        return response()->json(['Latest Store'=>$store]);
    }
    public function storeDetail()
    {
        $store=Store::orderBy('id','DESC')->get();
        return response()->json(['Store list'=>$store]);
    }
    public function profileUpdate(Request $request){
        $req=Validator::make($request->all(),[
            'name'=>'required|string|between:2,100',
            'email'=>'required|string|email|max:100|unique:users,email,'.$request->id,
            'password'=>'required|string|confirmed|min:6',
            'role'=>'required|string',
        ]);

        if($req->fails()){
            return response()->json($req->errors()->toJson(),400);
        }
        $user=User::find($request->id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->role=$request->role;
        $user->update();
        return response()->json(['success'=>'User record updated successfully']);
    }
}
