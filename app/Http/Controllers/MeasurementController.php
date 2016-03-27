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
        $this->middleware('auth', ['except' => ['dashboardOther', 'index']]);
        $this->measurements = $measurements;
    }

    public function index()
    {
        return view('measurements.index');
    }

    public function dashboardSelf(Request $request) {
        return view('measurements.dashboard', [
            'measurements' => $this->measurements->forUser($request->user()),
        ]);
    }

    public function dashboardOther(Request $request, User $user) {
        return view('measurements.dashboard', [
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

        return redirect('/dashboard');
    }

    public function destroy(Request $request, Measurement $measurement) {
        //$this->authorize('destroy', $measurement);

        $measurement->delete();

        return redirect('/dashboard');
    }

    public function chart(Request $request, $type) {
        $definitions = [
            [ 'type' => 'weight', 'title' => 'Weight', 'unit' => 'kg' ],
            [ 'type' => 'bodyfat', 'title' => 'Body Fat', 'unit' => '%' ],
            [ 'type' => 'tbw', 'title' => 'Body Water', 'unit' => '%' ],
            [ 'type' => 'muscle', 'title' => 'Muscle Mass', 'unit' => '%' ],
            [ 'type' => 'bone', 'title' => 'Bone Mass', 'unit' => 'grams' ],
        ];

        foreach ($definitions as $key => $value) {
            if ($value['type'] == $type) {
                $info = $definitions[$key];
            }
        }

        $info['pagetitle'] = $info['title'] . " - " . $info['unit'];

        return view('measurements.chart', [
            'info' => $info,
        ]);
    }

    public function chartJson(Request $request, $type) {
        $definitions = [
            [ 'type' => 'weight' ],
            [ 'type' => 'bodyfat' ],
            [ 'type' => 'tbw' ],
            [ 'type' => 'muscle' ],
            [ 'type' => 'bone' ],
        ];

        $measurements = $this->measurements->forUser($request->user());

        $data = [];

        foreach ($definitions as $key => $value) {
            if ($value['type'] == $type) {
                foreach ($measurements as $key2 => $value2) {
                    $time = strtotime ($value2->date);
                    $date = strftime ("%Y-%m-%d", $time);
                    $data[] = [
                        $date,
                        (float) $value2->{$type}
                    ];
                }
            }
        }

        return response()->json($data);
    }
}
