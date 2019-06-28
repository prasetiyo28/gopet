<?php

namespace App\Http\Controllers\Api;

use App\Diagnosis;
use App\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DiagnosisController extends Controller
{
    public function showByUser($user_id)
    {
        $diagnosis = Diagnosis::where('user_id', $user_id)->get();
        if (is_null($diagnosis)) {
            return response()->json(array('message' => 'record not found', 'status' => false), 200);
        } else {
            return response()->json(Response::transform($diagnosis, "all diagnosis found", true), 200);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'doctor_id' => 'required',
            'user_id' => 'required',
            'pet_name' => 'required',
            'diagnosis' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'message' => 'check your request again',
                'status' => false), 400);
        } else {
            $diagnosis = new Diagnosis();
            $diagnosis->doctor_id = $request->doctor_id;
            $diagnosis->user_id = Auth::user()->id;
            $diagnosis->pet_name = $request->pet_name;
            $diagnosis->diagnosis = $request->diagnosis;
            $diagnosis->save();
            return response()->json(
                Response::transform($diagnosis, "A new diagnosis has been created", true), 201
            );
        }
    }
}
