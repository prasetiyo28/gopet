<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\Response;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserPetshopController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function history() {
        $histories = Order::where('id_user', Auth::user()->id)->get();
        // return response()->json(Response::transform($histories, "All histories found", true), 200);
        $result=[];
        foreach($histories as $history){
            $result[] = [
                'id' => $history->id,
                'id_user' => $history->user->id,
                'user' => $history->user->name,
                'id_petshop' => $history->userPetshop->id,
                'petshop' => $history->userPetshop->name,
                'id_item' => $history->item->id,
                'item' => $history->item->name,
                'price' => $history->item->price,
                'status' => $history->status,
                'created_at' => $history->created_at->format('d-M-Y')
            ];
        }

        if ($result==[]) {
            return response()->json(array('message' => 'record not found', 'status' => false), 200);
        }else{
            return response()->json(
                [
                    'message' => "All Histories Found",
                    'status' => true,
                    'data' => $result
                ], 200
            );
        }
    }

    public function store(Request $request) {
        $rules = [
            'id_petshop' => 'required',
            'id_item' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'message' => 'check your request again',
                'status' => false), 400);
        } else {
            $order = new Order();
            $order->id_user = Auth::user()->id;
            $order->id_petshop = $request->id_petshop;
            $order->id_item = $request->id_item;
            $order->save();

            return response()->json(
                Response::transform($order, "An order has been created", true), 201
            );
        }
    }
}
