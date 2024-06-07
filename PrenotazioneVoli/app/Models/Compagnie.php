<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compagnie extends Model
{
    use HasFactory;

    protected $table = "compagnie";

    protected $fillable = ['nome', 'anno_fondazione', 'sede', 'country'];

    public function voli()
    {
        return $this->hasMany(Voli::class, 'compagnia_id', 'id');
    }

    public function clienti()
    {
        return $this->hasMany(Clienti::class, 'compagnia_id', 'id');
    }
}
