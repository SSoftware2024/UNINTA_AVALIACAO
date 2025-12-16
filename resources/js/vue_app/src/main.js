import { createApp } from "vue";
import { createPinia } from "pinia";
import router from './router/router.js';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import "./style.css";
import App from "./App.vue";

const pinia = createPinia();

const app = createApp(App);
app.use(pinia)
.use(router)
.mount("#app");
