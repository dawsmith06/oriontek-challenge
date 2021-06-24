@extends('layouts.app')

@section('content')
    <div class = "container-fluid">
        <div class="d-flex">
            <select id="company-select" class="form-control w-25" name="company_id" required>
                <option disabled selected>Selecciona una Compañia</option>
                @foreach ($companies as $company)
                    <option value="{{$company->id}}" {{request()->company == $company->id ? 'selected' : ''}}>
                        {{$company->name}}
                    </option>
                @endforeach
            </select>
            
            @if(count($companies) > 0)
                <a href = "/customers/create" class="btn btn-primary ml-4">
                    Agregar
                </a>
            @endif
        </div>

        <table class="table mt-2 text-center table-sm table-hover" style = "font-size: 12px; cursor:pointer">
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Creacion</th>
                    <th>Opciones</th>
                </tr>
            </thead>
    
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <th scope="row">{{$customer->id}}</th>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->city}}</td>
                        <td>{{$customer->phone_number}}</td>
                        <td>{{$customer->created_at->format("d/m/y H:i:s")}}</td>
                        <td>
                            <a href="/customers/{{$customer->id}}/edit" class = "text-warning mr-3">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="#" class = "text-danger" onclick = "deleteCustomer({{$customer->id}})" >
                                <i class="fas fa-trash"></i>
                            </a>

                            <form id="destroy-form" action="customers/{{$customer->id}}" method="POST" class="d-none">
                                @csrf
                                @method("delete")
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function deleteCustomer(id){
            if(confirm("Desea eliminar este cliente?")){
                $('#destroy-form').submit();
            }
        }

        $("#company-select").change(function (e) { 
            location.href = location.origin+"/customers/?company="+$(this).val();
        });
    </script>
@endsection