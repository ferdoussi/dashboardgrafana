<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    // زيد هاد السطر باش تأكد بلي كيقرا من نفس الجدول اللي جربنا فيه الـ Query
    protected $table = 'panels'; 

    protected $fillable = ['name', 'grafana_url', 'module', 'category', 'active'];
}

