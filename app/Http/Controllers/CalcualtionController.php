<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalcualtionController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function a(){
        return 2;
    }

    public function b(){
        return 6;
    }
    public function __invoke(Request $request)
    {
        $x = 2;
        $y = '3.5';
        return $x * $y ;
    }
}
