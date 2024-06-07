<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenotazioni extends Model
{
    use HasFactory;

    protected $table = "prenotazioni";

    protected $fillable = ['dataPrenotazione', 'volo_id', 'cliente_id'];

    public function volo()
    {
        return $this->belongsTo(Voli::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Clienti::class);
    }

    public function passeggeri()
    {
        return $this->belongsToMany(Passeggeri::class, 'prenotazioni_passeggeri', 'prenotazione_id', 'passeggero_id');
    }





}
