<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 

// 🚨 MODIFIEZ CECI : Le modèle DOIT étendre Authenticatable
class Employee extends Authenticatable
{
    //
    use HasFactory;

    // Indique les champs qui peuvent être insérés (sécurité)
    protected $fillable = [
         'name',
        'email',
        'password',
        'departement',
        'role',
        'company',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
