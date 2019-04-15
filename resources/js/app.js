require('./bootstrap');

window.Vue = require('vue');

/*
Configuração axios
 */
import axios from 'axios'
axios.defaults.baseURL = 'http://192.168.15.4/painel-api/api/painel/'

import router from './routes/router'
import store from './store'
import Vuetify from 'vuetify'
//import VuetifyConfirm from 'vuetify-confirm'

Vue.use(Vuetify)

// Vue.use(VuetifyConfirm,{
//     buttonTrueText: 'Ok',
//     buttonFalseText: 'Cancelar',
//     width: 350,
//     property: '$confirm'
// })

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    router,
    store,
    el: '#app'
});
