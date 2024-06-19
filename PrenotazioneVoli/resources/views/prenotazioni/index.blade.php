@extends('layouts.master')

@section('title', 'Lista Prenotazioni')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans('messages.listaDellePreonotazioni')}}
            </li>
        </ol>
    </nav>
</div>
@endsection


@section('body')
<div class="container mt-5">
    <h2 class="mb-4">{{trans('messages.listaDellePreonotazioni')}}</h2>
    <div class="row">
        @foreach ($prenotazioni as $prenotazione)
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center airport-info">
                            <span>
                                <h5>{{trans('messages.da')}}: {{ $prenotazione->volo->aereoportoPartenza->city }}
                                    ({{$prenotazione->volo->aereoportoPartenza->codice_iata}})
                            </span>
                            <i class="fas fa-plane"></i>
                            <span>{{trans('messages.a')}}:
                                {{ $prenotazione->volo->aereoportoArrivo->city }}
                                ({{$prenotazione->volo->aereoportoArrivo->codice_iata}})
                            </span>
                            </h5>
                        </div>
                        <div id="accordion-{{ $prenotazione->id }}">
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#details-{{ $prenotazione->id }}" aria-expanded="false"
                                        aria-controls="details-{{ $prenotazione->id }}">
                                        {{trans("messages.dettagli")}}
                                    </button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-warning" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#edit-{{ $prenotazione->id }}" aria-expanded="false"
                                        aria-controls="edit-{{ $prenotazione->id }}">
                                        {{trans("messages.modifica")}}
                                    </button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-danger"
                                        id="deletePrenotazione-{{ $prenotazione->id }}-{{ $prenotazione->passeggeri->count() }}"
                                        data-prenotazione-id="{{ $prenotazione->id }}"
                                        data-num-passeggeri="{{ $prenotazione->passeggeri->count() }}" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#delete-{{ $prenotazione->id }}"
                                        aria-expanded="false" aria-controls="delete-{{ $prenotazione->id }}">
                                        {{trans("messages.elimina")}}
                                    </button>
                                </div>
                            </div>

                            <div class="collapse mt-3" id="details-{{ $prenotazione->id }}"
                                data-bs-parent="#accordion-{{ $prenotazione->id }}">
                                <div class="card card-body">
                                    <h5>{{trans('messages.dettagliVolo')}}</h5>
                                    <p>{{trans('messages.numero_volo')}}: <span
                                            id="numeroVolo">{{ $prenotazione->volo->numeroVolo }}</span>
                                    </p>
                                    <p>{{trans('messages.dataEoraPartenza')}}: {{ $prenotazione->volo->orarioPartenza }}</p>
                                    <p>{{trans('messages.dataEoraArrivo')}}: {{ $prenotazione->volo->orarioArrivo }}</p>
                                    <h5>{{trans('messages.dettagliPrenotazione')}}</h5>
                                    <p class="card-text">{{trans('messages.postiPrenotati')}}:
                                        <span id="{{$prenotazione->id}}">{{ $prenotazione->passeggeri->count() }}</span>
                                    </p>
                                    <p class="card-text">{{trans('messages.prenotazioneEffettuata')}}
                                        {{ $prenotazione->dataPrenotazione }}
                                    </p>
                                    <h5>{{trans('messages.dettagliDeiPassaggeri')}}</h5>
                                    @foreach ($prenotazione->passeggeri as $p)
                                        <p>{{ $p->nome }} {{ $p->cognome }}</p>
                                    @endforeach
                                </div>
                            </div>

                            <div class="collapse mt-3" id="edit-{{ $prenotazione->id }}"
                                data-bs-parent="#accordion-{{ $prenotazione->id }}">
                                <div class="card card-body">
                                    <h5>{{trans('messages.modificaPasseggeri')}}</h5>
                                    <button type="button" class="btn btn-primary aggiungiPasseggeroButton"
                                        data-preid="{{ $prenotazione->id }}" data-voloId="{{$prenotazione->volo->id}}"
                                        data-postiprenotati="{{$prenotazione->passeggeri->count()}}">
                                        <i class="fas fa-plus"></i> {{trans('messages.aggiungiPasseggeri')}}
                                    </button>
                                    <h5 class="noEliminazionePassegero{{$prenotazione->id}} text-danger text-center mt-3">
                                    </h5>
                                    <form action="{{ route('aggiorna') }}" name="{{$prenotazione->id}}" method="post">

                                        @csrf
                                        @foreach ($prenotazione->passeggeri as $index => $pas)
                                            <div class="row mt-3">
                                                <div class="form-group col-md-5">
                                                    <input type="hidden" name="idPre" value="{{ $prenotazione->id }}">
                                                    <label for="nome">{{trans('messages.nome_passenger')}}
                                                        {{ $index + 1 }}</label>
                                                    <input type="text" class="form-control"
                                                        id="nome{{ $prenotazione->id }}_{{ $index }}" name="nome[]"
                                                        value="{{ $pas->nome }}">
                                                    <span id="error-nome{{ $prenotazione->id }}_{{ $index }}"
                                                        class="text-danger"></span> <!-- Aggiungi una span per l'errore -->
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="cognome">{{trans('messages.cognome_passenger')}}
                                                        {{ $index + 1 }}</label>
                                                    <input type="text" class="form-control"
                                                        id="cognome{{ $prenotazione->id }}_{{ $index }}" name="cognome[]"
                                                        value="{{ $pas->cognome }}">
                                                    <span id="error-cognome{{ $prenotazione->id }}_{{ $index }}"
                                                        class="text-danger"></span> <!-- Aggiungi una span per l'errore -->
                                                </div>
                                                <div class="col-md-2">
                                                    <hr class="my-3">
                                                    <a id="deletePasseggero-{{$prenotazione->id}}-{{ $prenotazione->passeggeri->count() }}-{{$pas->id}}"
                                                        href="{{ route('passeggeri.elimina.conferma', ['prenotazione' => $prenotazione->id, 'passeggero' => $pas->id]) }}"
                                                        class="btn btn-danger eliminaPass"><i class="fas fa-trash"></i>
                                                        {{trans('messages.elimina')}}</a>
                                                </div>
                                            </div>

                                        @endforeach
                                        <div class="addPass"></div>
                                        <button type="submit" id="salvaModifiche-{{ $prenotazione->id }}"
                                            class="btn btn-primary salvaModifiche">{{trans('messages.salvaModifiche')}}</button>
                                    </form>
                                </div>
                            </div>

                            <div class="collapse mt-3" id="delete-{{ $prenotazione->id }}"
                                data-bs-parent="#accordion-{{ $prenotazione->id }}">
                                <div class="card card-body">
                                    <h5>{{trans('messages.eliminaPrenotazione')}}</h5>
                                    <p>{{trans('messages.areYouSure')}}</p>
                                    <p>{{trans('messages.unaVoltaEseguita')}}</p>
                                    <form action="{{ route('prenotazioni.destroy', $prenotazione->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">{{trans('messages.elimina')}}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <div class="modal" id="rimuoviPasseggeroModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{trans('messages.confermaRimozionePasseggero')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{trans('messages.seiSicuroRimuoverePasseggero')}}</p>
                </div>
                <div class="modal-footer">
                    <span class="EliminaPasseggeroForm"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="postiFinitiModal" tabindex="-1" aria-labelledby="postiFinitiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postiFinitiModalLabel">{{trans('messages.nessunPostoDiposinibile')}}
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{trans('messages.noMoreSeats')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{trans('messages.chiudi')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var prenotazioneId;
        var passeggeroId;

        // Gestione eliminazione passeggero
        $('.eliminaPass').click(function (event) {

            var id = $(this).attr('id');
            console.log(id);
            var parts = id.split('-');
            prenotazioneId = parts[1];
            var numPasseggeri = parseInt(parts[2]);
            passeggeroId = parts[3];

            if (numPasseggeri < 2) {
                event.preventDefault();
                $('.noEliminazionePassegero' + prenotazioneId).text('{{ trans('messages.ultimoPasseggero') }}');


            } else {
                event.preventDefault();
                //visualizza modal
                $('#rimuoviPasseggeroModal').modal('show');

                var formHtml = '<form name="volo" method="post" action="' + "{{ route('passeggeri.elimina', ['prenotazione' => ':prenotazioneId', 'passeggero' => ':passeggeroId']) }}" + '">';
                formHtml += '@method("DELETE")';
                formHtml += '@csrf';
                formHtml += '<a href="' + document.referrer + '" class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i> {{ trans("messages.cancella") }}</a>';
                formHtml += '<button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> {{ trans("messages.elimina") }}</button>';
                formHtml += '</form>';

                // Sostituisci i segnaposto con i valori delle variabili JavaScript
                formHtml = formHtml.replace(':prenotazioneId', prenotazioneId);
                formHtml = formHtml.replace(':passeggeroId', passeggeroId);

                // Inserisci il form HTML nel placeholder
                $('.EliminaPasseggeroForm').html(formHtml);
            }
        });


        $('.close').click(function () {
            $('#rimuoviPasseggeroModal').modal('hide');
        });



        // Aggiunta di passeggeri
        $('.aggiungiPasseggeroButton').click(function (event) {
            event.preventDefault();

            $('.noEliminazionePassegero' + $(this).data('preid')).text('');


            var isValid = false;
            var postiPrenotati = $(this).data('postiprenotati');
            var altro = $('#edit-' + $(this).data('preid') + ' .form-group').length / 2;

            var passengerCount = (altro - postiPrenotati) + 1;
            var idVolo = $(this).data('voloid');
            var preId = $(this).data('preid');

            $.ajax({
                type: 'GET',
                url: '/ajaxPostiDisponibili',
                data: {
                    passengerCount: passengerCount,
                    idVolo: idVolo
                },
                success: function (data) {
                    if (data.found) {
                        isValid = true;
                    } else {

                        $('#postiFinitiModal').modal('show');

                        isValid = false;
                    }

                    if (isValid) {
                        var index = $('#edit-' + preId + ' .form-group').length / 2 + 1;
                        var html = '<div class="row"><div class="form-group col-md-5">' +
                            '<label for="nome">{{trans('messages.nome_passenger')}} ' + index + '</label>' +
                            '<input type="text" class="form-control" id="nome' + preId + '_' + index + '" name="nome[]" value="">' +
                            '<span id="error-nome' + preId + '_' + index + '" class="text-danger"></span>' +
                            '</div>' +
                            '<div class="form-group col-md-5">' +
                            '<label for="cognome">{{trans('messages.cognome_passenger')}} ' + index + '</label>' +
                            '<input type="text" class="form-control" id="cognome' + preId + '_' + index + '" name="cognome[]" value="">' +
                            '<span id="error-cognome' + preId + '_' + index + '" class="text-danger"></span>' +
                            '</div></div>';

                        $('#edit-' + preId + ' .addPass').append(html);
                    }
                }
            });
        });

        // Validazione e invio del form di modifica
        $('.salvaModifiche').click(function (event) {
            event.preventDefault();
            var preId = $(this).attr('id').split('-')[1];
            var postiPrenotati = $('#' + preId).text();
            var totale = $('#edit-' + preId + ' .form-group').length / 2;
            var isValid = true;

            for (let index = 0; index < postiPrenotati; index++) {
                var nome = $('#nome' + preId + '_' + index).val();
                var cognome = $('#cognome' + preId + '_' + index).val();

                if (nome.trim() === '' || !/^[A-Za-zàèéìòóù\s'’]+$/.test(nome)) {
                    isValid = false;
                    $('#error-nome' + preId + '_' + index).text('{{trans('messages.campoObbligatorio')}}');
                } else {
                    $('#error-nome' + preId + '_' + index).text('');
                }

                if (cognome.trim() === '' || !/^[A-Za-zàèéìòóù\s'’]+$/.test(cognome)) {
                    isValid = false;
                    $('#error-cognome' + preId + '_' + index).text('{{trans('messages.obbligatorioEsololettereeAccenti')}}');
                } else {
                    $('#error-cognome' + preId + '_' + index).text('');
                }
            }

            for (let index = ++postiPrenotati; index < totale + 1; index++) {
                var nome = $('#nome' + preId + '_' + index).val();
                var cognome = $('#cognome' + preId + '_' + index).val();

                if (nome.trim() === '' || !/^[A-Za-zàèéìòóù\s'’]+$/.test(nome)) {
                    isValid = false;
                    $('#error-nome' + preId + '_' + index).text('{{trans('messages.campoObbligatorio')}}');
                } else {
                    $('#error-nome' + preId + '_' + index).text('');
                }

                if (cognome.trim() === '' || !/^[A-Za-zàèéìòóù\s'’]+$/.test(cognome)) {
                    isValid = false;
                    $('#error-cognome' + preId + '_' + index).text('{{trans('messages.obbligatorioEsololettereeAccenti')}}');
                } else {
                    $('#error-cognome' + preId + '_' + index).text('');
                }
            }

            if (isValid) {
                $('form[name="' + preId + '"]').submit();
            }
        });
    });
</script>
@endsection