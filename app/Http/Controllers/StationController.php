<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StationController extends Controller
{
    public function index()
{
    $response = Http::get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records');

    if ($response->successful()) {
        $responseData = $response->json();
        Log::info('API Response:', $responseData);

        if (isset($responseData['records'])) {
            $stationsData = $responseData['records'];
        } else {
            Log::error('Le champ "records" n\'a pas été trouvé dans la réponse de l\'API.');
            $stationsData = [];
        }

        return view('stations.index', compact('stationsData'));
    } else {
        Log::error('API Error: ' . $response->status());
        Log::error('API Response: ' . $response->body());
        return response()->json(['error' => 'Impossible de récupérer les données de l\'API'], 500);
    }
}

}
