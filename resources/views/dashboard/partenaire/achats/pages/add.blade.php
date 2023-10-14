@extends("dashboard")
 
@section("title")
    ajouter achat
@endsection

@section("title_page")
   ajouter achat
@endsection

@section("contenu")
<form class="mt-3" action="{{route('partenaire.achats.store')}}" method="post">
    @csrf
   <div class="d-flex gap-2">
        <div class="w-50">
              <label class="form-label" for="client_id">client</label>
              <select name="client_id"  class="form-control @error('client_id') is-invalid @enderror"  id="client_id">
                     @foreach ($clients as $client)
                          <option value="{{$client->id}}">{{$client->fname}} {{$client->fname}} | {{$client->phone}}</option>                          
                     @endforeach
              </select>
              @error("client_id")
                    <span class="text-danger mt-1">{{$message}}</span>                  
              @enderror
        </div>
        <div class="w-50">
               <label class="form-label" for="produit_id">produit</label>
               <select name="produit_id"  class="form-control @error('produit_id') is-invalid @enderror"  id="produit_id">
                    @foreach ($produits as $produit)
                         <option value="{{$produit->id}}">{{$produit->title}} | {{$produit->prix}}</option>                          
                    @endforeach
               </select>
               @error("client_id")
                    <span class="text-danger mt-1">{{$message}}</span>                  
               @enderror
        </div>
   </div>


   <button class="btn btn-primary mt-2">ajouter</button>
</form> 
@endsection



