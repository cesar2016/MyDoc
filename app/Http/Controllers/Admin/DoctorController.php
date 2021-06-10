<?php

namespace App\Http\Controllers\Admin;

use App\Models\User; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specialty;
use App\Models\WorkDay;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = User::where('role', 'doctor')->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('doctors.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $rules = [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'dni' => 'nullable|digits:8',
            'adress' => 'min:5',
            'phone' => 'min:6'
        ];        
        $this->validate($request, $rules);
        $user = User::create($request->only('name', 'email', 'dni', 'adress', 'phone')
            + [
                'role' => 'doctor',
                'password' => bcrypt($request->input('password'))
                ]

        );
        $user->specialties()->attach($request->input('specialties'));

        $notification = 'Un nuevo MEDICO se ha registrado con correctamente!';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor =  User::findOrFail($id);
        $specialties = Specialty::all();
        $specialties_ids = $doctor->specialties()->pluck('specialties.id');
        return view('doctors.edit', compact('doctor', 'specialties', 'specialties_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'dni' => 'nullable|digits:8',
            'adress' => 'min:5',
            'phone' => 'min:6'
        ];        
        $this->validate($request, $rules);

        $user = User::findOrFail($id);
        
        $data = $request->only('name', 'email', 'dni', 'adress', 'phone');
        $password = $request->input('password');
        if($password) $data['password'] = bcrypt($password);

        $user->fill($data);     
        $user->save(); //Grabamos los datos en la DB -- UPDATE

        $user->specialties()->sync($request->input('specialties'));

        $notification = 'MEDICO actualizado correctamente!';       
        return redirect('/doctors')->with(compact('notification'));//fabi 8X05wLht
    }

    public function destroy(User $doctor)
    {
        $doctorName = $doctor->name;
        $doctor ->delete();

        $notification = "El MEDICO $doctorName, se elimino correctamente";
        return redirect('/doctors')->with(compact('notification'));
    }

    //----------MI PROPIO SIDERS --------------------------//
    public function storeSeed() //Insertando especialidaddes por medico
    {      
        $user = User::findOrFail(2);
        $user->specialties()->attach(1); 

        for ($i=4; $i < 9 ; $i++) {  
        $users = User::findOrFail($i);
            $users->role = 'doctor';  
            $users->save();

            $user = User::findOrFail($i);
            $user->specialties()->attach(rand(1,8));  
        }        

        for($i=3; $i < 9; $i++){

                $luM_start = '06:00:00'; $luM_end = '10:00:00'; $luA_start = '13:00:00'; $luA_end = '20:00:00';                
                $maM_start = '08:00:00'; $maM_end = '11:30:00'; $maA_start = '13:30:00'; $maA_end = '16:30:00';                
                $miM_start = '07:30:00'; $miM_end = '09:30:00'; $miA_start = '14:00:00'; $miA_end = '19:00:00';                
                $juM_start = '06:00:00'; $juM_end = '10:00:00'; $juA_start = '15:00:00'; $juA_end = '19:30:00';                
                $viM_start = '07:00:00'; $viM_end = '10:30:00'; $viA_start = '16:00:00'; $viA_end = '20:30:00';                 
                $saM_start = '10:00:00'; $saM_end = '11:30:00'; $saA_start = '13:00:00'; $saA_end = '14:00:00';                
                $doM_start = '05:00:00'; $doM_end = '05:00:00'; $doA_start = '13:00:00'; $doA_end = '13:00:00'; 
                

            for($d=0; $d<7; $d++) { 

                $active = 
                   $d == 0 && $i == 3 
                || $d == 1 && $i == 4 
                || $d == 2 && $i == 5 
                || $d == 3 && $i == 6 
                || $d == 4 && $i == 7 
                || $d == 5 && $i == 8 
                ? 1 : 0 ; 

               $dayM_start = $d == 0 && $i == 3 ? $luM_start : 
               ($d == 1 && $i == 4 ? $maM_start : 
               ($d == 2 && $i == 5 ? $miM_start : 
               ($d == 3 && $i == 6 ? $juM_start : 
               ($d == 4 && $i == 7 ? $viM_start : 
               ($d == 5 && $i == 8 ? $saM_start  : $doM_start)))));

               $dayM_end = $d == 0 && $i == 3 ? $luM_end : 
               ($d == 1 && $i == 4 ? $maM_end : 
               ($d == 2 && $i == 5 ? $miM_end : 
               ($d == 3 && $i == 6 ? $juM_end : 
               ($d == 4 && $i == 7 ? $viM_end : 
               ($d == 5 && $i == 8 ? $saM_end  : $doM_end)))));
               
               $dayA_start = $d == 0 && $i == 3 ? $luA_start  : 
               ($d == 1 && $i == 4 ? $maA_start : 
               ($d == 2 && $i == 5 ? $miA_start : 
               ($d == 3 && $i == 6 ? $juA_start : 
               ($d == 4 && $i == 7 ? $viA_start : 
               ($d == 5 && $i == 8 ? $saA_start : $doA_start)))));

               $dayA_end = $d == 0 && $i == 3 ? $luA_end  : 
               ($d == 1 && $i == 4 ? $maA_end : 
               ($d == 2 && $i == 5 ? $miA_end : 
               ($d == 3 && $i == 6 ? $juA_end : 
               ($d == 4 && $i == 7 ? $viA_end : 
               ($d == 5 && $i == 8 ? $saA_end : $doA_end)))));

               /* echo '<br>';
               echo $dayM_start.' '.$dayM_end.' '.$dayA_start.' '.$dayA_end.' '.$active;  */
               
                WorkDay::create([
                   'day'=> $d,
                   'active'=> $active,

                   'morning_start'=> $dayM_start,
                   'morning_end'=> $dayM_end,

                   'afternoon_start'=> $dayA_start,
                   'afternoon_end'=> $dayA_end,

                   'user_id'=> $i
               ]);
            }

            
        }

        $users = User::findOrFail([4, 5, 6, 7, 8]);
        echo $users;

    }


}
