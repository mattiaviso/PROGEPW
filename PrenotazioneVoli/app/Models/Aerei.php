<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aerei extends Model
{
    use HasFactory;
    protected $table = "aerei";

    protected $fillable = ['nomeModello','capacita'];

    public function voli()
    {
        return $this->hasMany(Voli::class, 'aereo_id','id');
    }

}
