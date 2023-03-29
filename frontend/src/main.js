// vue相關檔案引入
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

// BootStrap5.2.3套件引入
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap'


// Sass檔案引入
import '@/assets/Sass/style.scss'

// fontawesome套件引入
import '@fortawesome/fontawesome-free/css/all.css'


// js-grid套件引入
import 'jsgrid/dist/jsgrid.min.css';
import 'jsgrid/dist/jsgrid.min.js';

// CKEditor套件引入
import CKEditor from '@ckeditor/ckeditor5-vue';


//引入assets/img/
const requireAll = requireContext => requireContext.keys().map(requireContext)
const req = require.context("@/assets/icon/", true, /\.svg$/)
requireAll(req)

createApp(App).use(router).use( CKEditor ).mount('#app');