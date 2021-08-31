<?php

namespace App\Http\Controllers;

use App\Vacante;
use App\Candidato;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Obtener el ID actual
        $id_vacante = $request->route('id');

        // Obtener los candidatos y la vacante
        $vacante = Vacante::findOrFail($id_vacante);

        // Executem el Policy perquè només pugui veure els CV les persones registrades
        $this->authorize('view', $vacante);

        return view('candidatos.index', compact('vacante'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación

        $data = $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'cv' => 'required|mimes:pdf|max:1000',
            'vacante_id' => 'required',
        ]);

        // Almacenar archivo PDF

        if($request->file('cv')) { // El name de l'input es diu cv
            $archivo = $request->file('cv');
            // El guardem amb un nom únic
            $nombreArchivo = time() . "." . $request->file('cv')->extension();
            $ubicacion = public_path('/storage/cv');
            $archivo->move($ubicacion, $nombreArchivo);
        }

        // Última forma -> Mitjançant la relació creada en el Model Vacante.php
        // Si ho fem així, hem de comentar el $candidato->save

            $vacante = Vacante::find($data['vacante_id']);
            $vacante->candidatos()->create([
                'nombre' => $data['nombre'],
                'email' => $data['email'],
                'cv' => $nombreArchivo,
            ]);

        // Com fer que arribi una notificació al correu quan l'usuari envia el CV
        $reclutador = $vacante->reclutador;
        // Li passem el títol de la Vacant a l'arxiu de notificacions per rebre'l al constructor
        $reclutador->notify(new \App\Notifications\NuevoCandidato($vacante->titulo, $vacante->id));

        // return back et porta a la pàgina on estaves abans
        // A l'enviar el formulari, si es completa correctament, crearem una variable temporal amb el with anomenada estado
        // Imprimim el missatge d'aquesta variable a app.blade.php
        return back()->with('estado', 'Tus datos se enviaron Correctamente! Suerte');

        // Una forma per afegir a la BD la info
            /*$candidato = new Candidato();
            $candidato->nombre = $data['nombre'];
            $candidato->email = $data['email'];
            $candidato->vacante_id = $data['vacante_id'];
            $candidato->cv = $nombreArchivo;

        $candidato->save();*/

        // Segunda forma -> Requereix $fillable al Model

            //$candidato = new Candidato($data);

        // Tercera Forma -> Requereix $fillable al Model

            /*$candidato = new Candidato();
            $candidato->fill($data);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function show(Candidato $candidato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidato $candidato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidato $candidato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidato $candidato)
    {
        //
    }
}
