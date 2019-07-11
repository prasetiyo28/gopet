<?php

namespace App\Http\Controllers;

use App\Food;
use App\UserPetshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.food.food', [
            'foods' => $foods,
            'total' => $foods->total(),
            'perPage' => $foods->perPage(),
            'currentPage' => $foods->currentPage(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userPetshops = UserPetshop::all();
        return view('admin.food.create', [
            'userPetshops' => $userPetshops
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png|max:1024',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'id_petshop' => 'required',
            'category' => '',
            'description' => ''
        ]);

        $food = new Food();
        $image = $request->file('image')->store('foods');
        $food->image = $image;
        $food->name = $request->name;
        $food->price = $request->price;
        $food->id_petshop = $request->id_petshop;
        $food->category = $request->category;
        $food->description = $request->description;
        $food->save();

        return redirect()->route('admin.food')->with(['success' => 'A new food has been created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food = Food::find($id);
        $userPetshops = UserPetshop::all();
        return view('admin.food.edit', [
            'food' => $food,
            'userPetshops' => $userPetshops
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png|max:1024',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'id_petshop' => 'required',
            'category' => '',
            'description' => ''
        ]);

        $food = Food::where('id', $id)->first();
        if ($request->image != null) {
            if ($food->image != 'default.png') {
                Storage::delete($food->image);
            }
            $image = $request->file('image')->store('foods');
            $food->image = $image;
        }
        $food->name = $request->name;
        $food->price = $request->price;
        $food->id_petshop = $request->id_petshop;
        $food->category = $request->category;
        $food->description = $request->description;
        $food->update();
        return redirect()->route('admin.food')->with(['success' => 'A chosen food has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::find($id);
        $food->delete();
        return redirect()->route('admin.food')->with(['success' => 'A chosen food has been removed']);
    }
}
