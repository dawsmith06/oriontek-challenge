@extends('layouts.app')

@section('content')
    <div class = "container-fluid">
        <a href = "companies/create" class="btn btn-primary">
            Agregar
        </a>
        

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
                @foreach ($companies as $company)
                    <tr>
                        <th scope="row">{{$company->id}}</th>
                        <td>{{$company->name}}</td>
                        <td>{{$company->city}}</td>
                        <td>{{$company->phone_number}}</td>
                        <td>{{$company->created_at->format("d/m/y H:i:s")}}</td>
                        <td>
                            <a href="/companies/{{$company->id}}/edit" class = "text-warning mr-3">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="#" class = "text-danger" onclick = "deleteCompany({{$company->id}})" >
                                <i class="fas fa-trash"></i>
                            </a>

                            <form id="destroy-form" action="companies/{{$company->id}}" method="POST" class="d-none">
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
        function deleteCompany(id){
            if(confirm("Desea eliminar esta compania?")){
                $('#destroy-form').submit();
            }
        }
    </script>
@endsection