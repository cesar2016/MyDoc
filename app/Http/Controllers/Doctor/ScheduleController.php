<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WorkDay;
use Carbon\Carbon;

use function PHPSTORM_META\map;

class ScheduleController extends Controller
{
    private $days = ['Lunes', 'Marter', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
    public function edit()
    {
        $workDays = WorkDay::where('user_id', auth()->user()->id)->get();       

        if(count($workDays) > 0 ){

            $workDays->map(function($workDay){
                $workDay->morning_start = (new Carbon($workDay->morning_start))->format('g:i A');
                $workDay->morning_end = (new Carbon($workDay->morning_end))->format('g:i A');
    
                $workDay->afternoon_start = (new Carbon($workDay->afternoon_start))->format('g:i A'); 
                $workDay->afternoon_end = (new Carbon($workDay->afternoon_end))->format('g:i A'); 
                return $workDay;
    
            });
        }else{
            $workDays = collect();
            for ($i=0; $i <7 ; $i++) { 
                $workDays->push(new WorkDay());
            }
        }
        
        
        //dd($workDays->toArray());
        $days = $this->days;
        return view('/schedule', compact('workDays','days'));
    }
    public function store(Request $request)
    {
         //dd($request->all());
         $days = $this->days;
         $active = $request->input('active') ?: []; 
         $morning_start = $request->input('morning_start');
         $morning_end =  $request->input('morning_end');          
         $afternoon_start =  $request->input('afternoon_start');
         $afternoon_end =  $request->input('afternoon_end'); 
 
         $errors = [];
         for($i=0; $i<7; $i++){ 

            if($morning_start[$i] > $morning_end[$i]){

                $errors [] = "La Hora de inicio del dia $days[$i] del turno MAÑANA no puede ser mayor a la de fin!"; 
                         
            }

            if($afternoon_start[$i] > $afternoon_end[$i]){

                $errors [] =  "La Hora de inicio del dia $days[$i] del turno TARDE no puede ser mayor a la de fin!";
                 
            }

            WorkDay::updateOrCreate(      
                    [
                        'day'=> $i,
                        'user_id'=> auth()->user()->id,
                    ],
        
                    [
                        'active'=> in_array($i, $active),
                        'morning_start'=> $morning_start[$i],
                        'morning_end'=> $morning_end[$i],
            
                        'afternoon_start'=> $afternoon_start[$i],
                        'afternoon_end'=> $afternoon_end[$i], 
                    ]             
            );
        }
 
        if(count($errors) > 0)            
            return back()->with(compact('errors'));
            
            $notification = 'Los cambios se guardaron correctamente';
            return back()->with(compact('notification'));         
           
        
    }

}
