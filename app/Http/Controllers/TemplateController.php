<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
   public function index()
   {
      return view('frontend_home.home');
   }

   public function leftmenu()
   {
      return view('frontend_home.leftmenu');
   }

   public function dashboard()
   {
      return view('frontend_home.dashboard');
   }
}
