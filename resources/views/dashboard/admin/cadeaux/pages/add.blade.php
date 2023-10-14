@extends("dashboard")
 
@section("title")
    ajouter cadeau
@endsection

@section("title_page")
   ajouter cadeau
@endsection

@section("contenu")
<form class="mt-3" action="{{route('admin.cadeaux.store')}}" method="post">
    @csrf
  
        <div class="d-flex gap-2">
         <div class="w-100">
            <label class="form-label" for="title">titre</label>
            <input name="title" id="title" class="form-control @error('title') is-invalid @enderror" type="text">
            @error("title")
                  <span class="text-danger mt-1">{{$message}}</span>                  
            @enderror
         </div>
         {{-- <div class="w-100">
            <label class="form-label" for="min_points">min points</label>
            <input name="min_points" id="min_points" class="form-control @error('min_points') is-invalid @enderror" type="text">
            @error("min_points")
                  <span class="text-danger mt-1">{{$message}}</span>                  
            @enderror
         </div> --}}
         <div class="w-100">
            <label class="form-label" for="max_points">points</label>
            <input name="max_points" id="max_points" class="form-control @error('max_points') is-invalid @enderror" type="text">
            @error("max_points")
                  <span class="text-danger mt-1">{{$message}}</span>                  
            @enderror
         </div>
        </div>
  
        
   
   <button class="btn btn-primary mt-2">ajouter</button>
</form>
@endsection
