<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

// 🚨 MODIFIEZ CECI : Le modèle DOIT étendre Authenticatable
class Employee extends Authenticatable
{
    //
    use HasFactory;
    use HasFactory, Notifiable; // ✅ هنا الحل

    // Indique les champs qui peuvent être insérés (sécurité)
    protected $fillable = [
         'name',
        'email',
        'password',
        'departement',
        'role',
        'company',
        'client_id' // <--- ضروري تزيد هادي هنا
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    // كل employee مرتبط ب client واحد
public function client()
{
   return $this->belongsTo(Client::class, 'client_id');
}


// dashboards ديال هاد employee
public function dashboards()
{
    return $this->hasMany(UserDashboard::class, 'user_id');
}

// helpers باش تسهل RBAC
public function isAdmin()
{
    return $this->role === 'admin';
}

public function isAdminClient()
{
    return $this->role === 'admin_client';
}

public function isUser()
{
    return $this->role === 'user';
}

}
