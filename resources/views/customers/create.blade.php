@extends('layouts.app')

@section('content')
<div class = "container">
    <form action = "/customers" method="post">
        @csrf
        <div class="mb-3">
            <label>Compañia</label>
            <select class="form-control" name="company_id" required>
                <option disabled selected>Selecciona una Compañia</option>

                @foreach ($companies as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nombres</label>
            <input type="text" class="form-control" required name = "name" value = "{{$company->name}}">
          </div>
  
          <div class="mb-3">
            <label>Apellidos</label>
            <input type="text" class="form-control" required name = "last_name" value = "{{$company->last_name}}">
          </div>

        <div class="mb-3">
            <label>Ciudad</label>
            <input type="text" class="form-control" required name = "city">
        </div>

        <div class="mb-3">
            <label>Telefono</label>
            <input type="text" class="form-control" required name = "phone_number">
        </div>
        
        <hr>
        <h5 class = "w-100 text-center text-primary">
            Direcciones
            <button id="add-address" type="button" class = "btn btn-primary btn-sm" title = "Agregar direccion">
                <i class="fas fa-plus-circle"></i>
            </button>
        </h5>
        <hr>
        <div id = "addresses-container">
            <div class = "address-block d-flex main">
                <input type="text" name="addresses[]" required class = "form-control" placeholder="Escribir direccion">
                <button type="button" class = "delete-address btn btn-danger btn-sm d-none">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
        <hr>
        
        <div class = "col-12 text-center">
            <a href = "/customers" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>

    <script>
        $("#add-address").click(function (e) { 
            let mainAddressBlock = $(".address-block.main").clone();
            mainAddressBlock.removeClass("main");
            mainAddressBlock.find('.delete-address').removeClass("d-none");
            $("#addresses-container").append(mainAddressBlock)
        });

        $("#addresses-container").on("click",".delete-address",function(){
            $(this).closest(".address-block").remove();
        });
    </script>
</div>
@endsection