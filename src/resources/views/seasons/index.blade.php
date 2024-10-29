<x-layout title="Temporadas de {!! $serie->name !!}">
    <div class="d-flex justify-content-center">
        <img
            style="height: 200px;"
            src="{{ asset('storage/' . $serie->cover) }}"
            alt="Capa da série"
            class="img-fluid">
    </div>
    <ul class="list-group">
        @foreach ($seasons as $season)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('episodes.index', $season->id) }}">
                Temporada {{ $season->number }}
            </a>
            <span class="badge bg-secondary">
                {{$season->numberOfWatchedEpisodes() }} / {{ $season->episodes->count() }}
            </span>
        </li>
        @endforeach
    </ul>
</x-layout>
