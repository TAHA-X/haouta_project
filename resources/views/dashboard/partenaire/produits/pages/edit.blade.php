@extends('dashboard')

@section('title')
    modifier produit
@endsection

@section('title_page')
    modifier produit
@endsection

@section('contenu')
    <form class="mt-3" action="{{ route('partenaire.produits.update',$produit->id) }}" method="post">
        @csrf
        @method("put")
        <div class="d-flex gap-2">
            <div class="w-100">
                <label class="form-label" for="title">title</label>
                <input  name="title" class="form-control" value="{{$produit->title}}" @error('title') is-invalid @enderror type="text">
                @error('title')
                    <span class="mt-2 text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-100">
                  <label class="form-label" for="prix">prix</label>
                  <input name="prix" value="{{$produit->prix}}" class="form-control" @error('prix') is-invalid @enderror type="number">
                  @error('prix')
                      <span class="mt-2 text-danger">{{ $message }}</span>
                  @enderror
              </div>
    
            <div  id="div_commission_variable" class="w-100">
                <label class="form-label" for="commission">commission variable</label>
                <input name="commission" value="{{$produit->taux}}" class="form-control" @error('commission') is-invalid @enderror type="number">
                @error('commission')
                    <span class="mt-2 text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <button class="btn btn-primary mt-2">modifier</button>
    </form>
@endsection


@section("script")

@endsection