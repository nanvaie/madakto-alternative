import {createApp} from "vue";

import App from "../vue/App.vue";

// Plugins
import router from "./router/index"
import i18n from './plugins/vue-i18n'


// Assets
import "@ui5/webcomponents/dist/Assets";
import "@ui5/webcomponents-fiori/dist/Assets";
import "@ui5/webcomponents/dist/MenuItem.js";
import "@ui5/webcomponents/dist/Menu.js";

import 'fundamental-styles/dist/fundamental-styles.css';
import 'fundamental-styles/dist/theming/sap_horizon.css';
import 'fundamental-styles/dist/icon.css';
import 'fundamental-styles/dist/table.css';


// Style
import "../scss/app.scss";
import "fundamental-styles/dist/helpers.css";
import "fundamental-styles/dist/margins.css";

// Icons
import "@ui5/webcomponents-icons/dist/AllIcons";


import 'bootstrap/dist/js/bootstrap.min';


createApp(App)
    .use(router)
    .use(i18n)
    .mount("#app");
