@extends('layouts.app')
@section('content')

    <h1>Carte des stations-service</h1>

    <form method="GET" action="{{ route('stations.index') }}">
    @csrf
        <input type="text" name="ville" value="{{  $ville ?? '' }}">
        <button type="submit">Rechercher</button>
    </form>

    <form action="{{ route('stations.store') }}" method="POST">
        @csrf
        
        <label for="carburant">Sélectionnez un carburant :</label>
        <select name="idcarburant" id="carburant">
            @foreach($carburants as $carburant)
                <option value="{{ $carburant->idcarburant }}">{{ $carburant->nomCarburant }}</option>
            @endforeach
        </select>
        
        <button type="submit">Ajouter</button>
    </form>

    <div id="mapid" style= "height: 100vh; width: 100vh"></div>
    
    

<script>
    var mymap = L.map("mapid").setView([{{ $stations['0']["geom"]["lat"] }}, {{ $stations['0']["geom"]["lon"] }}], 13);
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 18,
        attribution:
      'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        id: "mapbox/streets-v11",
        tileSize: 512,
        zoomOffset: -1,
    }).addTo(mymap);
    @foreach ($stations as $station) 
        L.marker([{{ $station["geom"]["lat"] }}, {{ $station["geom"]["lon"] }}]).addTo(mymap)
    @endforeach
</script>
@endsection

