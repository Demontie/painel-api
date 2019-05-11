export default {
    setMensagem({ commit }, mensagem){
        commit('setMensagem', mensagem)
    },
    setDialogIpConfig({ commit }, dialogIpConfig){
        commit('setDialogIpConfig', dialogIpConfig)
    },
    setIpServidor({ commit }, ipServidor){
        commit('setIpServidor', ipServidor)
    },
}