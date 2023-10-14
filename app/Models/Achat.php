<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Produit;

class Achat extends Model
{
    use HasFactory;
    public function client(){
        return $this->belongsTo(User::class);
    }
    public function produit(){
        return $this->belongsTo(Produit::class);
    }
}
