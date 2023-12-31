@extends("dashboard")
 
@section("title")
    ajouter contrat
@endsection

@section("title_page")
   ajouter contrat
@endsection

@section("contenu")
<form class="mt-3" action="{{route('admin.contrats.store')}}" method="post">
    @csrf
    <div class="d-flex gap-2">
      <div class="w-100">
          <label class="form-label" for="type">type</label>
          <select @error("type") is-invalid @enderror class="form-control" name="type" id="type">
             <option disabled selected>choisir le type</option>
              <option value="0">abonnement</option>
              <option value="1">commission</option>
          </select>
          @error("type")
               <span class="mt-2 text-danger">{{$message}}</span>
          @enderror
      </div>

      
            <div style="display:none;" id="periode_div" class="w-100">
            <label class="form-label" for="periode">periode</label>
            <select class="form-control" name="periode" id="periode">
                  <option value="1">1 mois</option>
                  <option value="2">2 mois</option>
                  <option value="3">3 mois</option>
                  <option value="4">4 mois</option>
                  <option value="5">5 mois</option>
                  <option value="6">6 mois</option>
                  <option value="7">7 mois</option>
                  <option value="8">8 mois</option>
                  <option value="9">9 mois</option>
                  <option value="10">10 mois</option>
                  <option value="11">11 mois</option>
                  <option value="12">12 mois</option>
            </select>
            </div>
            <div style="display:none;" id="montant_div" class="w-100">
                  <label class="form-label" for="montant">montant</label>
                  <input id="montant" name="montant" class="form-control" type="number">
            </div>
      


    
         
                  <div style="display:none;" id="commission_div" class="w-100">
                        <label class="form-label" for="commission">commission</label>
                        <input id="commission" name="commission" class="form-control" type="number">
                  </div> 
         
   
    </div>
   <button class="btn btn-primary mt-2">ajouter</button>
</form>
@endsection

@section("script")
$(document).ready(function() {
      $('#type').on('change', function() {
            var commission_div = document.getElementById("commission_div");
            var montant_div = document.getElementById("montant_div");
            var periode_div = document.getElementById("periode_div");
            var id = $("#type").val();
            $.ajax({
                  url: "{{ url('admin/contrat_type') }}" + '/'+id,
                  dataType: 'json',
                  {{-- data: {
                      var1: $(this).val()
                  }, --}}
                  success: function(data) {
                      if(data==1){
                        commission_div.style.display = "block";
                        montant_div.style.display = "none";
                        periode_div.style.display = "none";
                      }
                      else if(data==0){
                        commission_div.style.display = "none";
                        montant_div.style.display = "block";
                        periode_div.style.display = "block";
                      }
                  },
                  type: 'GET'
            });
      });
});
@endsection