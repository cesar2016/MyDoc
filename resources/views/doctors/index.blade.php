@extends('layouts.panel')

@section('content')

 

<div class="row">
   
    <div class="col-xl-12 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Medicos </h3>
            </div>
            <div class="col text-right">
              <a href="{{url('doctors/create')}}" class="btn btn-sm btn-success">
                  Nuevo Medico
              </a>
            </div>
          </div>
        </div>

        @if (session('notification'))
        <div class="card-body">
            <div class="alert alert-success" role="alert">
                <strong>Exito!</strong> {{session('notification')}}
            </div>
        </div>            
        @endif         
           
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">DNI</th>
                <th scope="col">Opciones</th>
                 
              </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
              <tr>
                <th scope="row">
                    {{$doctor->name}}
                </th>
                <td>
                    {{$doctor->email}}
                </td>
                <td>
                    {{$doctor->dni}}
                </td>         
                        
                <td>                    
                    <form action="{{url('/doctors/'.$doctor->id.'/delete')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{url('/doctors/'.$doctor->id.'/edit')}}" class="btn btn-sm btn-primary">
                            Editar 
                        </a>
                        <button class="btn btn-sm btn-danger" type="submit"> Eliminar </button>
                    </form>
                </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
</div>
    
@endsection
 