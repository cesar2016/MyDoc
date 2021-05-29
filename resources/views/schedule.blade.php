@extends('layouts.panel')

@section('content')

 

<div class="row">
  <form action="{{url('/schedule')}}" method="POST">
    @csrf
    @method('POST')
    <div class="col-xl-12 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Gestionar Horarios </h3>
            </div>
            <div class="col text-right">
              <button type="submit" class="btn btn-sm btn-success">
                  Guardar cambios
              </button>
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
              <tr class="text-center">
                <th scope="col">Dia</th>
                <th scope="col">Activo</th>
                <th scope="col">Turno Mañana</th>
                <th scope="col">Turno Tarde</th>
                 
              </tr>
            </thead>
            <tbody>
                {{-- @foreach ($doctors as $doctor) --}}
              @foreach($days as $key => $day)
              <tr> <th>{{$day}} </th> 
                <td>
                  <label class="custom-toggle">
                    <input name="active[]" type="checkbox" value="{{$key}}">
                    <span class="custom-toggle-slider rounded-circle"></span>
                  </label>                    
                </td>
                <td>
                  <div class="row">
                    <div class="col">
                      <select class="form-control" name="morning_start[]" >
                      @for($i=5; $i<=11; $i++)                      
                        <option value="{{$i}}:00">{{$i}}:00 AM</option>
                        <option value="{{$i}}:30">{{$i}}:30 AM</option>
                      @endfor
                      </select>
                    </div>
                    <div class="col">
                      <select class="form-control"  name="morning_end[]" >
                      @for($i=5; $i<=11; $i++)                      
                      <option value="{{$i}}:00">{{$i}}:00 AM</option>
                      <option value="{{$i}}:30">{{$i}}:30 AM</option>
                      @endfor
                    </div>
                  </div>
                </td>
                <td>
                  <div class="row">
                    <div class="col">
                      <select class="form-control"  name="afternoon_start[]" >
                      @for($i=1; $i<=11; $i++)                      
                        <option value="{{$i+12}}:00">{{$i+12}}:00 PM</option>
                        <option value="{{$i+12}}:30">{{$i+12}}:30 PM</option>
                      @endfor
                      </select>
                    </div>
                    <div class="col">
                      <select class="form-control"  name="afternoon_end[]" >
                      @for($i=1; $i<=11; $i++)                      
                      <option value="{{$i+12}}:00">{{$i+12}}:00 PM</option>
                      <option value="{{$i+12}}:30">{{$i+12}}:30 PM</option>
                      @endfor
                    </div>
                  </div>
                </td>
                <td></td>
              </tr>
              @endforeach
                
             
             {{--  @endforeach --}}
              
            </tbody>
          </table>
        </div>
        <div class="card-footer py-4">
         {{--  {{$doctors->links()}}  --}}          
        </div>
      </div>
    </div>
  </form>  
</div>
    
@endsection
 