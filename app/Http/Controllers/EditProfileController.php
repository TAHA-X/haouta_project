<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;




class EditProfileController extends Controller
{
    public function update(Request $request,$id){
         $this->validate($request,[
            "fname"=>"required",
            "lname"=>"required",
            "phone"=>"required|digits:9"
         ]);
         $user = User::where("id",$id)->first();
         $user->fname = $request->fname;
         $user->lname = $request->lname;
         $user->phone = $request->phone;
         if($user->password!=""){
            $user->password = Hash::make($request->password);
         }
         $user->save();
         $user = $request->user();

         Auth::logout();
 

 
         return Redirect::to('/');
    }
}
