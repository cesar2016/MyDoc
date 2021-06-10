<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WorkDay;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function hours(Request $request)
    {
        $rules = [
            'date'=> 'required|date_format:"Y-m-d"',
            'doctor_id'=> 'required|exists:users,id'
         ];
        $this->validate($request, $rules);
         
        $date = $request->input('date');
        $dateCarbon = new Carbon($date);  

        $i = $dateCarbon->dayOfWeek;
        $day = $i == 0 ? $i = 6 : $i-1;
        
        $doctorId = $request->input('doctor_id');

        $WorkDays = WorkDay::where('active', true)        
        ->where('day', $day)         
        ->where('user_id', $doctorId)
        ->first([
            'morning_start',
            'morning_end',
            'afternoon_start',
            'afternoon_end'
        ]);

        if(!$WorkDays){
            return  [];
           
        }
          

        $morningIntervals = $this->getIntervals($WorkDays->morning_start, $WorkDays->morning_end);
        $afternoonIntervals = $this->getIntervals($WorkDays->afternoon_start, $WorkDays->afternoon_end);

        $data = []; 
        $data['morning'] = $morningIntervals; 
        $data['afternoon'] = $afternoonIntervals;
        return $data;
          
    }
    private function getIntervals($start, $end){

        $start = new Carbon($start);
        $end = new Carbon($end);

        $intervals = [];

        while ($start < $end) {
            $interval = [];

            $interval['start'] = $start->format('g:i A');
            $start->addMinutes(30);
            $interval['end'] = $start->format('g:i A');

            $intervals[] = $interval;
        }
        return $intervals;
        
    }
}

