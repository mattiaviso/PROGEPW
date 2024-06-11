@extends('layouts.master')

@section('title', '{{trans("messages.lista_voli")}}')

@section('breadcrumb')
<div class="container mt-3">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-end">
      <li class="breadcrumb-item">
        <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
      {{trans('messages.voli')}}
      </li>
    </ol>
  </nav>
</div>
@endsection

@section('body')

<div class="container mt-3">
  <!-- Barra di ricerca -->
  <div class="row mb-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <form id="cercavolo">
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="from">{{trans('messages.da')}}:</label>
                  <select class="form-select form-control" aria-label="Seleziona l'aeroporto di partenza" id="partenza"
                    name="partenza">
                    <option value="-1" selected disabled>{{trans('messages.aereoporto_partenza')}}</option>
                    @foreach ($aeroportiPartenza as $aer)
            <option value="{{ $aer->id }}">{{ $aer->city }}</option>
          @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="to">{{trans('messages.a')}}:</label>
                  <select class="form-select form-control" aria-label="Seleziona l'aeroporto di arrivo" id="arrivo"
                    name="arrivo">

                    <option selected value="-1" disabled>{{trans('messages.aereoporto_arrivo')}}</option>
                    @foreach ($aeroportiArrivo as $aer)
                    @if(isset($city) && $aer->city == $city)
        <option selected value="{{$aer->id}}">{{$aer->city}}</option>
      @else
    <option value="{{ $aer->id }}">{{ $aer->city }}</option>
  @endif          
  @endforeach
                  
                  </select>                
                </div>
              </div>

              

              <div class="col-md-4">
                <div class="form-group">
                  <label for="departure-date">{{trans('messages.dataPartenza')}}:</label>
                  <input type="date" class="form-control" id="departure_date" name="departure_date">
                </div>
              </div>
            </div>
            <button type="submit" onclick="resetFiltri()" class="btn btn-primary btn-block cercaVolo">{{trans('messages.resettaFiltri')}}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Lista dei voli disponibili -->
  <div id="risultati-voli">
    @foreach($voli as $flight)

    <div class="flight-card p-3">
      <h4 class="mb-3">{{$flight->compagnia->nome}} {{$flight->numeroVolo}}</h4>
      <div class="flight-info">
      <div class="row">
        <div class="col-md-2 d-flex align-items-center justify-content-center">
        <div class="flight-detail d-flex flex-column align-items-center justify-content-center">
          <p class="mb-0"><strong>{{\Carbon\Carbon::parse($flight->orarioPartenza)->format('D')}}</strong></p>
          <p class="mb-0"><strong><span
            id="departureDate">{{\Carbon\Carbon::parse($flight->orarioPartenza)->format('Y-m-d')}}</span></strong>
          </p>
        </div>
        </div>
        <div class="col-md-3">
        <div class="flight-detail">
          <h5 class="mb-3">{{trans('messages.aeroportoP')}}</h5>
          <p><strong>{{trans('messages.da')}}:</strong><span id="partenzaCity">{{$flight->aereoportoPartenza->city}}</span>
          ({{$flight->aereoportoPartenza->codice_iata}})</p>
          <p><strong>{{trans('messages.oraPartenza')}}:</strong> {{\Carbon\Carbon::parse($flight->orarioPartenza)->format('H:i')}}</p>
        </div>
        </div>
        <div class="col-md-4">
        <div class="flight-detail">
          <h5 class="mb-3">{{trans('messages.aeroportoA')}}</h5>
          <p><strong>{{trans('messages.a')}}:</strong> <span id="arrivoCity">{{$flight->aereoportoArrivo->city}}</span>
          ({{$flight->aereoportoArrivo->codice_iata}})
          </p>
          <p><strong>{{trans('messages.oraArrivo')}}:</strong> {{\Carbon\Carbon::parse($flight->orarioArrivo)->format('H:i')}}
          @if(\Carbon\Carbon::parse($flight->orarioPartenza)->format('d/m') != \Carbon\Carbon::parse($flight->orarioArrivo)->format('d/m'))
        <sup>+1</sup>
      @endif
          </p>
        </div>
        </div>
        <div class="col-md-2 d-flex flex-column justify-content-center ">
        <div class="flight-detail ">

          <a href="{{ route("prenotazioni.edit", $flight->id) }}" class="btn btn-primary mb-1 w-100"><i class="bi bi-calendar-plus"></i>
          {{trans('messages.prenota_ora')}}</a>

          <a href="{{ route("voli.show", $flight->id) }}" class="btn btn-info mt-1 w-100"><i class="bi bi-search"></i>
          {{trans('messages.dettagli')}}</a>

        </div>
        </div>
      </div>
      </div>
    </div>

    <div class="row mb-4"></div>
  @endforeach

  </div>
