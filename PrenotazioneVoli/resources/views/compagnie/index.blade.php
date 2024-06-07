@extends('layouts.master')

@section('title', 'Admin Page')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>

            <li class="breadcrumb-item active" aria-current="page">
                Lista Compagnie
            </li>
        </ol>
    </nav>
</div>
@endsection


@section('body')
<div class="container mt-4 ">
    <div class="col-xs-6 d-flex justify-content-end">
        <a href="{{ route("compagnie.create") }}" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i>
            Aggiungi nuova compagnia</a>
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
                    <th>Nome Compagnia</th>
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
                        <td>
                            <a href="{{ route("compagnie.show", $compagnia->id) }}" class="btn btn-info mr-2"><i
                                    class="bi bi-search"></i> Dettagli</a>
                        </td>
                        <td>
                            <a href="{{ route("compagnie.edit", $compagnia->id) }}" class="btn btn-warning mr-2"><i
                                    class="bi bi-pencil-square"></i> Modifica</a>
                        </td>
                        <td>
                            @if($compagnia->voli->count() > 0)
                                <a class="btn btn-secondary" disabled="disabled"><i class="bi bi-ban"></i> Elimina</a>
                            @else
                                <a class="btn btn-danger" href="{{route("compagnie.destroy.confirm", $compagnia->id)}}"><i
                                        class="bi bi-trash"></i> Elimina</a>

                            @endif
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection