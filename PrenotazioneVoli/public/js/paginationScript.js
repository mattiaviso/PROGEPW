$(document).ready(function () {
    // Pagination feature
    var currentPage = 1;
    var rowsPerPage = 10; // Numero di righe per pagina
    var $flightCards = $(".flight-card");
    var totalPages = Math.ceil($flightCards.length / rowsPerPage);

    function showPage(page) {
        var start = (page - 1) * rowsPerPage;
        var end = start + rowsPerPage;

        $flightCards.hide().slice(start, end).show();

        // Rimuovi i numeri di pagina esistenti
        $(".page-item.pageNumber").remove();

        // Calcola quali numeri di pagina visualizzare
        var startPage = Math.max(1, currentPage - 1);
        var endPage = Math.min(startPage + 2, totalPages);

        // Aggiungere i numeri di pagina calcolati al markup HTML
        for (var i = startPage; i <= endPage; i++) {
            var $li = $("<li>", { class: "page-item pageNumber" });
            var $link = $("<a>", { class: "page-link", href: "#", text: i });
            if (i === currentPage) {
                $li.addClass("active");
            }
            $li.append($link);
            $li.insertBefore("#nextPage");
        }

        // Abilita/disabilita pulsanti Previous e Next
        $("#previousPage").toggleClass("disabled", currentPage === 1);
        $("#nextPage").toggleClass("disabled", currentPage === totalPages);
    }

    function goToPreviousPage() {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    }

    function goToNextPage() {
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    }

    // Aggiorna il numero di righe per pagina quando viene selezionato un nuovo valore
    $("#rowsPerPage").on("change", function () {
        rowsPerPage = parseInt($(this).val());
        totalPages = Math.ceil($flightCards.length / rowsPerPage);
        currentPage = 1; // Reset currentPage to 1 when rowsPerPage changes
        showPage(currentPage);
    });

    showPage(currentPage);

    $("#previousPage").on("click", goToPreviousPage);
    $("#nextPage").on("click", goToNextPage);

    $(document).on("click", ".pageNumber", function () {
        var page = parseInt($(this).text());
        currentPage = page;
        showPage(currentPage);
    });
});
