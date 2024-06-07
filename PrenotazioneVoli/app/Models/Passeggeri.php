<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passeggeri extends Model
{
    use HasFactory;
    protected $table = "passeggeri";

    protected $fillable = ['nome', 'cognome'];

    public function prenotazioni()
    {
        return $this->belongsToMany(Prenotazioni::class, 'prenotazioni_passeggeri', 'passeggero_id', 'prenotazione_id');
    }
}
