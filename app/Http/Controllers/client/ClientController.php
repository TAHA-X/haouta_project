<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cadeau;
use App\Models\User;
use App\Mail\SendCadeauEmail;
use Illuminate\Support\Facades\Mail;
use stdClass;

class ClientController extends Controller
{
    public function index(){
        $user = auth()->user();
        $cadeau = Cadeau::where("max_points","<=",(int)$user->points)->get();
        // return $cadeau;
         return view("dashboard.client.index",compact("cadeau"));
    }
    public function consommer(Request $request){
        $cadeau = Cadeau::where("id",$request->cadeau)->first();
         $user = User::where("id",auth()->user()->id)->first();
     
         $user->update([
            "points"=>$user->points-$cadeau->max_points
         ]);
         $cadeau->update([
             "counter"=>$cadeau->counter+1
         ]);
         $commande = new stdClass();
         $commande->fname = $user->fname;
         $commande->lname = $user->lname;
         $commande->phone = $user->phone;
         $commande->cadeau = $cadeau->title;  
         Mail::to("techchoual7@gmail.com")->send(new SendCadeauEmail($commande));

        //  $user->points = $user->points-$cadeau->max_points;
        
        //  $user->save();
        //  return view("dashboard.client.index",compact("cadeau"));
         return redirect()->route("client.index")->with("success","consommation avec succés");
    } 
}
