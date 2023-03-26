// vue相關檔案引入
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

// Sass檔案引入
import '@/assets/Sass/style.scss'

// fontawesome套件引入
import '@fortawesome/fontawesome-free/css/all.css'

// BootStrap5.2.3套件引入
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap'

// js-grid套件引入
import 'jsgrid/dist/jsgrid.min.css';
import 'jsgrid/dist/jsgrid.min.js';
createApp(App).use(router).mount('#app');