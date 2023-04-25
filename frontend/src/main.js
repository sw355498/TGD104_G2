// vue相關檔案引入
import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

router.afterEach((to, from, next) => {
  window.scrollTo({ top: 0, behavior: 'instant' });
});

// BootStrap5.2.3套件引入
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap";

// Sass檔案引入
import "@/assets/Sass/style.scss";

// fontawesome套件引入
import "@fortawesome/fontawesome-free/css/all.css";

// sweetalert2套件引入(composition api 建議用 sweetalert2 不要用vue-sweetalert2)
import 'sweetalert2/dist/sweetalert2.min.css';

// js-grid套件引入
import $ from "jquery";
import "jsgrid/dist/jsgrid.min.css";
import "jsgrid/dist/jsgrid.min.js";

// CKEditor套件引入
import CKEditor from "@ckeditor/ckeditor5-vue";

//引入assets/img/
const requireAll = (requireContext) =>
  requireContext.keys().map(requireContext);
const req = require.context("@/assets/icon/", true, /\.svg$/);
requireAll(req);

//axios
import * as Vue from "vue"; // in Vue 3
import axios from "axios";
import VueAxios from "vue-axios";

// Typed js
import VueTypedJs from "vue-typed-js";
//Typeit
import TypeIt from "typeit";

createApp(App)
  .use(router)
  .use(CKEditor)
  .use(VueAxios, axios)
  .use(VueTypedJs)
  .mount("#app");
