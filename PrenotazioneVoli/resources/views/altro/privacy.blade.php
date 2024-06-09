@extends('layouts.master')

@section('title', 'Privacy Policy')

@section('body')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Privacy Policy</h1>
            <p><strong>Informazioni Generali</strong></p>
            <p>La presente informativa sulla privacy descrive come VolaFacile.it raccoglie e utilizza le informazioni
                personali degli utenti del sito web. Utilizzando il nostro sito web, si accetta la raccolta e l'utilizzo
                delle informazioni in conformità con questa politica. I termini utilizzati in questa politica hanno i
                significati stabiliti nei nostri Termini e Condizioni, accessibili dal sito web.</p>

            <p><strong>Raccolta e Utilizzo delle Informazioni</strong></p>
            <p>Raccogliamo diversi tipi di informazioni per vari scopi, al fine di fornire e migliorare i nostri
                servizi.</p>
            <p>I tipi di dati personali che raccogliamo possono includere:</p>
            <ul>
                <li>Dati di contatto, come nome, indirizzo email, numero di telefono, ecc., che ci vengono forniti
                    volontariamente quando ci si registra sul sito, effettua una prenotazione o contatta il nostro
                    servizio clienti.</li>
                <li>Dati di pagamento, che vengono raccolti per elaborare le transazioni finanziarie quando si effettua
                    una prenotazione attraverso il nostro sito.</li>
                <li>Dati di navigazione, come indirizzi IP, tipo di browser, pagine visitate, tempi di accesso, ecc.,
                    che vengono raccolti automaticamente durante l'uso del sito web.</li>
            </ul>
            <p>Utilizziamo i dati raccolti per vari scopi, tra cui:</p>
            <ul>
                <li>Fornire e mantenere il nostro servizio, inclusa la gestione delle prenotazioni e l'assistenza
                    clienti.</li>
                <li>Personalizzare e migliorare l'esperienza degli utenti, compresa la presentazione di contenuti
                    personalizzati e offerte speciali.</li>
                <li>Elaborare transazioni finanziarie e prevenire frodi.</li>
                <li>Analizzare l'utilizzo del sito web e migliorare le sue funzionalità e prestazioni.</li>
            </ul>

            <p><strong>Condivisione dei Dati</strong></p>
            <p>Non vendiamo, affittiamo o scambiamo i dati personali degli utenti con terze parti al di fuori di
                VolaFacile.it, tranne che per fornire i nostri servizi e rispettare gli obblighi legali.</p>
            <p>Possiamo condividere i dati personali con terze parti fidate per i seguenti scopi:</p>
            <ul>
                <li>Con società di elaborazione dei pagamenti per elaborare transazioni finanziarie.</li>
                <li>Con fornitori di servizi che ci aiutano nella gestione del sito web o nel fornire servizi correlati.
                </li>
                <li>Con autorità governative o di regolamentazione per rispettare le leggi e i regolamenti applicabili.
                </li>
            </ul>

            <p><strong>Protezione dei Dati</strong></p>
            <p>Adottiamo misure di sicurezza adeguate per proteggere i dati personali degli utenti da accessi non
                autorizzati, modifiche, divulgazioni o distruzioni non autorizzate. Tuttavia, nessun metodo di
                trasmissione su Internet o metodo di archiviazione elettronica è completamente sicuro. Pertanto, non
                possiamo garantire la sicurezza assoluta dei dati.</p>

            <p><strong>Modifiche alla Privacy Policy</strong></p>
            <p>La presente politica sulla privacy è efficace a partire dalla data di entrata in vigore e rimarrà in
                vigore tranne in relazione a eventuali modifiche nei suoi termini che entreranno in vigore
                immediatamente dopo la pubblicazione su questa pagina.</p>
            <p>Ci riserviamo il diritto di aggiornare o modificare la nostra politica sulla privacy in qualsiasi momento
                e si consiglia di controllare periodicamente questa pagina per eventuali modifiche. L'uso continuato del
                sito web dopo la pubblicazione delle modifiche costituirà una conferma della vostra accettazione delle
                modifiche.</p>

            <p><strong>Contattaci</strong></p>
            <p>Se avete domande o dubbi sulla nostra politica sulla privacy, non esitate a contattarci.</p>
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