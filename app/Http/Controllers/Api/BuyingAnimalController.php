<?php

namespace App\Http\Controllers\Api;

use App\BuyingAnimal;
use App\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyingAnimalController extends Controller
{
    public function index()
    {
        return response()->json(Response::transform(BuyingAnimal::all(), 'All Animals found', true), 200);
    }
}
