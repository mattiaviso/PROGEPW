<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aereoporti extends Model
{
    use HasFactory;

    protected $table = "aereoporti";

    protected $fillable = ['nome', 'codice_iata', 'city', 'country', 'lat', 'lon'];

    public function voliPartenza()
    {
        return $this->hasMany(Voli::class, 'aereoportoPartenza_id', 'id');
    }

    public function voliArrivo()
    {
        return $this->hasMany(Voli::class, 'aereoportoArrivo_id', 'id');
    }

}
