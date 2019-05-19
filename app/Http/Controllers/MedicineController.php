<?php

namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
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
        $medicines = Medicine::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.medicine.medicine', [
            'medicines' => $medicines,
            'total' => $medicines->total(),
            'perPage' => $medicines->perPage(),
            'currentPage' => $medicines->currentPage(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.medicine.create');
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
            'seller' => 'required|string',
            'category' => '',
            'description' => ''
        ]);

        $medicine = new Medicine();
        $image = $request->file('image')->store('medicines');
        $medicine->image = $image;
        $medicine->name = $request->name;
        $medicine->price = $request->price;
        $medicine->seller = $request->seller;
        $medicine->category = $request->category;
        $medicine->description = $request->description;
        $medicine->save();

        return redirect()->route('admin.medicine')->with(['success' => 'A new medicine has been created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medicine = Medicine::find($id);
        return view('admin.medicine.edit', [
            'medicine' => $medicine,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png|max:1024',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'seller' => 'required|string',
            'category' => '',
            'description' => ''
        ]);

        $medicine = Medicine::find($id);
        if ($request->image != null) {
            if ($medicine->image != 'default.png') {
                Storage::delete($medicine->image);
            }
            $image = $request->file('image')->store('medicines');
            $medicine->image = $image;
        }
        $medicine->name = $request->name;
        $medicine->price = $request->price;
        $medicine->seller = $request->seller;
        $medicine->category = $request->category;
        $medicine->description = $request->description;
        $medicine->update();
        return redirect()->route('admin.medicine')->with(['success' => 'A chosen medicine has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicine = Medicine::find($id);
        $medicine->delete();
        return redirect()->route('admin.medicine')->with(['success' => 'A chosen medicine has been removed']);
    }
}
