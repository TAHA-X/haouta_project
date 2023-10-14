<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cadeau;

class CadeauController extends Controller
{
    public function cadeaux_list()
    {
        $cadeaux = cadeau::all();
        $cadeaux_list = view("dashboard.admin.cadeaux.components.list", compact("cadeaux"));
        return $cadeaux_list;
    }
    public function index()
    {
        $cadeaux_list = $this->cadeaux_list()->render();
        return view("dashboard.admin.cadeaux.index", compact("cadeaux_list"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cadeaux = cadeau::all();
        return view("dashboard.admin.cadeaux.pages.add",compact("cadeaux"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            "title" => "required",
            "max_points"=>"numeric|required",
        ]);
        $cadeau = new cadeau();
        $cadeau->title = $request->title;
        $cadeau->max_points = $request->max_points;
        $cadeau->save();
        return redirect()->route("admin.cadeaux.index")->with("message", "cadeau est ajouté avec succé");
    }

    /**
     * Display the specified resource.
     */
    public function destroy(string $id)
    {
        $cadeau = cadeau::where("id", $id)->first();
        if ($cadeau) {
            $cadeau->delete();
            return redirect()->route("admin.cadeaux.index")->with("message", "cadeau est supprimé avec succé");
        } else {
            return redirect()->route("admin.cadeaux.index");
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
        $cadeau = cadeau::where("id", $id)->first();
        if ($cadeau) {
            return view("dashboard.admin.cadeaux.pages.edit", compact("cadeau"));
        } else {
            return redirect()->route("admin.cadeaux.index");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            "title" => "required",
            "max_points"=>"numeric|required",
        ]);


        $cadeau = cadeau::where("id", $id)->first();
        if ($cadeau) {
            $cadeau->title = $request->title;
            $cadeau->max_points = $request->max_points;
            $cadeau->save();
            return redirect()->route("admin.cadeaux.index")->with("message", "cadeau est modifié avec succé");
        } else {
            return redirect()->route("admin.cadeaux.index");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
}
