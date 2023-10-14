<?php

namespace App\Http\Controllers\Partenaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function produits_list()
    {
        $produits = produit::where("id_partenaire",auth()->user()->id)->get();
        $produits_list = view("dashboard.partenaire.produits.components.list", compact("produits"));
        return $produits_list;
    }
    public function index()
    {
        $produits_list = $this->produits_list()->render();
        return view("dashboard.partenaire.produits.index", compact("produits_list"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.partenaire.produits.pages.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            "title" => "required",
            "prix"=>"required|numeric",
        ]);
        $produit = new produit();
        $produit->title = $request->title;
        $produit->id_partenaire = auth()->user()->id;
        $produit->status = "inactive";
        $produit->prix = $request->prix;
        if($request->commission){
            $produit->taux = $request->commission;
        }
        $produit->save();
        return redirect()->route("partenaire.produits.index")->with("message", "produit est ajouté avec succé");
    }

    /**
     * Display the specified resource.
     */
    public function destroy(string $id)
    {
        $produit = produit::where("id", $id)->first();
        if ($produit) {
            $produit->delete();
            return redirect()->route("partenaire.produits.index")->with("message", "produit est supprimé avec succé");
        } else {
            return redirect()->route("partenaire.produits.index");
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
        $produit = produit::where("id", $id)->first();
        if ($produit) {
            return view("dashboard.partenaire.produits.pages.edit", compact("produit"));
        } else {
            return redirect()->route("partenaire.produits.index");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            "title" => "required",
            "prix"=>"required|numeric",
        ]);
        $produit = produit::where("id", $id)->first();
        if ($produit) {
            $produit->title = $request->title;
            $produit->prix = $request->prix;
            if($request->commission){
                $produit->taux = $request->commission;
            }
            $produit->save();
            return redirect()->route("partenaire.produits.index")->with("message", "produit est modifié avec succé");
        } else {
            return redirect()->route("partenaire.produits.index");
        }
    }
       
}
