@extends('layouts.master')

@section('title', 'Termini e Condizioni')

@section('body')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Termini e Condizioni</h1>
            <p>Benvenuto su VolaFacile.it. Si prega di leggere attentamente i seguenti Termini e Condizioni prima di
                utilizzare il nostro sito web.</p>

            <h2>1. Accettazione dei Termini</h2>
            <p>Utilizzando il nostro sito web, si accettano pienamente e senza riserve questi Termini e Condizioni.
                L'uso del sito implica l'accettazione di tutte le disposizioni contenute in questo documento. Se non si
                accettano questi Termini e Condizioni, si prega di non utilizzare il sito web.</p>

            <h2>2. Utilizzo del Sito Web</h2>
            <p>I contenuti del sito web sono forniti solo a scopo informativo e per l'uso personale degli utenti. È
                vietato l'uso commerciale non autorizzato del sito web o dei suoi contenuti. Tutti i visitatori del sito
                devono rispettare le leggi e le normative applicabili.</p>

            <h2>3. Registrazione e Account</h2>
            <p>Per accedere a determinate funzionalità del sito web, potrebbe essere richiesta la registrazione di un
                account. Gli utenti sono responsabili della custodia delle proprie credenziali di accesso e dell'uso
                sicuro del proprio account. Qualsiasi attività condotta con l'account è di esclusiva responsabilità
                dell'utente registrato.</p>

            <h2>4. Proprietà Intellettuale</h2>
            <p>Tutti i contenuti presenti sul sito web, inclusi testi, grafica, loghi, immagini e software, sono di
                proprietà di VolaFacile.it o dei suoi licenzianti e sono protetti dalle leggi sul diritto d'autore e
                altre leggi applicabili. È vietato copiare, modificare, distribuire o riprodurre qualsiasi contenuto
                senza autorizzazione.</p>

            <h2>5. Limitazione di Responsabilità</h2>
            <p>Il sito web è fornito "così com'è" e "come disponibile", senza garanzie di alcun tipo. Non ci assumiamo
                alcuna responsabilità per eventuali perdite o danni derivanti dall'uso del sito web o dei suoi
                contenuti. Ci impegniamo a fornire informazioni accurate e aggiornate, ma non possiamo garantire la
                completezza o la precisione delle informazioni fornite.</p>

            <h2>6. Modifiche ai Termini</h2>
            <p>Ci riserviamo il diritto di modificare o aggiornare questi Termini e Condizioni in qualsiasi momento. Si
                consiglia di controllare periodicamente questa pagina per eventuali modifiche. L'uso continuato del sito
                web dopo la pubblicazione delle modifiche costituirà una conferma della vostra accettazione delle
                modifiche. È responsabilità dell'utente essere consapevoli delle modifiche ai Termini e Condizioni.</p>

            <h2>7. Legge Applicabile</h2>
            <p>Questi Termini e Condizioni sono regolati e interpretati in conformità con le leggi dello Stato in cui è
                registrata la società. In caso di controversia, le parti accettano di sottoporsi alla giurisdizione
                esclusiva dei tribunali di tale Stato. L'interpretazione e l'applicazione di questi Termini e Condizioni
                saranno conformi alle leggi applicabili.</p>

            <h2>8. Disposizioni Generali</h2>
            <p>Se una qualsiasi disposizione di questi Termini e Condizioni viene considerata non valida o non
                applicabile da un tribunale competente, tale disposizione sarà limitata o eliminata nella misura minima
                necessaria e le restanti disposizioni rimarranno pienamente valide ed efficaci. Nessuna rinuncia a
                qualsiasi parte di questi Termini e Condizioni costituirà una rinuncia a eventuali diritti legali.</p>

            <h2>9. Contattaci</h2>
            <p>Se avete domande o dubbi sui nostri Termini e Condizioni, non esitate a contattarci. Siamo qui per
                fornire assistenza e chiarimenti su qualsiasi aspetto dei nostri Termini e Condizioni. La vostra
                soddisfazione è la nostra priorità.</p>

            <p>VolaFacile.it si impegna a fornire ai suoi clienti un servizio di alta qualità e un'esperienza di viaggio
                indimenticabile. Siamo qui per aiutarti a pianificare il tuo prossimo viaggio, rispondere alle tue
                domande e assisterti in ogni fase del tuo viaggio. La tua soddisfazione è la nostra priorità.</p>
        </div>
    </div>
</div>

<!-- Bottone "Torna su" -->
<button onclick="topFunction()" id="scrollBtn" title="Torna su" class="btn btn-light rounded-circle shadow"
    style="position: fixed; bottom: 20px; right: 20px; display: none;">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
    // Get the button
    var mybutton = document.getElementById("scrollBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () { scrollFunction(); };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
</script>
@endsection