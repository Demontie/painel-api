import Vue from 'vue'
import Vuex from 'vuex'
import adminStore from './views/admin/vuex/store'
import storeCompartilhado from './components/vuex/store'
import tipoSenhasStore from './views/admin/tipoSenhas/vuex/store'
import senhasStore from './views/admin/senhas/vuex/store'
import salasStore from './views/admin/salas/vuex/store'
import telasStore from './views/admin/telas/vuex/store'
import grupoTelasStore from './views/admin/grupoTelas/vuex/store'
import perfisStore from './views/admin/perfis/vuex/store'
import painelWebStore from './views/painel/vuex/store'

Vue.use(Vuex)

export default new Vuex.Store({
  modules:{
      adminStore,
      storeCompartilhado,
      tipoSenhasStore,
      salasStore,
      telasStore,
      grupoTelasStore,
      senhasStore,
      painelWebStore,
      perfisStore
  }
})
