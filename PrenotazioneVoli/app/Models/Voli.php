<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Voli extends Model
{
    use HasFactory;

    protected $table = "voli";

    protected $fillable = ['numeroVolo', 'orarioPartenza', 'orarioArrivo', 'aereoportoPartenza_id', 'aereoportoArrivo_id', 'aereo_id', 'compagnia_id'];

    public function aereoportoPartenza()
    {
        return $this->belongsTo(Aereoporti::class, 'aereoportoPartenza_id', 'id');
    }

    public function aereoportoArrivo()
    {
        return $this->belongsTo(Aereoporti::class, 'aereoportoArrivo_id', 'id');
    }

    public function aereo()
    {
        return $this->belongsTo(Aerei::class, 'aereo_id', 'id');
    }

    public function compagnia()
    {
        return $this->belongsTo(Compagnie::class, 'compagnia_id', 'id');
    }

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazioni::class, 'volo_id', 'id');
    }


}
