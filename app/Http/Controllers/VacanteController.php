<?php

namespace App\Http\Controllers;

use App\Salario;
use App\Vacante;
use App\Categoria;
use App\Ubicacion;
use App\Experiencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // SimplePaginate pq no utilitzem Bootstrap
        $vacantes = Vacante::where('user_id', auth()->user()->id)->latest()->simplePaginate(3);

        //dd($vacantes);


        return view('vacantes.index', compact('vacantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Consulta del Model Categoria que agafa tots els registres
        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::all();
        $salarios = Salario::all();

        return view('vacantes.create')
            ->with('categorias', $categorias)
            ->with('experiencias', $experiencias)
            ->with('ubicaciones', $ubicaciones)
            ->with('salarios', $salarios);
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
            'titulo' => 'required|min:8',
            'categoria' => 'required',
            'experiencia' => 'required',
            'ubicacion' => 'required',
            'salario' => 'required',
            'descripcion' => 'required|min:50',
            'imagen' => 'required',
            'skills' => 'required'
        ]);

        // Almacenar en la BD
        // Vacantes és el mètode dins de User.php (relació)
        auth()->user()->vacantes()->create([
            'titulo' => $data['titulo'],
            'imagen' => $data['imagen'],
            'descripcion' => $data['descripcion'],
            'skills' => $data['skills'],
            'categoria_id' => $data['categoria'],
            'experiencia_id' => $data['experiencia'],
            'ubicacion_id' => $data['ubicacion'],
            'salario_id' => $data['salario'],
        ]);


        return redirect()->action('VacanteController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {
        // Si ja no està activa la vacant, tornarà not found
        if($vacante->activa === 0) return abort(404);

        return view('vacantes.show')->with('vacante', $vacante);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante)
    {
        // Efectuem el VacantePolicy amb el mètode view d'aquest Policy.
        $this->authorize('view', $vacante);

        // Consulta del Model Categoria que agafa tots els registres
        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::all();
        $salarios = Salario::all();

        return view('vacantes.edit')
            ->with('categorias', $categorias)
            ->with('experiencias', $experiencias)
            ->with('ubicaciones', $ubicaciones)
            ->with('salarios', $salarios)
            ->with('vacante', $vacante);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacante $vacante)
    {
        // Efectuem el VacantePolicy amb el mètode update d'aquest Policy.
        $this->authorize('update', $vacante);

        // Validación
        $data = $request->validate([
            'titulo' => 'required|min:8',
            'categoria' => 'required',
            'experiencia' => 'required',
            'ubicacion' => 'required',
            'salario' => 'required',
            'descripcion' => 'required|min:50',
            'imagen' => 'required',
            'skills' => 'required'
        ]);

        $vacante->titulo = $data['titulo'];
        $vacante->skills = $data['skills'];
        $vacante->imagen = $data['imagen'];
        $vacante->descripcion = $data['descripcion'];
        $vacante->categoria_id = $data['categoria'];
        $vacante->experiencia_id = $data['experiencia'];
        $vacante->ubicacion_id = $data['ubicacion'];
        $vacante->salario_id = $data['salario'];

        $vacante->save();

        return redirect()->action('VacanteController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacante $vacante, Request $request)
    {
        // Efectuem el VacantePolicy amb el mètode delete d'aquest Policy.
        $this->authorize('delete', $vacante);

        $vacante->delete();

        return response()->json(['mensaje' => 'Se eliminió la vacante ' . $vacante->titulo]);
    }

    // Mètoder per la imatge del Dropzone
    public function imagen(Request $request) {
        // Creem una variable que obté la imatge en el moment que s'arrossega
        $imagen = $request->file('file');
        // Creem una variable que li assignarà un nom únic a la imatge, el temps actual en milisegons seguit de l'extensió de la imatge
        $nombreImagen = time() . '.' . $imagen->extension();
        // Utilitzem la variable d'abans i movem la imatge dins de storage/vacantes
        $imagen->move(public_path('storage/vacantes'), $nombreImagen);
        // Fem un return en format json
        return response()->json(['correcto' => $nombreImagen]);
    }

    // Borrar imagen via Ajax
    public function borrarimagen(Request $request) {
        if($request->ajax()) { // Si ens arriba petició ajax
            $imagen = $request->get('imagen'); // Creem una variable que obté la imatge

            if(File::exists('storage/vacantes/' . $imagen)) { // Si existeis la imatge amb el nom, l'esborra
                File::delete('storage/vacantes/' . $imagen);
            }

            return response('Imagen Eliminada', 200);
        }
    }

    // Cambia el estado de una vacante
    public function estado(Request $request, Vacante $vacante) {
        // Leer nuevo estado y asignarlo
        // És request estado perquè des del Component Vue, li passem al const estado
        $vacante->activa = $request->estado;

        // Guardarlo en la BD
        $vacante->save();

        return response()->json(['respuesta' => 'Correcto']);
    }

    public function buscar(Request $request) {

        // Validar
        $data = $request->validate([
            'categoria' => 'required',
            'ubicacion' => 'required'
        ]);

        // Asignar valores
        $categoria = $data['categoria'];
        $ubicacion = $data['ubicacion'];

        // Dos 'where' és un AND en SQL
        // Si volem poser un 'or' posaríem 'orWhere'
        $vacantes = Vacante::latest()
            ->where('categoria_id', $categoria)
            ->where('ubicacion_id', $ubicacion)
            ->get();

            return view('buscar.index', compact('vacantes'));
    }

    public function resultados() {
        return 'aaaa';
    }

}
