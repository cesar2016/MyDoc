@extends('layouts.panel')

@section('content')

 

<div class="row">
   
    <div class="col-xl-12 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Registrar un nuevo turno </h3>
            </div>
            <div class="col text-right">
              <a href="{{url('/patients')}}" class="btn btn-sm btn-default">
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
          <form action="{{url('/appointments')}}" method="POST">
             @csrf             
            <div class="form-row">
              <div class="form-group col-md-8">
                <label for="description">Descripcion</label>
                <input name="description" id="description" type="text" class="form-control" placeholder="Describa brevemente la consulta" required>              
              </div>
              <div class="form-group col-md-6">
                <label for="specialty">Especialidades</label>
                <select name="specialty_id" id="specialty" class="form-control" required>
                  <option> Elija una especialidad </option>
                  @foreach ($specialties as $specialtie)                      
                    <option value="{{$specialtie->id}}">{{$specialtie->name}}</option>                      
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="doctor">Medicos</label>
                <select type="text" name="doctor_id" id="doctor" class="form-control" required>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="inputEmail4">Fecha <small id='ErroNoDate'></small></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input name="scheduled_date" class="form-control datepicker" id="date" placeholder="Seleccione Fecha" type="text" value="{{date('Y-m-d')}} " 
                    data-date-format="yyyy-mm-dd"
                    data-date-start-date="{{date('Y-m-d')}}"  
                    data-date-end-date="+50d" required>
                </div>
                <div id="hours"></div>
              </div>
              <div class="form-group col-md-6">
                <label for="inputEmail4">Tipo de consulta </label>
                <div class="custom-control custom-radio mb-3">
                  <input type="radio" name="type" id="type1" value="Consulta" class="custom-control-input" checked>
                  <label class="custom-control-label" for="type1">Consulta</label>
                </div> 
                <div class="custom-control custom-radio mb-3">
                  <input type="radio" name="type" id="type2" value="Examen" class="custom-control-input">
                  <label class="custom-control-label" for="type2">Examen</label>
                </div> 
                <div class="custom-control custom-radio mb-3">
                  <input type="radio" name="type" id="type3" value="Operacion" class="custom-control-input">
                  <label class="custom-control-label" for="type3">Operacion</label>
                </div>                
              </div>                                         
            </div>            
            <button type="submit" class="btn btn-primary">Guardar</button>              
          </form>
        </div>
      </div>
    </div>
    
</div>
    
@endsection
@section('scripts')
<!-- Argon JS -->
<script src="{{asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<script src="{{asset('js/appointments/create.js')}}"></script>
@endsection
 