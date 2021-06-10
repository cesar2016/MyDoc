<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Specialty;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create(){
        $specialties = Specialty::all();
        return view('appointments.create', compact('specialties'));
    }
    public function store(Request $request)
    {
        $rules = [
            'description'=> 'required',
            'specialty_id'=> 'exist:specialties,id',
            'doctor_id'=> 'exist:users,id',
            'scheduled_time'=> 'reqired'
            
        ];
        $message = [
            'scheduled_time.required' =>'Debe elegir fecha y hora valida'
        ];
        $data = $request->only([
            'description',
            'specialty_id',
            'doctor_id',             
            'scheduled_date',
            'scheduled_time',            
            'type'
        ]);
        $data['patient_id'] = auth()->id();
        $carbonTime = Carbon::createFromFormat('g: i A', $data['scheduled_time']);
        $data['scheduled_time'] = $carbonTime->format('H:i:s');
        Appointment::create($data);
        

        $notification = 'El turno se registro correctamente';
        return back()->with(compact('notification'));

    }
}
