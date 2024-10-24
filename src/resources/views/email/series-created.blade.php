
@component('mail::message')

# {{$nomeSerie}}

A série {{$nomeSerie}} com as temporadas {{$qtdTemporadas}} e episódios {{$episodiosPorTemporada}} foi criada com sucesso.

Acesse aqui:

@component('mail::button', ['url' => route('seasons.index', $serieId)])
Ver série
@endcomponent

@endcomponent
