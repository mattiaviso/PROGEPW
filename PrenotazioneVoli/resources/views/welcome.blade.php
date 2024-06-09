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
<div class="container mt-3 mb-3">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="https://images2.alphacoders.com/102/1020217.jpg" alt="Dubai">
        <div class="carousel-caption d-none d-md-block">
          <h5>Dubai</h5>
          <p>Scopri le bellezze di Dubai.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{ url('/') }}/img/sanfra.jpg" alt="San Francisco">
        <div class="carousel-caption d-none d-md-block">
          <h5>San Francisco</h5>
          <p>Esplora la magnifica città di San Francisco.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="https://i.pinimg.com/originals/33/21/f8/3321f81d342b9a23fb8ea910dc83e325.jpg"
          alt="New York">
        <div class="carousel-caption d-none d-md-block">
          <h5>New York</h5>
          <p>Visita la città che non dorme mai, New York.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>



@endsection