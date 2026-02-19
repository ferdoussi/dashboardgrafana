<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class SupportController extends Controller
{
    public function index() {
        return view('support.support');
    }
    public function allUser(){
        return View('clientFile.allUser');
    }

}
