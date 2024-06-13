<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- jQuery e plugin JavaScript  -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />


    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JavaScript -->

    <script>
        function increasePassenger() {
            var passengersInput = document.getElementById("passengers");
            var currentPassengers = parseInt(passengersInput.value);
            passengersInput.value = currentPassengers + 1;
        }

        function decreasePassenger() {
            var passengersInput = document.getElementById("passengers");
            var currentPassengers = parseInt(passengersInput.value);
            if (currentPassengers > 1) {
                passengersInput.value = currentPassengers - 1;
            }
        }
    </script>

    <style>
        body {
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .flight-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            position: relative;
        }

        .btn-book {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        .content-wrapper {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .passengers-wrapper {
            display: flex;
            align-items: center;
        }

        .passenger-btn {
            margin: 0 5px;
        }

        a:hover {
            text-decoration: underline;
        }

        .wrapper {
            flex: 1;
        }
    </style>
</head>

<body>
    <header class="bg-dark text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 text-left">
                    <a href="{{route('home')}}" class="text-white text-decoration-none">
                        <h1 class="mb-0">VolaFacile.it</h1>
                    </a>
                </div>
                <div class="col-md-2">
                    <div class="dropdown text-right">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="languageDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{trans('messages.seleziona_lingua')}}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li>
                                <a class="dropdown-item" href="{{route('setLang', ['lang' => 'it'])}}">
                                    <img src="{{ asset('img/flags/it.svg') }}" width="20" alt="Italian Flag"
                                        class="me-2">
                                    Italiano
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{route('setLang', ['lang' => 'en'])}}">
                                    <img src="{{ asset('img/flags/us.svg') }}" width="20" alt="Italian Flag"
                                        class="me-2">
                                    English
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{route('setLang', ['lang' => 'es'])}}">
                                    <img src="{{ asset('img/flags/es.svg') }}" width="20" alt="Italian Flag"
                                        class="me-2">
                                    Español
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{route('setLang', ['lang' => 'de'])}}">
                                    <img src="{{ asset('img/flags/de.svg') }}" width="20" alt="Italian Flag"
                                        class="me-2">
                                    Deutsch
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 text-md-right text-center mt-2 mt-md-0">
                    @if((isset($_SESSION['logged'])) && ($_SESSION['logged']))
                        <label class="text-white">{{trans('messages.welcome')}} {{session('language')}}
                            {{ strtoupper($_SESSION['loggedName']) }}
                            !!!</label>
                    @else
                        <a type="button" class="btn btn-outline-light me-2"
                            href="{{route('user.login')}}">{{trans('messages.login')}}</a>
                        <a type="button" class="btn btn-outline-light me-2"
                            href="{{route('user.register')}}">{{trans('messages.registrati')}}</a>
                    @endif
                </div>
            </div>
        </div>
    </header>


    <div>

        @if((isset($_SESSION['logged'])) && ($_SESSION['logged']))
            @if ($_SESSION['ruolo'] == 'cliente')
                <div class="container mt-3">
                    <nav class="navbar navbar-expand-md navbar-light bg-light">
                        <a class="navbar-brand" href="{{route('home')}}">Home</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto  mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('voli.index')}}">{{trans('messages.prenota_volo')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{route('prenotazioni.index')}}">{{trans('messages.prenotazioni')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('profilo')}}">{{trans('messages.profilo')}}</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('user.logout')}}">{{trans('messages.logout')}}</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            @endif
            @if ($_SESSION['ruolo'] == 'admin')
                <div class="container mt-3">
                    <nav class="navbar navbar-expand-md navbar-light bg-light">
                        <a class="navbar-brand" href="{{route('home')}}">Home</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto  mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('aereoporti.index') }}">{{trans('messages.aereoporti')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('compagnie.index') }}">{{trans('messages.compagnie')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('aerei.index') }}">{{trans('messages.aerei_modello')}}</a>
                                </li>
                                <li class="nav-item">
                                    <div class="dropdown">
                                        <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{trans('messages.userCategory')}}
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{ route('addetti.indexVoli') }}">{{trans('messages.addetto_inserimento')}}</a>
                                            <a class="dropdown-item"
                                                href="{{ route('addetti.indexPrenotazioni') }}">{{trans('messages.addetto_prenotazioni')}}</a>
                                            <a class="dropdown-item"
                                                href="{{route('addetti.clienti')}}">{{trans('messages.clienti')}}</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('profilo')}}">{{trans('messages.profilo')}}</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('user.logout')}}">{{trans('messages.logout')}}</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            @endif
            @if ($_SESSION['ruolo'] == 'inserimento')
                <div class="container mt-3">
                    <nav class="navbar navbar-expand-md navbar-light bg-light">
                        <a class="navbar-brand" href="{{route('home')}}">Home</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto  mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('addettoVoli') }}">{{trans('messages.lista_voli')}}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('profilo')}}">{{trans('messages.profilo')}}</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('user.logout')}}">{{trans('messages.logout')}}</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            @endif
            @if ($_SESSION['ruolo'] == 'prenotazioni')
                <div class="container mt-3">
                    <nav class="navbar navbar-expand-md navbar-light bg-light">
                        <a class="navbar-brand" href="{{route('home')}}">Home</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto  mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{route('addettoPrenotazioni')}}">{{trans('messages.lista_prenotazioni_per_volo')}}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('profilo')}}">{{trans('messages.profilo')}}</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('user.logout')}}">{{trans('messages.logout')}}</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            @endif
        @endif



        <!--breadcrumb-->
        @yield('breadcrumb')
        <div class="container-fluid">
            @yield('body')
        </div>



        <div class="wrapper">
            <!-- il tuo contenuto va qui -->
        </div>
        <footer class="bg-dark text-white border-top">
            <div class="container py-4">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <a href="/"
                            class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none text-white">
                            <h1 class="m-0">VolaFacile.it</h1>
                        </a>
                        <p class="text-muted">{{trans('messages.foot')}}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h5 class="text-white">Contatti</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2">
                                <span class="nav-link p-0 text-white">{{trans('messages.telefono')}}: 0123456789</span>
                            </li>
                            <li class="nav-item mb-2">
                                <span class="nav-link p-0 text-white">{{trans('messages.email')}}:
                                    info@volafacile.it</span>
                            </li>
                            <li class="nav-item mb-2">
                                <span class="nav-link p-0 text-white">{{trans('messages.indirizzo')}}: Via Roma 123,
                                    Milano</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h5 class="text-white">Link Utili</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2">
                                <a href="{{route('altro.who')}}"
                                    class="nav-link p-0 text-white">{{trans('messages.chi_siamo')}}</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="{{route('altro.privacy')}}"
                                    class="nav-link p-0 text-white">{{trans('messages.privacy')}}</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="{{route('altro.termini')}}"
                                    class="nav-link p-0 text-white">{{trans('messages.termini')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col text-center">
                        <a href="#" class="text-white mx-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white mx-2"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col text-center">
                        <p class="text-muted">&copy; {{trans('messages.diritti')}}</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>



    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>