<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VariableScopeController extends Controller
{
    public $a = 10;
    public $course = "BSIT";

    public function index()
    {
        $student = "Lester";
        $message = "Hello, World!, $student";

        return response()->json([
            'student' => $student,
            'message' => $message,
            'course' => $this->course,
        ]);
    }

    public function read()
    {
        $greetingsName = $this->greet("Lester");

        return response()->json([
            'course' => $this->course,
            'greetings' => $greetingsName,
        ]);
    }

    public function greet($name)
    {
        return "Hello, $name!";
    }
}
