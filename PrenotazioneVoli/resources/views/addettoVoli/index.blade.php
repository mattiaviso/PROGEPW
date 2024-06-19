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
                {{trans('messages.lista_voli')}}
            </li>
        </ol>
    </nav>
</div>

@endsection


@section('body')

<div class="container mt-4 ">

    <div class="row">
        <div class="input-group mb-3 col-md-12">
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
                            data-column="2">{{trans('messages.tuttiICampi')}}</a></li>
                </ul>
            </div>
            <input type="text" id="searchInput" class="form-control" aria-label="Text input with dropdown button"
                placeholder="{{trans('messages.SearchEverywhere')}}">
        </div>
    </div>


    <div class="row">
        <div class="col-md-3 text-right mb-3">
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
        <div class="col-md-3 text-right mb-3">
            <a href="{{ route("voli.create") }}" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i>
                {{ trans('messages.aggiungiVolo') }}</a>
        </div>
    </div>

    <div id="accordion">
        @foreach ($voli as $volo)
            <div class="card mb-3 flight-card bg-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="card-title">{{ trans('messages.numero_volo') }}: <span
                                    class="numeroVoloId ovu">{{ $volo->numeroVolo }}</span></h5>
                            <p><strong>{{ trans('messages.aeroportoP') }}:</strong> <span
                                    class="cittaPartenza ovu">{{$volo->aereoportoPartenza->city }}</span>
                            </p>
                            <p><strong>{{trans('messages.oraPartenza')}}:</strong> <span
                                    class="ovu">{{ \Carbon\Carbon::parse($volo->orarioPartenza)->format('d/m/Y H:i') }}</span>
                            </p>
                        </div>
                        <div class="col-md-5">
                            <hr class="my-3">
                            <p><strong>{{ trans('messages.aeroportoA') }}:</strong> <span
                                    class="cittaArrivo ovu">{{ $volo->aereoportoArrivo->city }}</span>
                            </p>
                            <p><strong>{{trans('messages.oraArrivo')}}:</strong> <span
                                    class="ovu">{{ \Carbon\Carbon::parse($volo->orarioArrivo)->format('d/m/Y H:i') }}</span>
                            </p>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-2">
                                <a href="{{ route('voli.show', $volo->id) }}" class="btn btn-info w-100"><i
                                        class="bi bi-search"></i> {{ trans('messages.dettagli') }}</a>
                            </div>
                            <div class="mb-2">
                                <a href="{{ route("voli.edit", $volo->id) }}" class="btn btn-warning w-100"><i
                                        class="bi bi-pencil-square"></i> {{ trans('messages.modifica') }}</a>
                            </div>
                            <div>
                                @if ($volo->prenotazioni->count() > 0)
                                    <button class="btn btn-secondary w-100" disabled><i class="bi bi-ban"></i>
                                        {{ trans('messages.elimina') }}</button>
                                @else
                                    <a href="{{ route('voli.destroy.confirm', $volo->id) }}" class="btn btn-danger w-100"><i
                                            class="bi bi-trash"></i> {{ trans('messages.elimina') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>

    $(document).ready(function () {
        // Pagination feature
        var currentPage = 1;
        var rowsPerPage = parseInt($("#rowsPerPage").val()); // Numero di righe per pagina
        flightCards = $(".flight-card");
        var totalPages = Math.ceil(flightCards.length / rowsPerPage);
        var column = 2;

        showPage(currentPage);


        $(".searchOptions").on("click", function (e) {
            e.preventDefault();
            column = $(this).attr("data-column");
            $("#searchInput").attr("data-column", column);
            $("#searchInput").attr("placeholder", "{{trans('messages.Search_by')}} " + $(this).text().toLowerCase() + "...");
            $("#searchInput").trigger("keyup");
        });

        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();

            if (value !== "") {
                $("#paginationNav").hide();
                $("#rowsPerPage").hide();

            } else {
                $("#paginationNav").show();
                $("#rowsPerPage").show();
                currentPage = 1; // Riporta alla prima pagina
                showPage(currentPage);
                return;
            }


            if (column == 0) {
                $(".flight-card").each(function () {
                    var flightNumber = $(this).find(".numeroVoloId").text().toLowerCase().trim();
                    if (flightNumber.includes(value)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            } else if (column == 1) {
                $(".flight-card").each(function () {
                    var flightNumber = $(this).find(".cittaPartenza").text().toLowerCase().trim();
                    if (flightNumber.includes(value)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            } else if (column == -1) {
                $(".flight-card").each(function () {
                    var flightNumber = $(this).find(".cittaArrivo").text().toLowerCase().trim();
                    if (flightNumber.includes(value)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            } else {
                $(".flight-card").each(function () {
                    var flightNumber = $(this).find(".ovu").text().toLowerCase().trim();
                    if (flightNumber.includes(value)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });

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
    });
</script>
@endsection