<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Measurement;
use App\User;
use App\Repositories\MeasurementRepository;

class MeasurementController extends Controller
{
    protected $measurements;

    public function __construct(MeasurementRepository $measurements)
    {
        $this->middleware('auth');
        $this->measurements = $measurements;
    }

    public function indexself(Request $request) {
        return view('measurements.index', [
            'measurements' => $this->measurements->forUser($request->user()),
        ]);
    }

    public function indexother(Request $request, User $user) {
        return view('measurements.index', [
            'measurements' => $this->measurements->forUser($user),
        ]);
    }

    public function add(Request $request) {
        return view('measurements.add');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'date'    => 'required|date_format:Y-n-j',
            'weight'  => 'required|numeric',
            'bodyfat' => 'required|numeric',
            'tbw'     => 'required|numeric',
            'muscle'  => 'required|numeric',
            'bone'    => 'required|numeric',
        ]);

        $request->user()->measurements()->create([
            'date'    => $request->date,
            'weight'  => $request->weight,
            'bodyfat' => $request->bodyfat,
            'tbw'     => $request->tbw,
            'muscle'  => $request->muscle,
            'bone'    => $request->bone,
        ]);

        return redirect('/measurements');
    }

    public function destroy(Request $request, Measurement $measurement) {
        //$this->authorize('destroy', $measurement);

        $measurement->delete();

        return redirect('/measurements');
    }
}
