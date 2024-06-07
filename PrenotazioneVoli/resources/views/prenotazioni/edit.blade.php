@extends('layouts.master')
@section('title', 'Prenotazione Volo')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('voli.index')}}">Voli</a>
            </li>
            <li class="breadcrumb-item " aria-current="page">
                {{ $volo->numeroVolo }}
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Nuova Prenotazione
            </li>
        </ol>
    </nav>
</div>
@endsection


@section('body')
<div class="container mt-3 mb-5">

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('prenotazioni.store') }}" method="post" class="form-horizontal">
                @csrf
                <input type="hidden" name="volo_id" value="{{$volo->id}}">
                <input type="hidden" name="utente_id" value="{{$_SESSION['loggedID']}}">
                <div class="form-group row mb-3">
                    <div class="col-md-3">
                        <strong><label for="title">Numero Volo</label></strong>
                    </div>
                    <div class="col-md-9">
                        <label for="title">{{$volo->numeroVolo}}</label>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-md-3">
                        <strong><label for="title">Aeroporto Partenza</label></strong>
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{$volo->aereoportoPartenza->nome }}</label>
                    </div>
                    <div class="col-md-3">
                        <strong><label for="title">Aeroporto Arrivo</label></strong>
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{$volo->aereoportoArrivo->nome }}</label>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <div class="col-md-3">
                        <strong><label for="title">Numero Passeggeri</label></strong>
                    </div>
                    <div class="col-md-9">
                        <select id="passenger_count" name="passenger_count" class="form-control"
                            onchange="updatePassengerFields()" required>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div id="passenger_fields">
                    <!-- RICHIAMA JQUERY -->
                </div>
                <div class="form-group row mb-3">
                    <div class="col-md-9 offset-md-3">
                        <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-calendar-plus"></i>
                            Prenota</label>
                        <input id="mySubmit" class="d-none" type="submit" value="Prenota">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-md-9 offset-md-3">
                        <a class="btn btn-secondary w-100" href="{{ url()->previous() }}"><i
                                class="bi bi-box-arrow-left"></i> Indietro</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function updatePassengerFields() {
        var count = document.getElementById('passenger_count').value;
        var container = document.getElementById('passenger_fields');
        var existingValues = {};

        // Salva i valori esistenti
        var inputs = container.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            existingValues[inputs[i].name] = inputs[i].value;
        }

        // Svuota il contenitore
        container.innerHTML = '';

        for (var i = 1; i <= count; i++) {
            var fieldset = document.createElement('div');
            fieldset.className = 'form-group row mb-3';

            var firstNameLabel = document.createElement('label');
            var strongText = document.createElement('strong');
            strongText.innerText = 'Nome passeggero ' + i + ':';
            firstNameLabel.appendChild(strongText);
            firstNameLabel.className = 'col-md-3';
            firstNameLabel.setAttribute('for', 'passenger_' + (i - 1) + '_first_name');
            fieldset.appendChild(firstNameLabel);


            var firstNameInputContainer = document.createElement('div');
            firstNameInputContainer.className = 'col-md-9';
            var firstNameInput = document.createElement('input');
            firstNameInput.type = 'text';
            firstNameInput.id = 'passenger_' + (i - 1) + '_first_name';
            firstNameInput.name = 'passengers[' + (i - 1) + '][first_name]';
            firstNameInput.className = 'form-control';
            // Ripristina il valore esistente se presente
            if (existingValues[firstNameInput.name]) {
                firstNameInput.value = existingValues[firstNameInput.name];
            }
            firstNameInputContainer.appendChild(firstNameInput);
            fieldset.appendChild(firstNameInputContainer);

            var lastNameLabel = document.createElement('label');
            lastNameLabel.className = 'col-md-3 mt-3';
            lastNameLabel.setAttribute('for', 'passenger_' + (i - 1) + '_last_name');
            var lastNameStrong = document.createElement('strong');
            lastNameStrong.innerText = 'Cognome passeggero ' + i + ':';
            lastNameLabel.appendChild(lastNameStrong);

            fieldset.appendChild(lastNameLabel);

            var lastNameInputContainer = document.createElement('div');
            lastNameInputContainer.className = 'col-md-9 mt-3';
            var lastNameInput = document.createElement('input');
            lastNameInput.type = 'text';
            lastNameInput.id = 'passenger_' + (i - 1) + '_last_name';
            lastNameInput.name = 'passengers[' + (i - 1) + '][last_name]';
            lastNameInput.className = 'form-control';
            // Ripristina il valore esistente se presente
            if (existingValues[lastNameInput.name]) {
                lastNameInput.value = existingValues[lastNameInput.name];
            }
            lastNameInputContainer.appendChild(lastNameInput);
            fieldset.appendChild(lastNameInputContainer);


            container.appendChild(fieldset);
        }
    }

    // Chiama la funzione una volta per impostare il campo predefinito per il primo passeggero
    updatePassengerFields();
</script>




@endsection