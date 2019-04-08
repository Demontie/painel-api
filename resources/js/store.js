import Vue from 'vue'
import Vuex from 'vuex'
import storeCompartilhado from './components/vuex/store'
import tipoSenhasStore from './views/admin/tipoSenhas/vuex/store'
import salasStore from './views/admin/salas/vuex/store'
import telasStore from './views/admin/telas/vuex/store'
import grupoTelasStore from './views/admin/grupoTelas/vuex/store'

Vue.use(Vuex)

export default new Vuex.Store({
  modules:{
      storeCompartilhado,
      tipoSenhasStore,
      salasStore,
      telasStore,
      grupoTelasStore,
  }
})
