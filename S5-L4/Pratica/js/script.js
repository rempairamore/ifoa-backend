document.getElementById('autoSizingSelect').addEventListener('change', function () {
    var selection = this.value;
    var authorInput = document.getElementById('authorInput');
    var directorInput = document.getElementById('directorInput');
    
    // Nasconde entrambi i campi
    authorInput.classList.add('d-none');
    directorInput.classList.add('d-none');

    // Mostra il campo Autore se il valore selezionato è 1 (Libro)
    if (selection === '1') {
        authorInput.classList.remove('d-none');
    }
    // Mostra il campo Regista se il valore selezionato è 2 (DVD)
    else if (selection === '2') {
        directorInput.classList.remove('d-none');
    }
});