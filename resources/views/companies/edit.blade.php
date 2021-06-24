@extends('layouts.app')

@section('content')
<div class = "container">
    <form action = "/companies/{{$company->id}}" method="post">
        @csrf
        @method("put")

        <div class="mb-3">
          <label>Nombre</label>
          <input type="text" class="form-control" required name = "name" value = "{{$company->name}}">
        </div>

        <div class="mb-3">
            <label>Ciudad</label>
            <input type="text" class="form-control" required name = "city" value = "{{$company->city}}">
        </div>

        <div class="mb-3">
            <label>Telefono</label>
            <input type="text" class="form-control" required name = "phone_number" value = "{{$company->phone_number}}">
        </div>

        <div class = "col-12 text-center">
            <a href = "/companies" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
</div>
@endsection