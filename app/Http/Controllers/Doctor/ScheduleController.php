<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WorkDay;

class ScheduleController extends Controller
{
    public function edit()
    {
        $days = ['Lunes', 'Marter', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
        return view('/schedule', compact('days'));
    }
    public function store(Request $request)
    {
         //dd($request->all());
         $active = $request->input('active') ?: [];

         /* if($active == null ){
             $active = [];
         } */

         $morning_start = $request->input('morning_start');
         $morning_end =  $request->input('morning_end');
         $afternoon_start =  $request->input('afternoon_start');
         $afternoon_end =  $request->input('afternoon_end'); 

         for($i=0; $i<7; $i++){
             
            //$search = in_array($i, $active);
             
            /* if($search){
                $active = 1;

            }else{
                $active = 0;
            }; */

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
            return back();
        
    }

}
