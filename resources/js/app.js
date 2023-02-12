import { createApp } from 'vue';
import { setLanguage } from '@ui5/webcomponents-base/dist/config/Language';
import { setTheme } from '@ui5/webcomponents-base/dist/config/Theme';
import App from '../vue/App.vue';
import router from './router/index';

// Assets
import '@ui5/webcomponents/dist/Assets';
import '@ui5/webcomponents-fiori/dist/Assets';

// Style
import 'fundamental-styles/dist/fundamental-styles.css';

// Icons
import '@ui5/webcomponents-icons/dist/AllIcons';

setLanguage('fa');

createApp(App)
    .use(router)
    .mount('#app');
