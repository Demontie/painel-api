import Vue from 'vue'

export default [
    /*
    uppercase
     */
    Vue.filter('uppercase',function (valor) {
        return valor.toUpperCase()
    }),

    /*
    lowercase
     */
    Vue.filter('lowercase',function (valor) {
        return valor.toLowerCase()
    })
]