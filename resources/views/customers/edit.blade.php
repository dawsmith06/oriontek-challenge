@extends('layouts.app')

@section('content')
<div class = "container">
    <form action = "/customers/{{$customer->id}}" method="post">
        @csrf
        @method("put")

        <div class="mb-3">
            <label>Compañia</label>
            <select class="form-control" name="company_id" required>
                <option disabled selected>Selecciona una Compañia</option>
                @foreach ($companies as $company)
                    <option value="{{$company->id}}" {{$customer->company_id == $company->id ? 'selected' : ''}}>
                        {{$company->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
          <label>Nombres</label>
          <input type="text" class="form-control" required name = "name" value = "{{$customer->name}}">
        </div>

        <div class="mb-3">
          <label>Apellidos</label>
          <input type="text" class="form-control" required name = "last_name" value = "{{$customer->last_name}}">
        </div>

        <div class="mb-3">
            <label>Ciudad</label>
            <input type="text" class="form-control" required name = "city" value = "{{$customer->city}}">
        </div>

        <div class="mb-3">
            <label>Telefono</label>
            <input type="text" class="form-control" required name = "phone_number" value = "{{$customer->phone_number}}">
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
            @foreach ($customer->addresses as $address)
                <div class = "address-block d-flex main mb-1">
                    <input type="text" name="addresses[{{$address->id}}]" required class="form-control" value = "{{$address->address}}" placeholder="Escribir direccion">
                    <a href="#" class = "delete-address text-danger ml-2 mt-2">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            @endforeach
        </div>
        <hr>
        
        <div class = "col-12 text-center">
            <a href = "/customers?company={{$customer->company_id}}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
    
    <script>
        $("#add-address").click(function (e) { 
            let mainAddressBlock = $(".address-block.main").clone();
            mainAddressBlock.removeClass("main");
            mainAddressBlock.find('.delete-address').removeClass("d-none");
            mainAddressBlock.find('input').val("").attr("name","addresses[]");
            $("#addresses-container").append(mainAddressBlock)
        });

        $("#addresses-container").on("click",".delete-address",function(){
            $(this).closest(".address-block").hide().removeClass("d-flex").find("input").val("-1");
        });
    </script>
</div>
@endsection