<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // جميع الموظفين ديال هاد client
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    // جميع dashboards ديال هاد client
    public function dashboards()
    {
        return $this->hasMany(UserDashboard::class);
    }
}
