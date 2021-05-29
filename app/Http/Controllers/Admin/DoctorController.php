<?php

namespace App\Http\Controllers\Admin;

use App\Models\User; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('doctors.create');
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
                'role' => 'doctor',
                'password' => bcrypt($request->input('password'))
                ]

        );

        $notification = 'Un nuevo MEDICO se ha registrado con correctamente!';
        return redirect('/doctors')->with(compact('notification'));//fabi 8X05wLht
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
        return view('doctors.edit', compact('doctor'));
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
}
