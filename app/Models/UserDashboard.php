<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDashboard extends Model
{
    use HasFactory;

    protected $table = 'user_dashboards';

    protected $fillable = [
        'user_id',
        'layout',
        'name',
        'description', // 👈 ضروري تزيد هادي هنا
    ];

    protected $casts = [
        'layout' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(Employee::class, 'user_id');
    }
}