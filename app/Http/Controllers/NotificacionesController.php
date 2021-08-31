<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // Passarem a la vista les notificaciones que l'usuari no ha llegit
        $notificaciones = auth()->user()->unreadNotifications;
        // Fem que a l'entrar a la vista, les notificacions que no havia llegit, es marquin com vistes
        auth()->user()->unreadNotifications->markasRead();

        return view('notificaciones.index', compact('notificaciones'));
    }
}
