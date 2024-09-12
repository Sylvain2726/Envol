import './bootstrap';
import 'bootstrap'
import 'flowbite'; // Importation de Flowbite
import 'animate.css'; // Importation d'animate.css
import Alpine from 'alpinejs';

// Importer Tom Select depuis node_modules
import TomSelect from 'tom-select';

document.addEventListener('DOMContentLoaded', function () {
    // Sélectionner tous les éléments select[multiple]
    const selectElements = document.querySelectorAll("select[multiple]");

    // Initialiser TomSelect sur chaque élément
    selectElements.forEach(function(select) {
        new TomSelect(select, {
            plugins: ['remove_button', 'clear_button'],
            maxItems: 30,
            searchField: ['text'],
        });
    });
});


Alpine.start(); // Démarrage d'Alpine.js






