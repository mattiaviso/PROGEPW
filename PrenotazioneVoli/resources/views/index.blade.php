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

<div class="container mt-3">
  <div class="row">
    <div class="col-12">
      <div class="text-center">
        <p class="lead">{{trans('messages.messaggio_inizio')}}</p>
        <a href="{{ route('voli.index') }}" class="btn btn-primary">{{trans('messages.scopriVoliDisponibili')}}</a>
      </div>
    </div>
  </div>

  <div id="carouselExampleIndicators" class="carousel slide mt-3 mb-3" data-ride="carousel">
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
          <p><a href="{{ route('search', 'Dubai') }}"
              style="color: white; text-decoration: underline;">{{trans('messages.voli_dubai')}}</a></p>

        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{ url('/') }}/img/sanfra.jpg" alt="San Francisco">
        <div class="carousel-caption d-none d-md-block">
          <h5>San Francisco</h5>
          <p><a href="{{ route('search', 'San Francisco') }}"
              style="color: white; text-decoration: underline;">{{trans('messages.voli_sanfra')}}</a></p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="https://i.pinimg.com/originals/33/21/f8/3321f81d342b9a23fb8ea910dc83e325.jpg"
          alt="New York">
        <div class="carousel-caption d-none d-md-block">
          <h5>New York</h5>
          <p><a href="{{ route('search', 'New York') }}"
              style="color: white; text-decoration: underline;">{{trans('messages.voli_ny')}}</a></p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">{{trans('messages.previous')}}</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">{{trans('messages.next')}}</span>
    </a>
  </div>
</div>



@endsection