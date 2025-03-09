<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function dashboard()
    {
        return view('supervisor.index');
    }
}
