@extends('layouts.app')
@section('content')
<div class="container">


@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible" role="alert">
{{ Session::get('mensaje') }}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>

</div>
@endif







<a href="{{ url('establecimiento/create') }}" class="btn btn-success" > Registrar nuevo establecimiento </a>
<br/>
<br/>

<div class="col-xl-12">
    <form action="{{ route('establecimiento.index')}}" method="get">
        <div class="form-row">
            <div class="col-sm-4 my-1">
                <input type="text" class="form-control" name="texto">
                
            </div>
            <div class="col-auto my-1">
                <input type="submit" class="btn btn-primary" value="Buscar">
            </div>
        </div>
    </form>
</div>
<br/>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($establecimientos as $establecimiento)
        <tr>
            <td>{{ $establecimiento->id }}</td>

            <td>
            <img class="img-thumbnail img-flui" src="{{ asset('storage').'/'.$establecimiento->Foto }}" width="100" alt="">
            </td>

            <td>{{ $establecimiento->Nombre }}</td>
            <td>
                
            <a href="{{ url('/establecimiento/'.$establecimiento->id.'/edit') }}" class="btn btn-warning">
                    Editar 
            </a>    
             |

            <form action="{{ url('/establecimiento/'.$establecimiento->id) }}" class="d-inline" method="post">
            @csrf
            {{ method_field('DELETE') }}
            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">

            </form>

            </td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $establecimientos->links() !!}
</div>
@endsection