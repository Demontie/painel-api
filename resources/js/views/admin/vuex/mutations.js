export default {
    setUsuarioLogado(state) {
        state.usuarioLogado = JSON.parse(localStorage.getItem('usuarioLogado'))
        state.isLogado = true
    },
    changeUrlBack(state, urlBack){
        state.urlBack = urlBack
    }
}