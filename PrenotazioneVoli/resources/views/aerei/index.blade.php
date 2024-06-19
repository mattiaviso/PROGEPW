@extends('layouts.master')

@section('title')
{{trans("messages.lista_aerei")}}

@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans("messages.lista_aerei")}}
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
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>
                </div>
                <input type="text" id="searchInput" class="form-control" aria-label="Text input with dropdown button"
                    placeholder="{{trans('messages.SearchNomeModello')}}">
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end mt-1">
            <a href="{{ route("aerei.create") }}" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i>
                {{trans("messages.aggiungiAereo")}}</a>
        </div>
    </div>
</div>



<div class="container mt-4 mb-4">
    <div class="col-md-12 table-responsive">
        <table id="airplaneTable" class="table table-hover table-striped table-bordered table-bordered-custom">
            <col width='30%'>
            <col width='20%'>
            <col width='25%'>
            <col width='25%'>
            <thead class="table-secondary">
                <tr>
                    <th>{{trans("messages.nomeModello")}}</th>
                    <th class="text-center">{{trans("messages.capacitaPosti")}}</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aerei as $aereo)
                    <tr>
                        <td>{{$aereo->nomeModello}}</td>
                        <td class="text-center">{{$aereo->capacita}}</td>
                        <td class="text-center">

                            @if($aereo->voli->count() > 0)
                                <button class="btn btn-secondary disabled" disabled><i class="bi bi-ban"></i>
                                    {{trans("messages.elimina")}}</button>
                            @else
                                <a class="btn btn-danger" href="{{route("aerei.destroy.confirm", $aereo->id)}}"><i
                                        class="bi bi-trash"></i> {{trans("messages.elimina")}}</a>
                            @endif

                        </td>
                        <td class="text-center">
                            <a class="btn btn-warning " href="{{route("aerei.edit", $aereo->id)}}"><i
                                    class="bi bi-pencil"></i> {{trans('messages.modifica')}}</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
    $(document).ready(function () {
        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#airplaneTable tbody tr").each(function () {
                var found = false;
                $(this).find("td").slice(0, -2).each(function () {
                    var text = $(this).text().toLowerCase();
                    if (text.indexOf(value) > -1) {
                        found = true;
                    }
                });
                $(this).toggle(found);
            });
        });
    });
</script>

@endsection