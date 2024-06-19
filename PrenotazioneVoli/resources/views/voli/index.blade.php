@extends('layouts.master')

@section('title')
{{trans("messages.lista_voli")}}
@endsection

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
                  <label for="from">{{trans('messages.da')}}</label>
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
                  <label for="to">{{trans('messages.a')}}</label>
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
                  <label for="departure-date">{{trans('messages.dataPartenza')}}</label>
                  <input type="date" class="form-control" id="departure_date" name="departure_date">
                </div>
              </div>
            </div>
            <button type="submit" id="resettaFiltri"
              class="btn btn-primary btn-block cercaVolo">{{trans('messages.resettaFiltri')}}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-3 text-left mb-3">
      <select id="rowsPerPage" class="form-control justify-content-end">
        <option value="5">5 {{trans('messages.flight_per_page')}}</option>
        <option value="10">10 {{trans('messages.flight_per_page')}}</option>
        <option value="15">15 {{trans('messages.flight_per_page')}}</option>
        <option value="20">20 {{trans('messages.flight_per_page')}}</option>
      </select>
    </div>
    <div class="col-md-6 mb-3">
      <nav aria-label="Page navigation example" id="paginationNav">
        <ul class="pagination justify-content-center mb-0">
          <li class="page-item" id="firstPage"><a class="page-link" href="#">
              << </a>
          </li>
          <li class="page-item" id="previousPage"><a class="page-link" href="#">
              < </a>
          </li>
          <!-- Numeri di pagina verranno inseriti dinamicamente -->
          <li class="page-item" id="nextPage"><a class="page-link" href="#">></a></li>
          <li class="page-item" id="lastPage"><a class="page-link" href="#">>></a></li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- Lista dei voli disponibili -->
  <div id="risultati-voli">
    @foreach ($voli as $volo)
    <div class="card mb-3 flight-card bg-white">
      <div class="card-body">
      <div class="row">
        <div class="col-md-4">
        <h4 class="card-title">{{ trans('messages.numero_volo') }}: <span
          class="numeroVoloId">{{ $volo->numeroVolo }}</span></h4>
        <h5 class="mb-3">{{trans('messages.aeroportoP')}}</h5>

        <p><strong>{{ trans('messages.da') }}:</strong> <span
          class="cittaPartenza">{{$volo->aereoportoPartenza->city }} </span>
          ({{$volo->aereoportoPartenza->codice_iata}})
        </p>
        <p><strong>{{trans('messages.oraPartenza')}}:</strong> <span
          class="partenza">{{ \Carbon\Carbon::parse($volo->orarioPartenza)->format('H:i') }}</span>
        </p>
        </div>
        <div class="col-md-5">
        <h5 class="card-title">{{trans('messages.dataPartenza')}}: <span
          class="dataPartenza">{{\Carbon\Carbon::parse($volo->orarioPartenza)->format('d-m-Y')}}</span></h5>

        <h5 class="mb-3">{{trans('messages.aeroportoA')}}</h5>


        <p><strong>{{ trans('messages.a') }}:</strong> <span
          class="cittaArrivo">{{ $volo->aereoportoArrivo->city }}</span>
          ({{$volo->aereoportoArrivo->codice_iata}})
        </p>

        <p><strong>{{trans('messages.oraArrivo')}}:</strong>
          {{\Carbon\Carbon::parse($volo->orarioArrivo)->format('H:i')}}
          @if(\Carbon\Carbon::parse($volo->orarioPartenza)->format('d/m') != \Carbon\Carbon::parse($volo->orarioArrivo)->format('d/m'))
        <sup>+1</sup>
      @endif
        </p>

        </div>
        <div class="col-md-3 justify-content-center d-flex flex-column ">
        <div class="mb-2">
          <a href="{{ route("prenotazioni.edit", $volo->id) }}" class="btn btn-primary mb-1 w-100"><i
            class="bi bi-calendar-plus"></i>
          {{trans('messages.prenota_ora')}}</a>
        </div>
        <div class="mb-2">
          <a href="{{ route("voli.show", $volo->id) }}" class="btn btn-info mt-1 w-100"><i class="bi bi-search"></i>
          {{trans('messages.dettagli')}}</a>
        </div>
        </div>
      </div>
      </div>
    </div>
  @endforeach
  </div>

</div>


