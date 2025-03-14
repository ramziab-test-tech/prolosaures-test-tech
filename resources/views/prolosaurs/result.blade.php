@extends('layouts.base')

@section('title', 'Résultat')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg text-center">
        <h1 class="text-2xl font-bold text-green-600">Résultats </h1>

        <div class="mt-4 space-y-3">
            <p class="text-lg"><strong>Surface Protégée :</strong> {{ $surface }} unités</p>
        </div>

        <a href="{{ route('prolosaurs.form') }}"
           class="mt-4 inline-flex items-center bg-blue-500 text-white text-sm px-3 py-1.5 rounded-md hover:bg-blue-600 transition-all ">
             Retour
        </a>

    </div>
@endsection
