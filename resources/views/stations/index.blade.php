
@extends('layouts.app')
@section('content')

    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-center mb-8">Carte des stations-service</h1>

        <div class="flex flex-wrap md:flex-nowrap">
            <div class="w-full md:w-1/3 p-4 bg-white shadow-lg rounded-lg">
                <form method="GET" action="{{ route('stations.index') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="ville" class="block text-lg font-medium text-gray-700">Ville</label>
                        <input type="text" name="ville" id="ville" value="{{ request('ville') ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    {{-- La fonction request permet de récup les valeurs soumises lors de l'envoie du formulaire et de les remettre dans les champs du formulaire --}}
                    <fieldset>
                        <legend class="text-lg font-medium text-gray-700">Type de Carburant</legend>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="carburant" value="1" {{ request('carburant') == '1' ? 'checked' : '' }} class="form-radio text-indigo-600">
                                <span class="ml-2">Gazole</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="carburant" value="2" {{ request('carburant') == '2' ? 'checked' : '' }} class="form-radio text-indigo-600">
                                <span class="ml-2">SP95</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="carburant" value="3" {{ request('carburant') == '3' ? 'checked' : '' }} class="form-radio text-indigo-600">
                                <span class="ml-2">E10</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="carburant" value="4" {{ request('carburant') == '4' ? 'checked' : '' }} class="form-radio text-indigo-600">
                                <span class="ml-2">SP98</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="carburant" value="5" {{ request('carburant') == '5' ? 'checked' : '' }} class="form-radio text-indigo-600">
                                <span class="ml-2">GPLc</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="carburant" value="6" {{ request('carburant') == '6' ? 'checked' : '' }} class="form-radio text-indigo-600">
                                <span class="ml-2">E85</span>
                            </label>
                        </div>
                    </fieldset>
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Rechercher</button>
                </form>
            </div>

            <div class="w-full md:w-2/3 p-4">
                <div id="mapid" style="height: 500px;" class="rounded-lg shadow-lg"></div>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-center mt-8">Résultats de la recherche</h2>
        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white shadow-lg rounded-lg">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Adresse</th>
                        <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Carburant</th>
                        <th class="px-4 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Prix</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stations as $station)
                        <tr>
                            <td class="px-4 py-2 border-b border-gray-200">{{ $station['adresse'] }}</td>
                            <td class="px-4 py-2 border-b border-gray-200">
                                {{-- on affiche le carburant sélectionné dans le form--}}
                                @php
                                    $carburantSelectionne = null;
                                    $prixCarburantSelectionne = null;
                                    if (isset($station['prix'])) {
                                        $prixCarburants = json_decode($station['prix'], true);
                                        foreach ($prixCarburants as $carburant) {
                                            if ($carburant['@id'] == request('carburant')) {
                                                $carburantSelectionne = $carburant['@nom'];
                                                $prixCarburantSelectionne = $carburant['@valeur'];
                                                break;
                                            }
                                        }
                                    }
                                @endphp
                                {{ $carburantSelectionne ?? 'Indisponible' }}
                            </td>
                            <td class="px-4 py-2 border-b border-gray-200">
                                {{-- on affiche le prix du carburant sélectionné --}}
                                {{ $prixCarburantSelectionne ?? 'Indisponible' }} €
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        @if(isset($ville) && !is_null($ville))
            // Ce setView centre la map sur la ville recherchée dans l'input uniquement si la ville est écrite dans l'input 
            var mymap = L.map("mapid").setView([{{ $stations[0]["geom"]["lat"] }}, {{ $stations[0]["geom"]["lon"] }}], 13);
        @else
            // sinon on centre la map sur la ville d'Angers Par défaut
            var mymap = L.map("mapid").setView([47.4661788, -0.5560418], 13);
        @endif
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            id: "mapbox/streets-v11",
        }).addTo(mymap);

        @foreach ($stations as $station)
            // on ajoute un marqueur pour chaque station sur la carte
            var marker = L.marker([{{ $station["geom"]["lat"] }}, {{ $station["geom"]["lon"] }}]).addTo(mymap);

            // l'affichage des carburants disponibles et leurs prix respectifs dans la pop up (hors adresse et ville) a été réalisé  
            // par copilot car j'aimais vraiment l'affichage proposé  mais j'ai compris la logique derrière le code qu'il ma fournit

            // on prépare le contenu de la popup avec l'adresse et la liste des carburants disponibles et leurs prix
            var popupContent = "<b>Adresse :</b> {{ $station['adresse'] }}, {{ $station['ville'] }}<br><b>Carburants disponibles :</b><ul>";
            @if(isset($station['prix']))
                @foreach (json_decode($station['prix'], true) as $carburant)
                    popupContent += "<li>{{ $carburant['@nom'] }} : {{ $carburant['@valeur'] }} €</li>";
                @endforeach
            @else
                popupContent += "<li>Indisponible</li>";
            @endif
            popupContent += "</ul>";

            // on associe le content de la popup au marqueur pour qu'il s'affiche lorsque le marqueur est cliqué
            marker.bindPopup(popupContent);
        @endforeach
    </script>

@endsection