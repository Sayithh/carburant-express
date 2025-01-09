
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-center items-center h-screen">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Bienvenue sur Carburant Express</h1>
            <a href="{{ route('stations.index') }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                Accéder à Carburant Express
            </a>
        </div>
    </div>
</div>
@endsection

