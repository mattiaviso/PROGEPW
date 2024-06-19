@extends('layouts.master')

@section('title')
{{trans("messages.lista_aeroporti")}}
@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans("messages.lista_aeroporti")}}
            </li>
        </ol>
    </nav>
</div>
@endsection


@section('body')

<div class="container">
    <div class="row">
        <div class="col-md-6 mt-1">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="bi bi-search"></i> {{trans('messages.Search_by')}}</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item searchOptions" href="#"
                                data-column="0">{{trans('messages.country')}}</a></li>
                        <li><a class="dropdown-item searchOptions" href="#"
                                data-column="1">{{trans('messages.nome')}}</a></li>
                    </ul>
                </div>
                <input type="text" id="searchInput" class="form-control" aria-label="Text input with dropdown button"
                    placeholder="{{trans('messages.search_by_name')}}">
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end mt-1">
            <a href="{{ route("aereoporti.create") }}" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i>
                {{trans("messages.aggiungiAeroporto")}}</a>
        </div>
    </div>
</div>

<div class="container mt-4 mb-4">
    <div class="col-md-12 table-responsive">
        <table id="airportTable" class="table table-hover table-striped table-bordered table-bordered-custom">
            <col width='40%'>
            <col width='20%'>
            <col width='20%'>
            <col width='20%'>
            <thead class="table-secondary">
                <tr>
                    <th>{{trans("messages.nomeAeroporto")}}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($airports_list as $airport)
                    <tr>
                        <td>
                            <h6>{{$airport->nome}}</h6>
                        </td>
                        <td class="text-center">
                            <a href="{{ route("aereoporti.show", $airport->id) }}" class="btn btn-info mr-2"><i
                                    class="bi bi-search"></i> {{trans("messages.dettagli")}}</a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route("aereoporti.edit", $airport->id) }}" class="btn btn-warning mr-2"><i
                                    class="bi bi-pencil-square"></i> {{trans("messages.modifica")}}</a>
                        </td>
                        <td class="text-center">
                            @if(count($airport->voliPartenza) < 1)
                                @if ($airport->voliArrivo->count() < 1)
                                    <a class="btn btn-danger" href="{{ route("aereoporti.destroy.confirm", $airport->id) }}"><i
                                            class="bi bi-trash"></i> {{trans("messages.elimina")}}</a>
                                @else
                                    <a class="btn btn-secondary" disabled="disabled"><i class="bi bi-ban"></i>
                                        {{trans("messages.elimina")}}</a>
                                @endif

                            @else
                                <a class="btn btn-secondary" disabled="disabled"><i class="bi bi-ban"></i>
                                    {{trans("messages.elimina")}}</a>
                            @endif

                        </td>
                        <td class="d-none nazione">{{$airport->country}}</td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
    $(document).ready(function () {

        $(".searchOptions").on("click", function (e) {
            e.preventDefault();
            var column = $(this).attr("data-column");
            $("#searchInput").attr("data-column", column);
            $("#searchInput").attr("placeholder", "{{trans('messages.Search_by')}} " + $(this).text().toLowerCase() + "...");
            $("#searchInput").trigger("keyup");
        });

        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            var column = $("#searchInput").attr("data-column");
            $("#airportTable tbody tr").each(function () {
                var found = false;
                if (column == 1 || column == undefined) {
                    $(this).find("td").slice(0, -3).each(function () {
                        var text = $(this).text().toLowerCase();
                        if (text.indexOf(value) > -1) {
                            found = true;
                        }
                    });
                } else {
                    //trova in Nazione
                    var text = $(this).find(".nazione").text().toLowerCase();
                    if (text.indexOf(value) > -1) {
                        found = true;
                    }
                }
                $(this).toggle(found);
            });
        });
    });

</script>

@endsection