(function ($) {
    "use strict";

    // En-tête : ombre au défilement
    $(window).on('scroll', function () {
        $('.site-header').toggleClass('is-scrolled', $(this).scrollTop() > 10);
    });


    //GRISER LE CHAMP AUTRE UNIVERSITE 

    // Attendez que le document soit prêt
    document.addEventListener("DOMContentLoaded", function() {
        var universiteField = document.querySelector("#hebergement_universite");
        var autreUniversiteField = document.querySelector(".autre-universite");
        if (!universiteField || !autreUniversiteField) { return; }
    
        function toggleAutreUniversiteField() {
            if (universiteField.value === "autre") {
                autreUniversiteField.style.display = "block";
                autreUniversiteField.removeAttribute('disabled'); // Remove disabled attribute
            } else {
                autreUniversiteField.style.display = "none";
                autreUniversiteField.setAttribute('disabled', 'disabled'); // Add disabled attribute
            }
        }
    
        toggleAutreUniversiteField();
    
        universiteField.addEventListener("change", toggleAutreUniversiteField);
    });
    document.addEventListener("DOMContentLoaded", function() {
        var form = document.querySelector('form');
        var message = document.getElementById('message');
        if (!form || !message) { return; }
    
        form.addEventListener('submit', function(event) {
            // Afficher le message
            message.style.display = 'block';
    
            // Masquer le message après 5 secondes (5000 millisecondes)
            setTimeout(function() {
                message.style.display = 'none';
            }, 60000);
        });
    });
        
    

})(jQuery);

