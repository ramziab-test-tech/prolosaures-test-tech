@extends('layouts.base')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-2xl font-bold text-center text-blue-600">Prolosaures</h1>
        <p class="text-gray-600 text-center mb-4">Calcule de la surface d'abri disponible.</p>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('prolosaurs.calculate') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium text-gray-700">Largeur du continent :</label>
                <input type="text" id="continentWith" name="continentWith" placeholder="Ex: 10"
                       class="w-full border border-gray-400 rounded-lg p-3 text-lg text-gray-700 placeholder-gray-400" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Altitudes :</label>
                <input type="text" name="altitudes" id="altitudes" placeholder="Ex: 10 20 15 30"
                       class="w-full border border-gray-400 rounded-lg p-3 text-lg text-gray-700 placeholder-gray-400" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Calculer
                </button>
                <button type="button" id="generateRandom" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                    Générer Aléatoirement
                </button>
            </div>
        </form>
    </div>

    <script>
        window.app_config = {
            altitudeMax: {{ config('constants.ALTITUDE.MAX') }},
            continentWidthMax: {{ config('constants.CONTINENT_WIDTH.MAX') }}
        };
        document.getElementById('generateRandom').addEventListener('click', function() {
                let continentWith = Math.floor(Math.random() * window.app_config.continentWidthMax) + 1;
                let values = [];
                for (let i = 0; i < continentWith; i++) {
                    values.push(Math.floor(Math.random() * window.app_config.altitudeMax) + 1);
                }
                document.getElementById('altitudes').value = values.join(' ');
                document.getElementById('continentWith').value = continentWith;
        });
    </script>
@endsection
