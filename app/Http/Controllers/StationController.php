<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StationController extends Controller
{
    public function index()
    {
        $response = Http::get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records');
        $stationsDonnees = $response->json();
        $stations = $stationsDonnees['results'];
        return view('stations.index', ['stations' => $stations]);

        
    }
}
