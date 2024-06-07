@extends('layouts.master')

@section('title', 'Aereoporti')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Aereoporti
            </li>
        </ol>
    </nav>
</div>

@endsection




@section('body')

<div class="container mt-4 ">
    <div class="col-xs-6 d-flex justify-content-end">
        <a href="{{ route("aereoporti.create") }}" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i>
            Aggiungi nuovo
            aeroporto</a>
    </div>
</div>


<div class="container mt-4">
    <div class="col-md-12">
        <table class="table table-hover">
            <col width='40%'>
            <col width='20%'>
            <col width='20%'>
            <col width='20%'>
            <thead>
                <tr>
                    <th>Nome Aereoporto</th>
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
                        <td>
                            <a href="{{ route("aereoporti.show", $airport->id) }}" class="btn btn-info mr-2"><i
                                    class="bi bi-search"></i> Dettagli</a>
                        </td>
                        <td>
                            <a href="{{ route("aereoporti.edit", $airport->id) }}" class="btn btn-warning mr-2"><i
                                    class="bi bi-pencil-square"></i> Modifica</a>
                        </td>
                        <td>
                            <!-- fai if se un aereoporto ha in arrivo o in partenza un volo allora permetti di eliminare l'aereoporto -->
                            @if(count($airport->voliPartenza) < 1)
                                @if ($airport->voliArrivo->count() < 1)
                                    <a class="btn btn-danger" href="{{ route("aereoporti.destroy.confirm", $airport->id) }}"><i
                                            class="bi bi-trash"></i> Delete</a>
                                @else
                                    <a class="btn btn-secondary" disabled="disabled"><i class="bi bi-ban"></i> Elimina</a>
                                @endif

                            @else
                                <a class="btn btn-secondary" disabled="disabled"><i class="bi bi-ban"></i> Elimina</a>
                            @endif

                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection