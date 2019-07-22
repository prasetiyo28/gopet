<?php

namespace App\Http\Controllers\DoctorAuth;

use App\Diagnosis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doctor');
    }

    public function index()
    {
        return view('doctor.home');
    }

    public function diagnosa()
    {
        $diagnosis = Diagnosis::where('id_doctor', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('doctor.diagnosa.diagnosa', [
            'diagnosis' => $diagnosis,
            'total' => $diagnosis->total(),
            'perPage' => $diagnosis->perPage(),
            'currentPage' => $diagnosis->currentPage(),
        ]);
    }

    public function updateDiagnosa(Request $request, $id)
    {
        $this->validate($request, [
            'diagnosa' => 'required',
        ]);
        $diagnosa = Diagnosis::find($id);
        $diagnosa->diagnosis = $request->diagnosa;
        $diagnosa->update();
        return redirect()->route('doctor.diagnosa')->with(['success' => 'Diagnosa has been inserted on selected record']);
    }
}
