import axios from 'axios';

// Set Axios globally
window.axios = axios;

// Ensure XHR requests are recognized by Laravel
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Include authentication credentials for Sanctum
window.axios.defaults.withCredentials = true;
