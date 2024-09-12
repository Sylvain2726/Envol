import axios from 'axios'; // Importation d'axios


// Configuration axios pour les requêtes HTTP
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



