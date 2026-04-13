<?php

namespace App\Events;

use App\Models\Employee;
use Illuminate\Foundation\Events\Dispatchable;

class UserCreated
{
    use Dispatchable;

    public $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }
}