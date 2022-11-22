import { createApp } from 'vue';
import { setLanguage } from '@ui5/webcomponents-base/dist/config/Language';
import App from '../vue/App.vue';
import router from './router/index';

// Style
import '../scss/app.scss';

// Icons
import '@ui5/webcomponents-icons/dist/AllIcons';

setLanguage('fa');

createApp(App)
    .use(router)
    .mount('#app');
