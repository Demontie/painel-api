require('./bootstrap');

window.Vue = require('vue');

import './filters'
import utils from './utils'

/*
Configuração axios
 */
import axios from 'axios'
axios.defaults.baseURL = utils.URL_BASE + 'api/painel/'

import router from './routes/router'
import store from './store'
import './vuelidate'
import Vuetify from 'vuetify'
import VuetifyConfirm from 'vuetify-confirm'

Vue.use(Vuetify)

Vue.use(VuetifyConfirm,{
    buttonTrueText: 'Ok',
    buttonFalseText: 'Cancelar',
    width: 350,
    property: '$confirm'
})

const app = new Vue({
    router,
    store,
    el: '#app',
    beforeRouteEnter(){
        console.log(123)
    }
});

