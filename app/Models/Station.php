<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_postal', 'adresse', 'ville', 'horaires', 'rupture',
        'fermeture', 'geom', 'mise_a_jour', 'prix_id', 'prix',
        'carburant', 'services', 'region', 'departement'
    ];
    

}
