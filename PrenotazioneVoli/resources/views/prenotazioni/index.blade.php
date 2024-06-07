@extends('layouts.master')

@section('title', 'Lista Prenotazioni')

@section('body')

<!-- STAMPA LA LISTA DELLE prenotazioni-->
<div class="container mt-5">
    <h2 class="mb-4">Lista delle Prenotazioni</h2>
    <div class="row">
        @foreach ($prenotazioni as $prenotazione)
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center airport-info">
                            <span>
                                <h5>DA: {{ $prenotazione->volo->aereoportoPartenza->city }}
                                    ({{$prenotazione->volo->aereoportoPartenza->codice_iata}})
                            </span>
                            <i class="fas fa-plane"></i>
                            <span>A:
                                {{ $prenotazione->volo->aereoportoArrivo->city }}
                                ({{$prenotazione->volo->aereoportoArrivo->codice_iata}})
                            </span>
                            </h5>
                        </div>


                        <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse"
                            data-target="#details-{{ $prenotazione->id }}" aria-expanded="false"
                            aria-controls="details-{{ $prenotazione->id }}">
                            Dettagli
                        </button>

                        <button class="btn btn-warning btn-sm" type="button" data-toggle="collapse"
                            data-target="#edit-{{ $prenotazione->id }}" aria-expanded="false"
                            aria-controls="edit-{{ $prenotazione->id }}">
                            Modifica
                        </button>

                        <button class="btn btn-danger btn-sm" type="button" data-toggle="collapse"
                            data-target="#delete-{{ $prenotazione->id }}" aria-expanded="false"
                            aria-controls="delete-{{ $prenotazione->id }}">
                            Elimina
                        </button>

                        <div class="collapse mt-3" id="details-{{ $prenotazione->id }}">
                            <div class="card card-body">
                                <h5>Dettagli del Volo</h5>
                                <p>Numero del Volo: {{ $prenotazione->volo->numeroVolo }}</p>
                                <p>Data e Ora di Partenza: {{ $prenotazione->volo->orarioPartenza }}</p>
                                <p>Data e Ora di Arrivo: {{ $prenotazione->volo->orarioArrivo }}</p>
                                <h5>Dettagli della Prenotazione</h5>
                                <p class="card-text">Posti Prenotati: {{ $prenotazione->passeggeri->count() }}</p>
                                <p class="card-text">Prenotazione Effettuata il {{ $prenotazione->dataPrenotazione }}</p>
                                <h5>Dettagli dei Passeggeri</h5>
                                @foreach ($prenotazione->passeggeri as $p)
                                    <p>{{ $p->nome }} {{ $p->cognome }}</p>
                                @endforeach
                            </div>
                        </div>

                        <div class="collapse mt-3" id="edit-{{ $prenotazione->id }}">
                            <div class="card card-body">
                                <h5>Modifica Passeggeri</h5>
                                <button type="button" class="btn btn-primary aggiungiPasseggeroButton"
                                    data-preid="{{ $prenotazione->id }}">
                                    <i class="fas fa-plus"></i> Aggiungi Passeggero
                                </button>
                                <form action="{{ route('aggiorna') }}" method="post">

                                    @csrf
                                    @foreach ($prenotazione->passeggeri as $index => $pas)
                                        <div class="row mt-3">
                                            <div class="form-group col-md-6 ">
                                                <input type="hidden" name="idPre" value="{{ $prenotazione->id }}">
                                                <label for="nome">Nome passeggero {{ $index + 1 }}</label>
                                                <input type="text" class="form-control"
                                                    id="nome{{ $prenotazione->id }}_{{ $index }}" name="nome[]"
                                                    value="{{ $pas->nome }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="cognome">Cognome passeggero {{ $index + 1 }}</label>
                                                <input type="text" class="form-control"
                                                    id="cognome{{ $prenotazione->id }}_{{ $index }}" name="cognome[]"
                                                    value="{{ $pas->cognome }}">
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="addPass"></div>
                                    <button type="submit" class="btn btn-primary">Salva modifiche</button>
                                </form>
                            </div>
                        </div>

                        <div class="collapse mt-3" id="delete-{{ $prenotazione->id }}">
                            <div class="card card-body">
                                <h5>Elimina Prenotazione</h5>
                                <p>Sei sicuro di voler eliminare la prenotazione?</p>
                                <p>Questa azione non è reversibile</p>
                                <form action="{{ route('prenotazioni.destroy', $prenotazione->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


