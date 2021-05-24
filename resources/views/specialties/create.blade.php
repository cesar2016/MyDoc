@extends('layouts.panel')

@section('content')

 

<div class="row">
   
    <div class="col-xl-12 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Nueva Especialidade </h3>
            </div>
            <div class="col text-right">
              <a href="{{url('specialties/create')}}" class="btn btn-sm btn-default">
                 Cancelar y volver 
              </a>
            </div>
          </div>
        </div>
        <div class="card-body">
          @if ($errors->any())
          <ul>
            @foreach ($errors->all() as $error)
              <span class="text-danger" role="alert">
                <li>{{$error}}</li>      
              </span>          
            @endforeach
          </ul>
              
          @endif
          <form action="{{url('/specialties/create')}}" method="POST" >
             @csrf
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Nombre de la especialidad</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Nombre de la especialidad">
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Descripcion</label>
                <input type="text" name="description" class="form-control" value="{{old('description')}}" placeholder="Descripcion">
              </div>
            </div>            
            <button type="submit" class="btn btn-primary">Guardar</button>              
          </form>
        </div>
      </div>
    </div>
    
</div>
    
@endsection
 