<?php

namespace App\Http\Controllers\Partenaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class ClientController extends Controller
{
      /**
     * Display a listing of the resource.
     */

     public function users_list(){
        $users = User::where("partenaire_id",auth()->user()->id)->get();
        $users_list = view("dashboard.partenaire.users.components.list",compact("users"));
        return $users_list;
    }
    public function index()
    {
        $users_list = $this->users_list()->render();
        return view("dashboard.partenaire.users.index",compact("users_list"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.partenaire.users.pages.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "fname"=>"required",
            "lname"=>"required",
            "email"=>"required|email|unique:users",
            "phone"=>"required|numeric",

        ]);
         
        $user = new User();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->password = Hash::make("12345678");
        $user->phone = $request->phone;
        $user->partenaire_id = auth()->user()->id;
        $user->level_id = 4;
        $user->save();
        return redirect()->route("partenaire.users.index")->with("message","user est ajouté avec succé");
    }

    /**
     * Display the specified resource.
     */
    public function destroy(string $id)
    {
        $user = User::where("id",$id)->first();
        if($user){
            $user->delete(); 
            return redirect()->route("partenaire.users.index")->with("message","user est supprimé avec succé");
        }
        else{
            return redirect()->route("partenaire.users.index");
        }
    }

    public function show(string $id)
    {
     dd("show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where("id",$id)->first();
        if($user){
            return view("dashboard.partenaire.users.pages.edit",compact("user"));
        }
        else{
            return redirect()->route("partenaire.users.index");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            "fname"=>"required",
            "lname"=>"required",
            "email"=>["email","required",Rule::unique(User::class)->ignore($id)],
            "phone"=>"required|numeric",
        ]);
        $user = User::where("id",$id)->first();
        if($user){
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->password = Hash::make("12345678");
            $user->phone = $request->phone;
            $user->partenaire_id = auth()->user()->id;
            $user->save();
            return redirect()->route("partenaire.users.index")->with("message","user est modifié avec succé");
        }
        else{
            return redirect()->route("partenaire.users.index");
        }
    }

    

    /**
     * Remove the specified resource from storage.
     */
}
