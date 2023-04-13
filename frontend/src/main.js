// vue相關檔案引入
import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

router.afterEach((to, from, next) => {
  window.scrollTo(0, 0);
});

// BootStrap5.2.3套件引入
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap";

// Sass檔案引入
import "@/assets/Sass/style.scss";

// fontawesome套件引入
import "@fortawesome/fontawesome-free/css/all.css";

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

const app = createApp(App);

app.config.globalProperties.$apiUrl =
  process.env.VUE_APP_API_URL || "http://localhost/frontend/src/api/";

app.use(router).use(CKEditor).use(VueAxios, axios).mount("#app");
