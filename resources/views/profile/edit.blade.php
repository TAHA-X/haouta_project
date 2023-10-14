{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends("dashboard")
 
@section("title")
    modifier profile
@endsection

@section("title_page")
    modifier profile
@endsection

@section("contenu")
<form class="mt-3" action="{{route('edit_profile.update',auth()->user()->id)}}" method="post">
    @csrf
    @method("put")
   <div class="d-flex gap-2">
        <div class="w-50">
              <label class="form-label" for="prenom">prénom</label>
              <input value="{{auth()->user()->fname}}" name="fname" id="prenom" class="form-control @error('fname') is-invalid @enderror" type="text">
              @error("fname")
                    <span class="text-danger mt-1">{{$message}}</span>                  
              @enderror
        </div>
        <div class="w-50">
              <label class="form-label" for="nom">nom</label>
              <input value="{{auth()->user()->lname}}" name="lname" id="nom" class="form-control @error('lname') is-invalid @enderror" type="text">
              @error("lname")
                   <span class="text-danger mt-1">{{$message}}</span>                  
              @enderror
        </div>
   </div>
   <div class="d-flex gap-2">
    {{-- <div class="w-50">
        <label class="form-label" for="email">email</label>
        <input value="{{auth()->user()->email}}" name="email" id="email" class="form-control @error('email') is-invalid @enderror" type="email">
             @error("email")
                        <span class="text-danger mt-1">{{$message}}</span>                  
             @enderror
  </div> --}}
  <div class="w-50">
    <label class="form-label" for="phone">phone</label>
    <input value="{{auth()->user()->phone}}" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" type="number">
    @error("phone") 
            <span class="text-danger mt-1">{{$message}}</span>                  
    @enderror
</div>
  <div class="w-50">
    <label class="form-label" for="password">new password</label>
    <input name="password" id="password" class="form-control @error('password') is-invalid @enderror" type="number">
    {{-- @error("password") 
            <span class="text-danger mt-1">{{$message}}</span>                  
    @enderror --}}
</div>
   </div>


   <button class="btn btn-primary mt-2">modifier</button>
</form> 
@endsection



@section("script")

@endsection

