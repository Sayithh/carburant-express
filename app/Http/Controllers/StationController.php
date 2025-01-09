<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Carburant;

class StationController extends Controller
{
    public function index(Request $request)
    {
        $ville = $request->input('ville');
        $response = Http::get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records', 
        [
            'where' => "ville = '{$ville}' and carburants_disponibles=''"
            //'and where' => "carburants_disponibles" = '' //
        ]);
        $stationsDonnees = $response->json();
        $stations = $stationsDonnees['results'];
        return view('stations.index', ['stations' => $stations]);
    }

    public function create()
    {

        $carburants = Carburant::all();
        
        return view('stations.create', ['carburants' => $carburants]);
    }
}

