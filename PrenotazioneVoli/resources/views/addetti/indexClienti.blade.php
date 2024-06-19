@extends('layouts.master')

@section('title')
{{trans("messages.clientiLista")}}
@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans("messages.clientiLista")}}
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
                                data-column="0">{{trans('messages.nome')}}</a></li>
                        <li><a class="dropdown-item searchOptions" href="#"
                                data-column="1">{{trans('messages.cognome')}}</a></li>
                        <li><a class="dropdown-item searchOptions" href="#"
                                data-column="2">{{trans('messages.email')}}</a></li>
                    </ul>
                </div>
                <input type="text" id="searchInput" class="form-control" aria-label="Text input with dropdown button"
                    placeholder="{{trans('messages.search_by_name')}}">
            </div>
        </div>
    </div>
</div>



<div class="container mt-4 mb-4">
    <div class="col-md-12 table-responsive">
        <table id="clientiTable" class="table table-hover table-striped table-bordered table-bordered-custom">
            <col width='20%'>
            <col width='20%'>
            <col width='30%'>
            <col width='15%'>
            <col width='15%'>
            <thead class="table-secondary">
                <tr>
                    <th>{{trans("messages.nome")}}</th>
                    <th>{{trans("messages.cognome")}}</th>
                    <th>{{trans("messages.email")}}</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($utenti as $addetto)
                    <tr>
                        <td>
                            <h6>{{$addetto->nome}}</h6>
                        </td>
                        <td>
                            <h6>{{$addetto->cognome}}</h6>
                        </td>
                        <td>
                            <h6>{{$addetto->email}}</h6>
                        </td>

                        <td class="text-center">
                            <a class="btn btn-warning" href="{{route("addetti.edit", $addetto->id)}}"><i
                                    class="bi bi-pencil-square"></i> {{trans("messages.modifica")}}</a>
                        </td>
                        <td class="text-center">
                            @if($addetto->prenotazioni->count() < 1)
                                <a class="btn btn-danger" href="{{route('addetti.delete', $addetto->id)}}"><i
                                        class="bi bi-trash"></i>
                                    {{trans("messages.elimina")}}</a>
                            @else
                                <a class="btn btn-secondary" disabled="disabled"><i class="bi bi-ban"></i>
                                    {{trans("messages.elimina")}}</a>
                            @endif

                        </td>
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
            $("#clientiTable tbody tr").each(function () {
                var found = false;
                if (column == 0 || column == undefined) {
                    $(this).find("td").slice(0, -4).each(function () {
                        var text = $(this).text().toLowerCase();
                        if (text.indexOf(value) > -1) {
                            found = true;
                        }
                    });
                } else {
                    var $td = $(this).find("td:eq(" + column + ")");
                    if ($td.length > 0) {
                        var text = $td.text().toLowerCase();
                        if (text.indexOf(value) > -1) {
                            found = true;
                        }
                    }
                }
                $(this).toggle(found);
            });
        });

    });
</script>
@endsection