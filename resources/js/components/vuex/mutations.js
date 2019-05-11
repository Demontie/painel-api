export default {
    setMensagem(state, mensagem){
        state.mensagem = mensagem
    },
    setDialogIpConfig(state, dialogIpConfig){
        state.dialogIpConfig = dialogIpConfig
    },
    setIpServidor(state, ipServidor){
        state.ipServidor = ipServidor
        localStorage.setItem('ipServidor',ipServidor)
    },
}