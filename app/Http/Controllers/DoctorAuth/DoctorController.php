<?php

namespace App\Http\Controllers\DoctorAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doctor');
    }

    public function index()
    {
        return view('doctor.app');
    }
}
