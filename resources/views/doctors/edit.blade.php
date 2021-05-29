@extends('layouts.panel')

@section('content')  

<div class="row">
   
    <div class="col-xl-12 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Editar medico </h3>
            </div>
            <div class="col text-right">
              <a href="{{url('/doctors')}}" class="btn btn-sm btn-default">
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
          <form action="{{url('/doctors/'.$doctor->id)}}" method="POST" >
             @csrf
             @method('PUT')
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Nombre del medico</label>
                <input type="text" name="name" class="form-control" value="{{old('name', $doctor->name)}}" placeholder="Nombre del medico">
              </div>
              <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" value="{{old('email', $doctor->email)}}" placeholder="E-mail">
              </div>
              <div class="form-group col-md-6">
                <label for="inputEmail4">DNI</label>
                <input type="text" name="dni" class="form-control" value="{{old('dni', $doctor->dni)}}" placeholder="DNI: 30259xxx">
              </div>
              <div class="form-group col-md-6">
                <label for="inputEmail4">Direccion</label>
                <input type="text" name="adress" class="form-control" value="{{old('adress', $doctor->adress)}}" placeholder="Direccion">
              </div>
              <div class="form-group col-md-6">
                <label for="inputEmail4">Telefono / movil</label>
                <input type="text" name="phone" class="form-control" value="{{old('phone', $doctor->phone)}}" placeholder="Telefono o Celular">
              </div>
              <div class="form-group col-md-6">
                <label for="password">Contraseña</label>
                <input type="text" name="password" class="form-control" value="">
                <p><small>Ingrese un valor si desea modificar la clave</small></p>
              </div> 
            </div>            
            <button type="submit" class="btn btn-primary">Guardar</button>              
          </form>
        </div>
      </div>
    </div>
    
</div>
    
@endsection
 