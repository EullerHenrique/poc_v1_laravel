<form action="{{ $action }}" method="post">
    @csrf
    <div class="row mb-3">
        <div class="col-8">
            <label for="name" class="form-label">Nome:</label>
            <input type="text"
                   autofocus
                   id="name"
                   name="name"
                   class="form-control">
        </div>

        <div class="col-2">
            <label for="seasonsQty" class="form-label">Nº Temporadas:</label>
            <input type="text"
                   id="seasonsQty"
                   name="seasonsQty"
                   class="form-control">
        </div>

        <div class="col-2">
            <label for="episodesPerSeason" class="form-label">Eps / Temporada:</label>
            <input type="text"
                   id="episodesPerSeason"
                   name="episodesPerSeason"
                   class="form-control">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Adicionar</button>
</form>