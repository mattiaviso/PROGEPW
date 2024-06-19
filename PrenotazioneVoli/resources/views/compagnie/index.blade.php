@extends('layouts.master')

@section('title')
{{trans("messages.lista_compagnie")}}
@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>

            <li class="breadcrumb-item active" aria-current="page">
                {{trans("messages.lista_compagnie")}}
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
                    placeholder="{{trans('messages.searchNomeComapgnia')}}">
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end mt-1">
            <a href="{{ route("compagnie.create") }}" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i>
                {{trans("messages.aggiungiCompagnia")}}</a>
        </div>
    </div>
</div>



<div class="container mt-4 mb-4">
    <div class="col-md-12 table-responsive">
        <table id="companyTable" class="table table-hover table-striped table-bordered table-bordered-custom">
            <col width='40%'>
            <col width='20%'>
            <col width='20%'>
            <col width='20%'>
            <thead class="table-secondary">
                <tr>
                    <th>{{trans("messages.nomeCompagnia")}}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compagnie as $compagnia)
                    <tr>
                        <td>
                            <h6>{{$compagnia->nome}}</h6>
                        </td>
                        <td class="text-center">
                            <a href="{{ route("compagnie.show", $compagnia->id) }}" class="btn btn-info mr-2"><i
                                    class="bi bi-search"></i> {{trans("messages.dettagli")}}</a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route("compagnie.edit", $compagnia->id) }}" class="btn btn-warning mr-2"><i
                                    class="bi bi-pencil-square"></i> {{trans("messages.modifica")}}</a>
                        </td>
                        <td class="text-center">
                            @if($compagnia->voli->count() > 0)
                                <a class="btn btn-secondary" disabled="disabled"><i class="bi bi-ban"></i>
                                    {{trans("messages.elimina")}}</a>
                            @else
                                <a class="btn btn-danger" href="{{route("compagnie.destroy.confirm", $compagnia->id)}}"><i
                                        class="bi bi-trash"></i> {{trans("messages.elimina")}}</a>

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
        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#companyTable tbody tr").each(function () {
                var found = false;
                $(this).find("td").slice(0, -3).each(function () {
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