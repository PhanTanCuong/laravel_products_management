<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Calculation2ndController extends Controller
{
    public function a(){
        return 2;
    }

    public function b(){
        return 6;
    }

    public function c(){
        return $this->a() * $this->b();
    }
}
