<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    //

    protected $fillable = [
        'titulo', 'imagen', 'descripcion', 'skills', 'categoria_id', 'experiencia_id', 'ubicacion_id', 'salario_id'
    ];

    // Relación 1:1 categoría y vacante. Una vacant té una categoria però una categoria està en moltes vacants
    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    // Relación 1:1 salario y vacante. També belongsTo pel motiu d'adalt
    public function salario() {
        return $this->belongsTo(Salario::class);
    }

    // Relación 1:1 ubicacion y vacante.
    public function ubicacion() {
        return $this->belongsTo(Ubicacion::class);
    }

    // Relación 1:1 experiencia y vacante.
    public function experiencia() {
        return $this->belongsTo(Experiencia::class);
    }

    // Relación 1:1 reclutador y vacante
    public function reclutador() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación 1:n vacante y candidatos
    public function candidatos() {
        return $this->hasMany(Candidato::class);
    }
}
