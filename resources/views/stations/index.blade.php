@extends('layouts.app')

@section('content')
    <h1>Carte des stations-service</h1>
    <div id="map" style="height: 600px; width: 100%;"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([47.478419, -0.563166], 6); // Coordonnées initiales (France)

            // Ajouter le fond de carte OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            // Ajouter les markers pour chaque station
            @foreach ($stationsData as $station)
                @php
                    $fields = $station['fields'] ?? null;
                    $coordinates = $fields ? [$fields['latitude'] ?? null, $fields['longitude'] ?? null] : [null, null];
                    $address = $fields['adresse'] ?? 'Non renseignée';
                    $price = $fields['prix'] ?? 'Non renseigné';
                @endphp

                @if ($coordinates[0] && $coordinates[1])
                    L.marker([{{ $coordinates[0] }}, {{ $coordinates[1] }}])
                        .addTo(map)
                        .bindPopup("<b>{{ $address }}</b><br>Prix: {{ $price }}€");
                @endif
            @endforeach
        });
    </script>
@endsection
