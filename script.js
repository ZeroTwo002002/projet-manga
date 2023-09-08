// Attend que le document HTML soit entièrement chargé avant d'exécuter le code
$(document).ready(function () {
    // Sélectionne tous les éléments avec la classe CSS "voir-plus-btn" et ajoute un gestionnaire d'événement de clic
    $('.voir-plus-btn').click(function () {
        // Récupère la valeur de l'attribut "data-target" de l'élément cliqué, qui doit être l'ID de la modale à afficher
        var targetModal = $(this).attr('data-target');
        
        // Sélectionne l'élément de la modale en utilisant son ID et utilise la méthode .modal('show') pour l'afficher
        $(targetModal).modal('show');
    });
});

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    function displaySelectedFileName() {
        const input = document.getElementById('Images');
        const imageLabel = document.getElementById('imageLabel');
    
        if (input.files.length > 0) {
            imageLabel.textContent = input.files[0].name;
        } else {
            imageLabel.textContent = 'Choisir une image';
        }
    }


    