<!--
<div class="container mt-5">
    <h2 class="mb-4">Lista delle Prenotazioni</h2>
    <div class="row">
        @foreach ($prenotazioni as $prenotazione)
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center airport-info">
                            <span>
                                <h5>DA: {{ $prenotazione->volo->aereoportoPartenza->city }}
                                    ({{$prenotazione->volo->aereoportoPartenza->codice_iata}})
                            </span>
                            <i class="fas fa-plane"></i>
                            <span>A:
                                {{ $prenotazione->volo->aereoportoArrivo->city }}
                                ({{$prenotazione->volo->aereoportoArrivo->codice_iata}})
                            </span>
                            </h5>
                        </div>
                        <div id="accordion-{{ $prenotazione->id }}">
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#details-{{ $prenotazione->id }}" aria-expanded="false"
                                        aria-controls="details-{{ $prenotazione->id }}">
                                        Dettagli
                                    </button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-warning btn-sm" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#edit-{{ $prenotazione->id }}" aria-expanded="false"
                                        aria-controls="edit-{{ $prenotazione->id }}">
                                        Modifica
                                    </button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#delete-{{ $prenotazione->id }}" aria-expanded="false"
                                        aria-controls="delete-{{ $prenotazione->id }}">
                                        Elimina
                                    </button>
                                </div>
                            </div>

                            <div class="collapse mt-3" id="details-{{ $prenotazione->id }}"
                                data-bs-parent="#accordion-{{ $prenotazione->id }}">
                                <div class="card card-body">
                                    <h5>Dettagli del Volo</h5>
                                    <p>Numero del Volo: {{ $prenotazione->volo->numeroVolo }}</p>
                                    <p>Data e Ora di Partenza: {{ $prenotazione->volo->orarioPartenza }}</p>
                                    <p>Data e Ora di Arrivo: {{ $prenotazione->volo->orarioArrivo }}</p>
                                    <h5>Dettagli della Prenotazione</h5>
                                    <p class="card-text">Posti Prenotati: {{ $prenotazione->passeggeri->count() }}</p>
                                    <p class="card-text">Prenotazione Effettuata il {{ $prenotazione->dataPrenotazione }}
                                    </p>
                                    <h5>Dettagli dei Passeggeri</h5>
                                    @foreach ($prenotazione->passeggeri as $p)
                                        <p>{{ $p->nome }} {{ $p->cognome }}</p>
                                    @endforeach
                                </div>
                            </div>

                            <div class="collapse mt-3" id="edit-{{ $prenotazione->id }}"
                                data-bs-parent="#accordion-{{ $prenotazione->id }}">
                                <div class="card card-body">
                                    <h5>Modifica Passeggeri</h5>
                                    <button type="button" class="btn btn-primary aggiungiPasseggeroButton"
                                        data-preid="{{ $prenotazione->id }}">
                                        <i class="fas fa-plus"></i> Aggiungi Passeggero
                                    </button>
                                    <form action="{{ route('aggiorna') }}" method="post">

                                        @csrf
                                        @foreach ($prenotazione->passeggeri as $index => $pas)
                                            <div class="row mt-3">
                                                <div class="form-group col-md-6">
                                                    <input type="hidden" name="idPre" value="{{ $prenotazione->id }}">
                                                    <label for="nome">Nome passeggero {{ $index + 1 }}</label>
                                                    <input type="text" class="form-control"
                                                        id="nome{{ $prenotazione->id }}_{{ $index }}" name="nome[]"
                                                        value="{{ $pas->nome }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="cognome">Cognome passeggero {{ $index + 1 }}</label>
                                                    <input type="text" class="form-control"
                                                        id="cognome{{ $prenotazione->id }}_{{ $index }}" name="cognome[]"
                                                        value="{{ $pas->cognome }}">
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="addPass"></div>
                                        <button type="submit" class="btn btn-primary">Salva modifiche</button>
                                    </form>
                                </div>
                            </div>

                            <div class="collapse mt-3" id="delete-{{ $prenotazione->id }}"
                                data-bs-parent="#accordion-{{ $prenotazione->id }}">
                                <div class="card card-body">
                                    <h5>Elimina Prenotazione</h5>
                                    <p>Sei sicuro di voler eliminare la prenotazione?</p>
                                    <p>Questa azione non è reversibile</p>
                                    <form action="{{ route('prenotazioni.destroy', $prenotazione->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Elimina</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
-->





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.aggiungiPasseggeroButton').click(function () {
            var preId = $(this).data('preid');
            var index = $('#edit-' + preId + ' .form-group').length / 2 + 1;
            var html = '<div class="row"><div class="form-group col-md-6">' +
                '<label for="nome">Nome passeggero ' + index + '</label>' +
                '<input type="text" class="form-control" id="nome' + preId + '_' + index + '" name="nome[]" value="">' +
                '</div>' +
                '<div class="form-group col-md-6">' +
                '<label for="cognome">Cognome passeggero ' + index + '</label>' +
                '<input type="text" class="form-control" id="cognome' + preId + '_' + index + '" name="cognome[]" value="">' +
                '</div></div>';
            $('#edit-' + preId + ' .addPass').append(html);
        });
    });
</script>
@endsection