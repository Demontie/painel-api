export default {
    setUsuarioLogado(state, dadosUsuario) {
        state.usuarioLogado = dadosUsuario
        state.isLogado = true
    },
    changeUrlBack(state, urlBack){
        state.urlBack = urlBack
    }
}