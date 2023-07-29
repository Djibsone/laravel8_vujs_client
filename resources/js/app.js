import './bootstrap';

import Alpine from 'alpinejs';

import { createApp } from 'vue';
import router from './router';

import CustomerIndex from './components/CustomerIndex';


createApp({
    components: {
        CustomerIndex
    }
})
.use(router)
.mount('#app');

window.Alpine = Alpine;

Alpine.start();
