<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\Response;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserPetshopController extends Controller
{

    public function history($id) {
        $histories = Order::where('id_user', $id)->get();
        return response()->json(Response::transform($histories, "All histories found", true), 200);
    }

    public function store(Request $request) {
        $rules = [
            'id_user' => 'required',
            'id_petshop' => 'required',
            'id_food' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'message' => 'check your request again',
                'status' => false), 400);
        } else {
            $order = new Order();
            $order->id_user = $request->id_user;
            $order->id_petshop = $request->id_petshop;
            $order->id_food = $request->id_food;
            $order->save();

            return response()->json(
                Response::transform($order, "An order has been created", true), 201
            );
        }
    }
}
