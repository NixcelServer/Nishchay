<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QueryController extends Controller
{
    public function ShowQueries()
    {
       

        return view('frontend_manager.query');
    }
    public function ShowQueriesDev()
    {
       

        return view('frontend_developer.queries');
    }
}
