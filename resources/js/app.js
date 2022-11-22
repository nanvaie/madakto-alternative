import { createApp } from 'vue';
import App from '../vue/App.vue';
import router from './router/index';

// Style
import '../scss/app.scss';

// Icons
import '@ui5/webcomponents-icons/dist/AllIcons';

createApp(App)
    .use(router)
    .mount('#app');
