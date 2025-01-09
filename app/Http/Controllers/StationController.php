<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Carburant;
use GuzzleHttp\Client;
use League\CommonMark\Node\Query\AndExpr;

class StationController extends Controller
{
    public function index(Request $request)
    {
        // on récupère la ville et le type de carburant depuis la requête
        $ville = $request->input('ville');
        $carburant = $request->input('carburant');

        // convertit le type de carburant en texte pour la requête
        switch($carburant) {
            case '1':
                $carburant = 'Gazole';
                break;
            case '2':
                $carburant = 'SP95';
                break;
            case '3':
                $carburant = 'E10';
                break;
            case '4':
                $carburant = 'SP98';
                break;
            case '5':
                $carburant = 'GPLc';
                break;
            case '6':
                $carburant = 'E85';
                break;
            default:
                $carburant = 'Gazole';
        }

        // on récupère les données des stations depuis l'API
        $response = Http::withOptions([
            'verify' => false, // on désactive la vérification SSL pour cause : un problème avec le certificat SSL du serveur
        ])->get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records', 
        [
            'where' => "ville = '$ville' AND carburants_disponibles= '$carburant' ",
        ]);

        $stationsDonnees = $response->json();
        $stations = $stationsDonnees['results'];
        
        // on retourne la view avec les données des stations
        return view('stations.index', ['stations' => $stations]);
    }
}