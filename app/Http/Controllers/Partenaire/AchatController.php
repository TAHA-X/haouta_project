<?php

namespace App\Http\Controllers\Partenaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achat;
use App\Models\Produit;
use App\Models\User;

class AchatController extends Controller
{
    public function achats_list(){
        $produits = Produit::where("id",auth()->user()->id)->get();
        $clients = User::where("partenaire_id",auth()->user()->id)->get();
        $achats = Achat::where("partenaire_id",auth()->user()->id)->get();
        $achats_list = view("dashboard.partenaire.achats.components.list",compact("achats","produits","clients"));
        return $achats_list;
    }
    public function index()
    {
        $achats_list = $this->achats_list()->render();
        return view("dashboard.partenaire.achats.index",compact("achats_list"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = User::where("partenaire_id",auth()->user()->id)->get();
        $produits = Produit::where("id_partenaire",auth()->user()->id)->where("status","active")->get();
        return view("dashboard.partenaire.achats.pages.add",compact("clients","produits"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "client_id"=>"required|numeric",
            "produit_id"=>"required|numeric",
        ]);
         
        $achat = new Achat();
        $achat->produit_id = $request->produit_id;
        $achat->client_id = $request->client_id;
        $achat->partenaire_id = auth()->user()->id;
        $achat->save();
        $type_contrat = User::where("id",auth()->user()->id)->first()->contrat->type;
        $valueDH = User::where("id",auth()->user()->id)->first()->point->valueDH;
        $valuePoint = User::where("id",auth()->user()->id)->first()->point->valuePoint;

        $produit = Produit::where("id",$request->produit_id)->first();
       // dd($type_contrat);
       if($type_contrat==0){
            // $contrat = User::where("id",auth()->user()->id)->first()->contrat;
            // $commission = ($contrat->abonnement*100)/;
            $x = ($produit->prix*$produit->partenaire->contrat->montant)/100;
            $points = ($x*$valuePoint)/$valueDH;
            $client = User::where("id",$request->client_id)->first();
            // dd($produit->prix);
            $points = $client->points+$points;
            $client->update([
                "points"=>$points
            ]);
       }
       else if($type_contrat==1){
              $commission = $produit->partenaire->contrat->commission;
              $x = ($produit->prix*$commission)/100;
              $points = ($x*$valuePoint)/$valueDH;
              $client = User::where("id",$request->client_id)->first();
              $client->update([
                  "points"=>$client->points+$points
              ]);
       }
       else{
               $commission = $produit->taux;
              $x = ($produit->prix*$commission)/100;
              $points = ($x*$valuePoint)/$valueDH;
              $client = User::where("id",$request->client_id)->first();
              $client->update([
                  "points"=>$client->points+$points
              ]);
       }
     return redirect()->route("partenaire.achats.index")->with("message","achat est ajouté avec succé");
    }

    /**
     * Display the specified resource.
     */
    public function destroy($id)
    {
        $achat = Achat::where("id",$id)->first();
        if($achat){
            $achat->delete(); 
            return redirect()->route("partenaire.achats.index")->with("message","achat est supprimé avec succé");
        }
        else{
            return redirect()->route("partenaire.achats.index");
        }
    }


    

}
