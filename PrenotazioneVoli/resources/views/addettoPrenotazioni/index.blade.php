@extends('layouts.master')

@section('title')
{{trans("messages.addetto_prenotazioni")}}
@endsection

@section('breadcrumb')

<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans("messages.listaVoliConPrenotazioni")}}
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('body')
<div class="container mt-3">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">{{trans('messages.Search_by')}}</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item searchOptions" href="#"
                        data-column="0">{{trans('messages.numero_volo')}}</a>
                </li>
                <li><a class="dropdown-item searchOptions" href="#"
                        data-column="1">{{trans('messages.cittaPartenza')}}</a></li>
                <li><a class="dropdown-item searchOptions" href="#"
                        data-column="-1">{{trans('messages.cittaArrivo')}}</a></li>
                <li><a class="dropdown-item searchOptions" href="#"
                        data-column="-2">{{trans('messages.nome_passenger')}}</a></li>
                <li><a class="dropdown-item searchOptions" href="#"
                        data-column="2">{{trans('messages.tuttiICampi')}}</a></li>
            </ul>
        </div>
        <input type="text" id="searchInput" class="form-control" aria-label="Text input with dropdown button"
            placeholder="{{trans('messages.SearchEverywhere')}}">
    </div>


    <div id="accordion">
        @foreach ($voli as $volo)
                <div class="card mb-3 flight-card bg-white">
                    <div class="card-header" id="heading{{$loop->index}}">
                        <h5 class="mb-1">
                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapse{{$loop->index}}" aria-expanded="false"
                                aria-controls="collapse{{$loop->index}}">
                                <h4>
                                    {{trans('messages.numero_volo')}}: <span
                                        class="flight-number ovu">{{$volo->numeroVolo}}</span>
                                </h4>
                            </button>
                        </h5>
                        {{$volo->aereoportoPartenza->nome}} <i class="bi bi-arrow-right"></i> {{$volo->aereoportoArrivo->nome}}
                    </div>
                    <div id="collapse{{$loop->index}}" class="collapse" aria-labelledby="heading{{$loop->index}}"
                        data-parent="#accordion">
                        <div class="card-body">
                            <p><strong>{{trans('messages.numero_volo')}}:</strong> {{$volo->numeroVolo}}</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>{{trans("messages.aeroportoP")}}:</strong> <span
                                            class="cittaPartenza ovu">{{ $volo->aereoportoPartenza->city }}</span>
                                        ({{$volo->aereoportoPartenza->codice_iata}})</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>{{trans("messages.aeroportoA")}}:</strong><span
                                            class="cittaArrivo ovu">{{$volo->aereoportoArrivo->city}}</span>
                                        ({{$volo->aereoportoArrivo->codice_iata}})</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>{{trans("messages.oraPartenza")}}:</strong><span class="ovu">
                                            {{ \Carbon\Carbon::parse($volo->orarioPartenza)->format('d/m/Y H:i') }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>{{trans("messages.oraArrivo")}}:</strong><span class="ovu">
                                            {{ \Carbon\Carbon::parse($volo->orarioArrivo)->format('d/m/Y H:i') }}</span></p>
                                </div>
                            </div>
                            <p><strong>{{trans("messages.aereo_modello")}}:</strong> <span
                                    class="ovu">{{$volo->aereo->nomeModello}}</span></p>
                            <p><strong>{{trans("messages.postiTotali")}}:</strong> <span
                                    class="ovu">{{$volo->aereo->capacita}}</span></p>
                            <p><strong>{{trans("messages.postiOccupati")}}:</strong>
                                {{ $volo->prenotazioni->reduce(function ($carry, $prenotazione) {
                return $carry + $prenotazione->passeggeri->count();
            }, 0) }}
                            </p>
                            <ul>
                                @foreach ($volo->prenotazioni->flatMap->passeggeri->sortBy(['cognome', 'nome']) as $passeggero)
                                    <li><span class="ovu passeggeroNome">{{$passeggero->cognome}} {{$passeggero->nome}}</span></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
</div>


<script>
    $(document).ready(function () {
        var column = $(this).attr("data-column");

        var currentPage = 1;
        var rowsPerPage = 5;
        flightCards = $(".flight-card");
        var totalPages = Math.ceil(flightCards.length / rowsPerPage);

        showPage(currentPage);

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

        function showPage(page) {
            var start = (page - 1) * rowsPerPage;
            var end = start + rowsPerPage;

            flightCards.hide().slice(start, end).show();


            // Rimuovi i numeri di pagina esistenti
            $(".page-item.pageNumber").remove();

            // Calcola quali numeri di pagina visualizzare
            var startPage = Math.max(1, currentPage - 1);
            var endPage = Math.min(startPage + 2, totalPages);

            // Aggiungere i numeri di pagina calcolati al markup HTML
            for (var i = startPage; i <= endPage; i++) {
                var $li = $("<li>", { class: "page-item pageNumber" });
                var $link = $("<a>", { class: "page-link", href: "#", text: i });
                if (i === currentPage) {
                    $li.addClass("active");
                }
                $li.append($link);
                $li.insertBefore("#lastPage");
            }
        }



















        $(".searchOptions").on("click", function (e) {
            e.preventDefault();
            column = $(this).attr("data-column");
            $("#searchInput").attr("data-column", column);
            $("#searchInput").attr("placeholder", "Search " + $(this).text().toLowerCase() + "...");
            $("#searchInput").trigger("keyup");
        });


        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();


            if (value !== "") {
                $("#paginationNav").hide();
            } else {
                $("#paginationNav").show();
                currentPage = 1; // Riporta alla prima pagina
                showPage(currentPage);
                return;
            }

            if (column == 0) {
                $(".flight-card").each(function () {
                    var flightNumber = $(this).find(".flight-number").text().toLowerCase().trim();
                    if (flightNumber.includes(value)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
            else if (column == 1) {
                //citta partenza
                $(".flight-card").each(function () {
                    var cittaP = $(this).find(".cittaPartenza").text().toLowerCase().trim();
                    if (cittaP.includes(value)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
            else if (column == -1) {
                //citta arrivo
                $(".flight-card").each(function () {
                    var cittaA = $(this).find(".cittaArrivo").text().toLowerCase().trim();
                    if (cittaA.includes(value)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
            else if (column == -2) {
                //citta arrivo
                $(".flight-card").each(function () {
                    var cittaA = $(this).find(".passeggeroNome").text().toLowerCase().trim();
                    if (cittaA.includes(value)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
            else {
                $(".flight-card").each(function () {
                    var all = $(this).find(".ovu").text().toLowerCase().trim();
                    if (all.includes(value)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }




        });
    });
</script>
@endsection