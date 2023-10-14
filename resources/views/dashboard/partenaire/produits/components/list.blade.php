
@foreach ($produits as $produit)
    <tr>
        <td>{{ $produit->title }}</td>
        <td>{{ $produit->prix }}</td>
      
        <td>
            <div style="display:flex; flex-direction:column; justify-content:center; gap:10px;">
                @if($produit->partenaire->contrat->type=="0")
                   <div class="badge badge-info">abonnement</div> 
                   <div class="badge badge-warning">{{$produit->partenaire->contrat->periode}} mois | {{$produit->partenaire->contrat->montant}} dh</div>
                @elseif($produit->partenaire->contrat->type=="1")
                   <div class="badge badge-info">commission</div> 
                   <div class="badge badge-warning">{{$produit->partenaire->contrat->commission}} %</div>
                @else
                    <div class="badge badge-secondary"> {{ $produit->taux }} %</div> 
                @endif
            </div>
        </td>
        <td>
            @if($produit->status=="active")
              <div class="badge badge-success">active</div>    
            @else
              <div class="badge badge-danger">inactive</div>  
            @endif
        </td>


        <td>
            <a class="btn btn-danger" onclick="return confirm('voulez vous vraiment supprimer ce produit ?')" href="{{route('partenaire.produits.delete',$produit->id)}}"><i class="bi bi-trash3-fill"></i></a>
            <a class="btn btn-primary"  href="{{route('partenaire.produits.edit',$produit->id)}}"><i class="bi bi-pen"></i></a>
        </td> 
    </tr>
@endforeach
