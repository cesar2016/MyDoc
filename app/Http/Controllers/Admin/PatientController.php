<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = User::where('role', 'patien')->paginate(10);
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'dni' => 'nullable|digits:8',
            'adress' => 'min:5',
            'phone' => 'min:6'
        ];        
        $this->validate($request, $rules);
        User::create($request->only('name', 'email', 'dni', 'adress', 'phone')
            + [
                'role' => 'patien',
                'password' => bcrypt($request->input('password'))
                ]

        );

        $notification = 'Un nuevo PACIENTE se ha registrado con correctamente!';
        return redirect('/doctors')->with(compact('notification')); // email@example.com | JUgQbmZX
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
    public function edit(User $patient)
    {
        //$patiens =  User::findOrFail($patien->id);
        return view('patients.edit', compact('patient'));
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
        $user->save(); //Grabamos los datos en la DB       

        $notification = 'PACIENTE actualizado correctamente!';
        return redirect('/patients')->with(compact('notification')); //kris.roma@example.ar | toni1234
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $patient)
    {
        $patientName = $patient->name;
        $patient ->delete();

        $notification = "El PACIENTE $patientName, se elimino correctamente";
        return redirect('/patients')->with(compact('notification'));
    }
}