@if (isset($city))
  <script>
    $(document).ready(function () {
    var textArrivo = $('#arrivo').find('option:selected').text();
    var valueArrivo = $('#arrivo').find('option:selected').val();

    $(".flight-card").each(function () {
      var flightArrival = $(this).find(".cittaArrivo").text().trim();

      var filterArrivo = (valueArrivo == -1 || flightArrival == textArrivo);

      if (filterArrivo) {
      $(this).show();
      } else {
      $(this).hide();
      }
    });

    $("#paginationNav").hide();
    $("#rowsPerPage").hide();
    });

  </script>
@endif

<script>
  $(document).ready(function () {
    var currentPage = 1;
    var rowsPerPage = parseInt($("#rowsPerPage").val());
    var flightCards = $(".flight-card");
    var totalPages = Math.ceil(flightCards.length / rowsPerPage);

    showPage(currentPage);


    $("#rowsPerPage").on("change", function () {
      rowsPerPage = parseInt($(this).val());
      totalPages = Math.ceil(flightCards.length / rowsPerPage);
      if (currentPage > totalPages) {
        currentPage = totalPages;
      }
      showPage(currentPage);
    });


    function showPage(page) {
      var start = (page - 1) * rowsPerPage;
      var end = start + rowsPerPage;

      flightCards.hide().slice(start, end).show();


      // Rimuovi i numeri di pagina esistenti
      $(".page-item.pageNumber").remove();

      // Calcola quali numeri di pagina visualizzare
      var startPage = Math.max(1, currentPage - 1);
      var endPage = Math.min(startPage + 2, totalPages);

      for (var i = startPage; i <= endPage; i++) {
        var $li = $("<li>", { class: "page-item pageNumber" });
        var $link = $("<a>", { class: "page-link", href: "#", text: i });
        if (i === currentPage) {
          $li.addClass("active");
        }
        $li.append($link);
        $li.insertBefore("#nextPage");
      }
    }


    $("#firstPage").on("click", function () {
      currentPage = 1;
      showPage(currentPage);
    });

    $("#lastPage").on("click", function () {
      currentPage = totalPages;
      showPage(currentPage);
    });

    $("#nextPage").on("click", function () {
      if (currentPage < totalPages) {
        currentPage++;
        showPage(currentPage);
      }
    });

    $("#previousPage").on("click", function () {
      if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
      }
    });

    $(document).on("click", ".pageNumber", function () {
      var page = parseInt($(this).text());
      currentPage = page;
      showPage(currentPage);
    });






    function filterFlights() {
      var value = $('#partenza').find('option:selected').text();
      var textArrivo = $('#arrivo').find('option:selected').text();

      var valuePartenza = $('#partenza').find('option:selected').val();
      var valueArrivo = $('#arrivo').find('option:selected').val();

      var departureDate = $('#departure_date').val();

      var dateParts = departureDate.split("-");
      var formattedDate = dateParts[2] + "-" + dateParts[1] + "-" + dateParts[0];



      $(".flight-card").each(function () {
        var flightNumber = $(this).find(".cittaPartenza").text().trim();
        var flightArrival = $(this).find(".cittaArrivo").text().trim();
        var flightDepartureDate = $(this).find(".dataPartenza").text().trim();

        var filterPartenza = (valuePartenza == -1 || flightNumber == value);
        var filterArrivo = (valueArrivo == -1 || flightArrival == textArrivo);
        var filterDate = (!departureDate || flightDepartureDate == formattedDate);

        if (filterPartenza && filterArrivo && filterDate) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    }



    // Evento change per la selezione della partenza
    $('#partenza').change(function () {
      $("#paginationNav").hide();
      $("#rowsPerPage").hide();
      filterFlights();
    });

    // Evento change per la selezione dell'arrivo
    $('#arrivo').change(function () {
      $("#paginationNav").hide();
      $("#rowsPerPage").hide();
      filterFlights();
    });

    // Evento change per la selezione della data di partenza
    $('#departure_date').change(function () {
      $("#paginationNav").hide();
      $("#rowsPerPage").hide();
      filterFlights();
    });


    function clearFilters() {
      // Rimuovi la selezione degli option nei select
      $('#partenza').val(-1);
      $('#arrivo').val(-1);
      // Resetta il valore della data di partenza
      $('#departure_date').val('');

      $('.flight-card').show();
    }

    // Evento click per il reset dei filtri
    $('#resettaFiltri').click(function (e) {
      e.preventDefault();
      clearFilters();
      currentPage = 1;
      showPage(currentPage);
      $("#paginationNav").show();
      $("#rowsPerPage").show();

    });
  });
</script>

@endsection