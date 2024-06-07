@extends('layouts.master')

@section('title', 'HOMEPAGE')




@section('breadcrumb')
<div class="container mt-3">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-end">
      <li class="breadcrumb-item active">
        <a><i class="fas fa-home me-1"></i>Home</a>
      </li>
    </ol>
  </nav>
</div>

@endsection

@section('body')


<!-- Fai breve intro sul sito  e fai bottone che porta alla visualizzazione dei voli-->
<div class="container mt-3">
  <div class="row">
    <div class="col-12">
      <h1 class="text-center">Benvenuto su VolaFacile.it</h1>
      <p class="text-center">Il sito dove puoi prenotare i tuoi voli in modo semplice e veloce</p>
      <div class="text-center">
        <a href="{{ route('voli.index') }}" class="btn btn-primary">Visualizza voli</a>
      </div>
    </div>
  </div>




  <div id="carouselExampleCaptions" class="carousel slide container mt-3 carousel-ml mb-3">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://images2.alphacoders.com/102/1020217.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h2>DUBAI</h2>
          <p style="text-decoration: underline; cursor: pointer;"
            onclick="window.location='{{ route('voli.search', 'Dubai') }}';">
            GUARDA VOLI PER DUBAI</p>

        </div>
      </div>
      <div class="carousel-item">
        <img src=" {{ url('/') }}/img/sanfra.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h2>San Francisco</h2>
          <p style="text-decoration: underline; cursor: pointer;"
            onclick="window.location='{{ route('voli.search', 'San Francisco') }}';">
            PARTI SUBITO PER SAN FRANCISCO</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://i.pinimg.com/originals/33/21/f8/3321f81d342b9a23fb8ea910dc83e325.jpg" class="d-block w-100"
          alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h2>New York
          </h2>
          <p style="text-decoration: underline; cursor: pointer;"
            onclick="window.location='{{ route('voli.search', 'New York') }}';">
            PRENOTA SUBITO IL VOLO</p>
        </div>
      </div>
    </div>
    <style>
      .carousel-control-prev,
      .carousel-control-next {
        background-color: transparent;
        border: none;
      }
    </style>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>

  </div>


  <a href="{{ route('prenotazioni.index') }}">Lista prenotazioni</a>



  @endsection