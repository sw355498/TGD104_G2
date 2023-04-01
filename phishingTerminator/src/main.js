import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
// 引入
import { library } from '@fortawesome/fontawesome-svg-core'
import { faFile as faFileRegular } from '@fortawesome/free-regular-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(faFileRegular)

// BootStrap5.2.3套件引入
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap'

// Sass檔案引入
import '@/assets/Sass/style.scss'


// 導入CKEditor
import CKEditor from '@ckeditor/ckeditor5-vue';

// 導入jsgrid
import $ from 'jquery'
import 'jsgrid/css/jsgrid.css';
import 'jsgrid/css/theme.css';
import 'jsgrid';


createApp(App).use(router).use( CKEditor ).component('font-awesome-icon', FontAwesomeIcon).mount('#app');
