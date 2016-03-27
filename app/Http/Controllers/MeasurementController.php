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
    private $definitions = [
        [ 'type' => 'weight',  'name' => 'Weight',      'unit' => 'kg' ],
        [ 'type' => 'bodyfat', 'name' => 'Body Fat',    'unit' => '%' ],
        [ 'type' => 'tbw',     'name' => 'Body Water',  'unit' => '%' ],
        [ 'type' => 'muscle',  'name' => 'Muscle Mass', 'unit' => '%' ],
        [ 'type' => 'bone',    'name' => 'Bone Mass',   'unit' => 'grams' ],
    ];

    protected $measurements;

    public function __construct(MeasurementRepository $measurements)
    {
        $this->middleware('auth', ['except' => ['dashboard', 'index']]);
        $this->measurements = $measurements;
    }

    public function index()
    {
        return view('measurements.index');
    }

    public function dashboard(Request $request, User $user = null) {
        if ($user->id) {
            $measurements = $this->measurements->forUser($user);
        } else {
            if (!$request->user()) {
                return redirect('/');
            }
            $measurements = $this->measurements->forUser($request->user());
        }

        return view('measurements.dashboard', [
            'measurements' => $measurements,
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
        $this->authorize('destroy', $measurement);

        $measurement->delete();

        return redirect('/dashboard');
    }

    public function chart(Request $request, $type, User $user = null) {
        $def = null;
        $id = null;

        if ($user->id) {
            $id  = $user->id;
        }

        foreach ($this->definitions as $key => $value) {
            if ($value['type'] == $type) {
                $def = $this->definitions[$key];
            }
        }

        if ($def == null) return redirect('/dashboard');

        return view('measurements.chart', [
            'def' => $def,
            'id' => $id,
        ]);
    }

    public function chartJson(Request $request, $type) {
        $data = null;

        $measurements = $this->measurements->forUser($request->user());

        foreach ($this->definitions as $key => $value) {
            if ($value['type'] == $type) {
                $data = [];
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

        if ($data == null) return redirect('/dashboard');        

        return response()->json($data);
    }
}
