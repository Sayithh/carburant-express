@extends('layouts.app')
@section('content')
    <h1>Carte des stations-service</h1>
    <div id="mapid"></div>

<script>
    var mymap = L.map("mapid").setView([47.4661788, -0.5560418], 13);
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

