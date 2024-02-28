<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HrController extends Controller
{
    //When HR logs in show HR Dashboard
    public function dashboard()
    {
        dd("HR dashboard");
    }

    public function showEmployees()
    {
        return view('hr.employees');
    }
}
