<?php

namespace App\Http\Controllers;

use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DoctorController extends Controller
{
    /**
     * DoctorController constructor.
     */
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
        $doctors = Doctor::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.doctor.doctor', [
            'doctors' => $doctors,
            'total' => $doctors->total(),
            'perPage' => $doctors->perPage(),
            'currentPage' => $doctors->currentPage(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.doctor.create');
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
            'name' => 'required',
        ]);

        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->save();

        $doctor = Doctor::where('id', $doctor->id)->first();

        $randomFilename = Str::random(32);
        QrCode::size(500)->format('png')->generate($doctor->id, public_path("images/qrcode/" . $randomFilename . ".png"));

        $doctor->qrcode = "qrcode/" . $randomFilename . ".png";
        $doctor->update();

        return redirect()->route('admin.doctor')->with(['success'=>'A new doctor has been created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = Doctor::find($id);
        return view('admin.doctor.edit', [
            'doctor' => $doctor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $doctor = Doctor::find($id);
        $doctor->name = $request->name;

        $doctor->update();
        return redirect()->route('admin.doctor')->with(['success'=>'A chosen doctor has been updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();
        return redirect()->route('admin.doctor')->with(['success'=>'A chosen doctor has been deleted successfully']);
    }
}
