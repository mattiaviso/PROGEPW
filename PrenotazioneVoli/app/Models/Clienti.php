<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clienti extends Model
{
    use HasFactory;

    protected $table = "clienti";

    protected $fillable = ['nome', 'cognome', 'dataNascita', 'luogoNascita', 'email', 'password', 'compagnia_id', 'ruolo'];

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazioni::class, 'cliente_id');
    }

    public function compagnia()
    {
        return $this->belongsTo(Compagnie::class, 'compagnia_id', 'id');
    }

}
