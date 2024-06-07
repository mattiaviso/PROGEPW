<?php

use App\Http\Controllers\AddettiController;
use App\Http\Controllers\AereoController;
use App\Http\Controllers\ClientiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AereoportoController;
use App\Http\Controllers\CompagniaController;
use App\Http\Controllers\VoliController;
use App\Http\Controllers\PrenotazioniController;
use App\Models\DataLayer;
use App\Http\Controllers\AuthController;


Route::get('/', [FrontController::class, 'getHome'])->name('home');

//fammi la rotta che mostra la view welcome
Route::get('/welcome', function () {
    $dl = new DataLayer();
    $voli = $dl->listVoli();
    return view('welcome')->with('voli', $voli);
})->name('welcome');



Route::get('/user/login', [AuthController::class, 'authentication'])->name('user.login');
Route::post('/user/login', [AuthController::class, 'login'])->name('user.login');

Route::get('/user/register', [AuthController::class, 'registrazione'])->name('user.register');
Route::post('/user/register', [AuthController::class, 'registration'])->name('user.register');
Route::get('/user/logout', [AuthController::class, 'logout'])->name('user.logout');


Route::group(['middleware' => ['authCustom', 'isCliente']], function () {
    Route::get('/voli/?search={id}', [VoliController::class, 'search'])->name('voli.search');
    Route::resource('clienti', ClientiController::class);
    Route::resource('prenotazioni', PrenotazioniController::class);
    Route::post('/voli/aggiorna', [PrenotazioniController::class, 'aggiorna'])->name('aggiorna');


});

Route::group(['middleware' => ['authCustom', 'isAddettoVolo']], function () {
    Route::get('/addettoVoli', function () {
        $dl = new DataLayer();
        $compagnia_id = $dl->findCompagniaByUserID($_SESSION['loggedID']);
        $voli = $dl->listVoliByCompagniaId($compagnia_id);
        return view('addettoVoli.index')->with('voli', $voli);
    })->name('addettoVoli');

    Route::get('voli/create', [VoliController::class, 'create'])->name('voli.create');     // Mostra form per creare un nuovo volo
    Route::post('voli', [VoliController::class, 'store'])->name('voli.store');             // Salva il nuovo volo creato
    Route::get('voli/{voli}/edit', [VoliController::class, 'edit'])->name('voli.edit');     // Mostra form per modificare un volo
    Route::put('voli/{voli}', [VoliController::class, 'update'])->name('voli.update');      // Salva le modifiche ad un volo
    Route::delete('voli/{voli}', [VoliController::class, 'destroy'])->name('voli.destroy'); // Cancella un volo

    Route::get('/voli/{id}/destroy/confirm', [VoliController::class, 'confirmDestroy'])->name('voli.destroy.confirm');
});

Route::group(['middleware' => ['authCustom', 'isClienteOrVolo']], function () {
    //Route::resource('voli', VoliController::class);
    Route::get('/voli', [VoliController::class, 'index'])->name('voli.index');
    Route::get('voli/{volo}', [VoliController::class, 'show'])->name('voli.show');         // Mostra singolo volo
});



Route::group(
    ['middleware' => ['authCustom', 'isAddettoPrenotazioni']],
    function () {

        Route::get('/addettoPrenotazioni', function () {
            $dl = new DataLayer();
            $prenotazioni = $dl->listPrenotazioni();
            $voli = $dl->listVoli();
            return view('addettoPrenotazioni.index')->with('prenotazioni', $prenotazioni)->with('voli', $voli);
        })->name('addettoPrenotazioni');


    }
);



Route::get('/profilo', [ClientiController::class, 'profilo'])->name('profilo')->middleware('authCustom');

Route::group(['middleware' => ['authCustom', 'isAdmin']], function () {
    Route::resource('aereoporti', AereoportoController::class);
    Route::get('/aereoporti/{id}/destroy/confirm', [AereoportoController::class, 'confirmDestroy'])->name('aereoporti.destroy.confirm');
    Route::resource('compagnie', CompagniaController::class);
    Route::get('/compagnie/{id}/destroy/confirm', [CompagniaController::class, 'confirmDestroy'])->name('compagnie.destroy.confirm');
    Route::resource('aerei', AereoController::class);
    Route::get('/aerei/{id}/destroy/confirm', [AereoController::class, 'confirmDestroy'])->name('aerei.destroy.confirm');
    Route::resource('addetti', AddettiController::class);
    Route::get('/admin/addettiVoli', [AddettiController::class, 'indexVoli'])->name('addetti.indexVoli');
    Route::get('/admin/addettiPrenotazioni', [AddettiController::class, 'indexPrenotazioni'])->name('addetti.indexPrenotazioni');

});





