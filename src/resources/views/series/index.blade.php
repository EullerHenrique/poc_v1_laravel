<x-layout title="Series">

    @isset($mensagemSucesso)
    <div class="alert alert-success">
        {{ $mensagemSucesso }}
    </div>
    @endisset

    <a href={{route('series.create')}} class="btn btn-dark mb-2">Adicionar Série</a>
    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $serie->name }}
            <form action={{route('series.destroy', $serie->id)}} method="post" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">
                    X
                </button>
            </form>
        </li>
        @endforeach
    </ul>
</x-layout>

