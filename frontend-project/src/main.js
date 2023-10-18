import { createApp } from 'vue'
import App from './App.vue'
// router
import router from './router'
import PrimeVue from 'primevue/config';
// css
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import './assets/main/style.css'
const app = createApp(App);
app.use(PrimeVue);
app.use(router)
app.mount('#app')

