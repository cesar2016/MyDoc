<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index()
    {
        //return view('specialties.index');
        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));

    }
    public function create()
    {
        return view('specialties.create');

    }
    public function store(Request $request)
    {
        //dd($request->all());
        $rules = [
            'name' => 'required|min:4', // Minimo de 3 caracteres para en name
            'description' => 'required',
            $messages = [
                'name.required' => 'Debe ingresar un nombre',
                'name.min' => 'El nombre debe tener al menos 4 caracteres',
                'description.required' => 'Debe ingresar una descripcion'
            ]
        ];
        $this->validate($request, $rules, $messages);

        $specialty = new Specialty();
        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save(); // Le metemos todo lo que viene en el form

        $notification = 'Especialidad registrada correctamente';
        return redirect('/specialties')->with(compact('notification')); // VOlvemos a la tabla

    }

    public function edit(Specialty $specialty)
    {
         
        return view('specialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty)
    {
         
        $rules = [
            'name' => 'required|min:4', // Minimo de 3 caracteres para en name
            'description' => 'required',
            $messages = [
                'name.required' => 'Debe ingresar un nombre',
                'name.min' => 'El nombre debe tener al menos 4 caracteres',
                'description.required' => 'Debe ingresar una descripcion'
            ]
        ];
        $this->validate($request, $rules, $messages);
        
        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save(); // Le metemos todo lo que viene en el form para UPDATE

        $notification = 'Especialidad Modificacda correctamente';
        return redirect('/specialties')->with(compact('notification'));; // VOlvemos a la tabla

    }
    public function destroy(Specialty $specialty)
    {
        $deleteSpecialty = $specialty->name;
        $specialty->delete();
        $notification = 'Especialidad '.$deleteSpecialty.' Eliminada correctamente';
        return redirect('/specialties')->with(compact('notification'));; // VOlvemos a la tabla         

    }
}
