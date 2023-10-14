@extends("dashboard")
 
@section("title")
    modifier cadeau
@endsection

@section("title_page")
   modifier cadeau
@endsection

@section("contenu")
<form class="mt-3" action="{{route('admin.cadeaux.update',$cadeau->id)}}" method="post">
    @csrf
    @method("put")
        <div class="d-flex gap-2">
         <div class="w-100">
            <label class="form-label" for="title">titre</label>
            <input value="{{$cadeau->title}}" name="title" id="title" class="form-control @error('title') is-invalid @enderror" type="text">
            @error("title")
                  <span class="text-danger mt-1">{{$message}}</span>                  
            @enderror
         </div>
         <div class="w-100">
            <label class="form-label" for="min_points">min points</label>
            <input value="{{$cadeau->min_points}}"  name="min_points" id="min_points" class="form-control @error('min_points') is-invalid @enderror" type="text">
            @error("min_points")
                  <span class="text-danger mt-1">{{$message}}</span>                  
            @enderror
         </div>
         <div class="w-100">
            <label class="form-label" for="max_points">max points</label>
            <input value="{{$cadeau->max_points}}"  name="max_points" id="max_points" class="form-control @error('max_points') is-invalid @enderror" type="text">
            @error("max_points")
                  <span class="text-danger mt-1">{{$message}}</span>                  
            @enderror
         </div>
        </div>
  
        
   
   <button class="btn btn-primary mt-2">ajouter</button>
</form>
@endsection
