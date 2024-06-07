@extends('layouts.master')

@section('title', 'Lista dei voli')

@section('breadcrumb')
<div class="container mt-3">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        Voli
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
          <form>
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="from">Da:</label>
                  <input type="text" class="form-control" id="from" placeholder="Città di partenza">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="to">A:</label>
                  <input type="text" class="form-control" id="to" placeholder="Città di arrivo">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="departure-date">Data di partenza:</label>
                  <input type="date" class="form-control" id="departure-date">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Numero di passeggeri:</label>
                  <div class="passengers-wrapper">
                    <button type="button" class="btn btn-secondary passenger-btn"
                      onclick="decreasePassenger()">-</button>
                    <input type="text" class="form-control text-center" id="passengers" value="1" readonly>
                    <button type="button" class="btn btn-secondary passenger-btn"
                      onclick="increasePassenger()">+</button>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Cerca voli</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Lista dei voli disponibili -->
  @foreach($voli as $flight)

  <div class="flight-card p-3">
    <h4 class="mb-3">{{$flight->compagnia->nome}} {{$flight->numeroVolo}}</h4>
    <div class="flight-info">
    <div class="row">
      <div class="col-md-2 d-flex align-items-center justify-content-center">
      <div class="flight-detail d-flex flex-column align-items-center justify-content-center">
        <p class="mb-0"><strong>{{\Carbon\Carbon::parse($flight->orarioPartenza)->format('D')}}</strong></p>
        <p class="mb-0"><strong>{{\Carbon\Carbon::parse($flight->orarioPartenza)->format('d/m/Y')}}</strong></p>
      </div>
      </div>
      <div class="col-md-4">
      <div class="flight-detail">
        <h5 class="mb-3">Partenza</h5>
        <p><strong>Da:</strong> {{$flight->aereoportoPartenza->city}}
        ({{$flight->aereoportoPartenza->codice_iata}})</p>
        <p><strong>Ora:</strong> {{\Carbon\Carbon::parse($flight->orarioPartenza)->format('H:i')}}</p>
      </div>
      </div>
      <div class="col-md-4">
      <div class="flight-detail">
        <h5 class="mb-3">Arrivo</h5>
        <p><strong>A:</strong> {{$flight->aereoportoArrivo->city}} ({{$flight->aereoportoArrivo->codice_iata}})
        </p>
        <p><strong>Ora:</strong> {{\Carbon\Carbon::parse($flight->orarioArrivo)->format('H:i') }}</p>
      </div>
      </div>
      <div class="col-md-2 d-flex flex-column justify-content-center align-items-center mt-3 mt-md-0">
      <div class="flight-detail text-center">
        <button class="btn btn-lg btn-primary mb-2">Prenota</button>
        <a href="#" class="btn btn-info mr-2"><i class="bi bi-search"></i>
        Dettagli</a>
      </div>
      </div>
    </div>
    </div>
  </div>

  <div class="row mb-4"></div>
@endforeach

</div>

@endsection