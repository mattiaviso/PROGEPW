@extends('layouts.master')

@section('title')
{{trans("messages.listaDellePreonotazioni")}}@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans("messages.listaDellePreonotazioni")}}
            </li>
        </ol>
    </nav>
</div>
@endsection


@section('body')
<div class="container mt-5">
    <h2 class="mb-4">{{trans("messages.listaDellePreonotazioni")}}</h2>
    <div class="row">
        @foreach ($prenotazioni as $prenotazione)
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center airport-info">
                            <span>
                                <h5>{{trans("messages.da")}}: {{ $prenotazione->volo->aereoportoPartenza->city }}
                                    ({{$prenotazione->volo->aereoportoPartenza->codice_iata}})
                            </span>
                            <i class="fas fa-plane"></i>
                            <span>{{trans("messages.a")}}:
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
                                        {{trans("messages.dettagli")}}
                                    </button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-warning btn-sm" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#edit-{{ $prenotazione->id }}" aria-expanded="false"
                                        aria-controls="edit-{{ $prenotazione->id }}">
                                        {{trans("messages.modifica")}}
                                    </button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#delete-{{ $prenotazione->id }}" aria-expanded="false"
                                        aria-controls="delete-{{ $prenotazione->id }}">
                                        {{trans("messages.elimina")}}
                                    </button>
                                </div>
                            </div>

                            <div class="collapse mt-3" id="details-{{ $prenotazione->id }}"
                                data-bs-parent="#accordion-{{ $prenotazione->id }}">
                                <div class="card card-body">
                                    <h5>{{trans("messages.dettagliVolo")}}</h5>
                                    <p>{{trans("messages.numero_volo")}}: <span
                                            id="numeroVolo">{{ $prenotazione->volo->numeroVolo }}</span>
                                    </p>
                                    <p> {{trans("messages.dataEoraPartenza")}}: {{ $prenotazione->volo->orarioPartenza }}
                                    </p>
                                    <p>{{trans("messages.dataEoraArrivo")}}: {{ $prenotazione->volo->orarioArrivo }}</p>
                                    <h5>{{trans("messages.dettagliPrenotazione")}}</h5>
                                    <p class="card-text">{{trans("messages.postiPrenotati")}}:
                                        <span id="{{$prenotazione->id}}">{{ $prenotazione->passeggeri->count() }}</span>
                                    </p>
                                    <p class="card-text">{{trans("messages.prenotazioneEffettuata")}}
                                        {{ $prenotazione->dataPrenotazione }}
                                    </p>
                                    <h5>{{trans("messages.dettagliDeiPassaggeri")}}</h5>
                                    @foreach ($prenotazione->passeggeri as $p)
                                        <p>{{ $p->nome }} {{ $p->cognome }}</p>
                                    @endforeach
                                </div>
                            </div>

                            <div class="collapse mt-3" id="edit-{{ $prenotazione->id }}"
                                data-bs-parent="#accordion-{{ $prenotazione->id }}">
                                <div class="card card-body">
                                    <h5>{{trans("messages.modificaPasseggeri")}}</h5>
                                    <button type="button" class="btn btn-primary aggiungiPasseggeroButton"
                                        data-preid="{{ $prenotazione->id }}" data-voloId="{{$prenotazione->volo->id}}"
                                        data-postiprenotati="{{$prenotazione->passeggeri->count()}}">
                                        <i class="fas fa-plus"></i> {{trans("messages.aggiungiPasseggeri")}}
                                    </button>
                                    <form action="{{ route('aggiorna') }}" name="{{$prenotazione->id}}" method="post">

                                        @csrf
                                        @foreach ($prenotazione->passeggeri as $index => $pas)
                                            <div class="row mt-3">
                                                <div class="form-group col-md-6">
                                                    <input type="hidden" name="idPre" value="{{ $prenotazione->id }}">
                                                    <label for="nome">{{trans("messages.nome_passenger")}}
                                                        {{ $index + 1 }}</label>
                                                    <input type="text" class="form-control"
                                                        id="nome{{ $prenotazione->id }}_{{ $index }}" name="nome[]"
                                                        value="{{ $pas->nome }}">
                                                    <span id="error-nome{{ $prenotazione->id }}_{{ $index }}"
                                                        class="text-danger"></span> <!-- Aggiungi una span per l'errore -->
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="cognome">{{trans("messages.cognome_passenger")}}
                                                        {{ $index + 1 }}</label>
                                                    <input type="text" class="form-control"
                                                        id="cognome{{ $prenotazione->id }}_{{ $index }}" name="cognome[]"
                                                        value="{{ $pas->cognome }}">
                                                    <span id="error-cognome{{ $prenotazione->id }}_{{ $index }}"
                                                        class="text-danger"></span> <!-- Aggiungi una span per l'errore -->
                                                </div>
                                            </div>

                                        @endforeach
                                        <div class="addPass"></div>
                                        <button type="submit" id="salvaModifiche"
                                            class="btn btn-primary">{{trans("messages.salvaModifiche")}}
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="collapse mt-3" id="delete-{{ $prenotazione->id }}"
                                data-bs-parent="#accordion-{{ $prenotazione->id }}">
                                <div class="card card-body">
                                    <h5>{{trans("messages.eliminaPrenotazione")}}</h5>
                                    <p>{{trans("messages.areYouSure")}}</p>
                                    <p>{{trans("messages.unaVoltaEseguita")}}</p>
                                    <form action="{{ route('prenotazioni.destroy', $prenotazione->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">{{trans("messages.elimina")}}</button>
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






<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.aggiungiPasseggeroButton').click(function (event) {
            event.preventDefault();

            var isValid = false;
            var postiPrenotati = $(this).data('postiprenotati');
            var altro = $('#edit-' + $(this).data('preid') + ' .form-group').length / 2;

            var passengerCount = (altro - postiPrenotati) + 1;
            var idVolo = $(this).data('voloid');
            var preId = $(this).data('preid');

            // Effettua la chiamata AJAX per controllare i posti disponibili
            $.ajax({
                type: 'GET',
                url: '/ajaxPostiDisponibili',
                data: {
                    passengerCount: passengerCount,
                    idVolo: idVolo
                },
                success: function (data) {
                    if (data.found) {
                        // Se ci sono posti disponibili, setta isValid a true
                        isValid = true;
                    } else {
                        // Se non ci sono posti disponibili, mostra un avviso e setta isValid a false
                        //alert('Non ci sono posti disponibili');
                        isValid = false;
                    }

                    // Dopo aver gestito la risposta AJAX, aggiungi i campi per il passeggero solo se isValid è true
                    if (isValid) {
                        var index = $('#edit-' + preId + ' .form-group').length / 2 + 1;
                        var html = '<div class="row"><div class="form-group col-md-6">' +
                            '<label for="nome">{{trans("messages.nome_passenger")}} ' + index + '</label>' +
                            '<input type="text" class="form-control" id="nome' + preId + '_' + index + '" name="nome[]" value="">' +
                            '<span id="error-nome' + preId + '_' + index + '" class="text-danger"></span>' + // Aggiungi una span per l'errore
                            '</div>' +
                            '<div class="form-group col-md-6">' +
                            '<label for="cognome">{{trans("messages.cognome_passenger")}} ' + index + '</label>' +
                            '<input type="text" class="form-control" id="cognome' + preId + '_' + index + '" name="cognome[]" value="">' +
                            '<span id="error-cognome' + preId + '_' + index + '" class="text-danger"></span>' + // Aggiungi una span per l'errore
                            '</div></div>';
                        $('#edit-' + preId + ' .addPass').append(html);
                    }
                }
            });
        });

        $('#salvaModifiche').click(function (event) {
            //SCRIVI CODICE QUA CHE CONTROLLA CHE TUTTI I CAMPI SIANO NON VUOTI E CONTENGANO SOLO LETTERE
            //DAMMI LISTA NOMI E COGNOMI
            event.preventDefault();
            isValid = true;
            var preId = $('input[name="idPre"]').val();
            var postiPrenotati = $('#' + preId).text();
            var totale = $('#edit-' + preId + ' .form-group').length / 2;

            for (let index = 0; index < postiPrenotati; index++) {
                var nome = $('#nome' + preId + '_' + index).val();
                var cognome = $('#cognome' + preId + '_' + index).val();
                //fai check che nome e cognome siano diversdi da vuoto e contengano solo lettere
                if (nome.trim() === '' || !/^[A-Za-zàèéìòóù\s'’]+$/.test(nome)) {
                    isValid = false;
                    $('#error-nome' + preId + '_' + index).text('{{trans("messages.campoObbligatorio")}}');
                } else {
                    $('#error-nome' + preId + '_' + index).text('');
                }

                if (cognome.trim() === '' || !/^[A-Za-zàèéìòóù\s'’]+$/.test(cognome)) {
                    isValid = false;
                    $('#error-cognome' + preId + '_' + index).text('{{trans("messages.campoObbligatorio")}}');
                } else {
                    $('#error-cognome' + preId + '_' + index).text('');
                }

            }
            for (let index = ++postiPrenotati; index < totale + 1; index++) {
                var nome = $('#nome' + preId + '_' + index).val();
                var cognome = $('#cognome' + preId + '_' + index).val();
                if (nome.trim() === '' || !/^[A-Za-zàèéìòóù\s'’]+$/.test(nome)) {
                    isValid = false;
                    $('#error-nome' + preId + '_' + index).text('{{trans("messages.campoObbligatorio")}}');
                } else {
                    $('#error-nome' + preId + '_' + index).text('');
                }

                if (cognome.trim() === '' || !/^[A-Za-zàèéìòóù\s'’]+$/.test(cognome)) {
                    isValid = false;
                    $('#error-cognome' + preId + '_' + index).text('{{trans("messages.campoObbligatorio")}}');
                } else {
                    $('#error-cognome' + preId + '_' + index).text('');
                }
            }

            if (isValid) {
                //prosegue il form con name=preId
                $('form[name="' + preId + '"]').submit();
            }
        });
    });
</script>
@endsection