</div>

@if (isset($city))
<script>

var selectedValue = $('#partenza').find('option:selected').text();
      var partenzaId = $('#partenza').find('option:selected').val();
      var arrivoValue = $('#arrivo').find('option:selected').text();
      var arrivoId = $('#arrivo').find('option:selected').val();
      var departureDate = $('#departure_date').val();

      if (partenzaId == -1) {
        selectedValue = null;
      }
      if (arrivoId == -1) {
        arrivoValue = null;
      }

      $('.flight-card').hide();

      $('.flight-card').each(function () {
        var partenzaCity = $(this).find('span#partenzaCity').text().trim();
        var arrivoCity = $(this).find('span#arrivoCity').text().trim();
        var flightDepartureDate = $(this).find('span#departureDate').text().trim(); // Utilizziamo text() per ottenere il valore dallo span

        var filterPartenza = (selectedValue === null || partenzaCity === selectedValue);
        var filterArrivo = (arrivoValue === null || arrivoCity === arrivoValue);


        // Confronto solo giorno, mese e anno ignorando l'orario
        var filterDate = (!departureDate || flightDepartureDate === departureDate);

        if (filterPartenza && filterArrivo && filterDate) {
          $(this).show();
        }
      });

</script>


@endif

<script>

  $(document).ready(function () {
    function filterFlights() {
      var selectedValue = $('#partenza').find('option:selected').text();
      var partenzaId = $('#partenza').find('option:selected').val();
      var arrivoValue = $('#arrivo').find('option:selected').text();
      var arrivoId = $('#arrivo').find('option:selected').val();
      var departureDate = $('#departure_date').val();

      if (partenzaId == -1) {
        selectedValue = null;
      }
      if (arrivoId == -1) {
        arrivoValue = null;
      }

      $('.flight-card').hide();

      $('.flight-card').each(function () {
        var partenzaCity = $(this).find('span#partenzaCity').text().trim();
        var arrivoCity = $(this).find('span#arrivoCity').text().trim();
        var flightDepartureDate = $(this).find('span#departureDate').text().trim(); // Utilizziamo text() per ottenere il valore dallo span

        var filterPartenza = (selectedValue === null || partenzaCity === selectedValue);
        var filterArrivo = (arrivoValue === null || arrivoCity === arrivoValue);


        // Confronto solo giorno, mese e anno ignorando l'orario
        var filterDate = (!departureDate || flightDepartureDate === departureDate);

        if (filterPartenza && filterArrivo && filterDate) {
          $(this).show();
        }
      });
    }



    // Evento change per la selezione della partenza
    $('#partenza').change(function () {
      filterFlights();
    });

    // Evento change per la selezione dell'arrivo
    $('#arrivo').change(function () {
      filterFlights();
    });

    // Evento change per la selezione della data di partenza
    $('#departure_date').change(function () {
      filterFlights();
    });


    function clearFilters() {
      // Rimuovi la selezione degli option nei select
      $('#partenza').val(-1);
      $('#arrivo').val(-1);
      // Resetta il valore della data di partenza
      $('#departure_date').val('');

      // Nascondi tutti gli elementi con classe flight-card
      $('.flight-card').show();
    }

    // Associa la funzione al clic del bottone
    $('#cercavolo').submit(function (event) {
      // Previeni il comportamento di default del form
      event.preventDefault();

      // Chiamata alla funzione per rimuovere i filtri
      clearFilters();
    });

  });


</script>



@endsection