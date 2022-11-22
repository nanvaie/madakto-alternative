import { createApp } from 'vue';
import App from '../vue/App.vue';
import router from './router/index';

// Style
import '../scss/app.scss';

createApp(App)
    .use(router)
    .mount('#app');
