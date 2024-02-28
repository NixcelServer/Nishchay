<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HrController extends Controller
{
    public function dashBoard()
    {
        return view('frontend_hr.hr_home');
    }

    public function showemployee()
    {
        return view('frontend_hr.new_employee_registration');
    }

    public function addemployee()
    {
        return view('frontend_hr.add_new_employee_form');
    }

}
