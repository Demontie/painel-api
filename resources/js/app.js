require('./bootstrap');

window.Vue = require('vue');

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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    store,
    el: '#app'
});
