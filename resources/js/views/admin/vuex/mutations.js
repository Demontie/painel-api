export default {
    setUsuarioLogado(state, usuarioLogado) {
        // console.log(JSON.parse(localStorage.getItem('usuarioLogado')))
        // state.usuarioLogado = JSON.parse(localStorage.getItem('usuarioLogado'))
        state.usuarioLogado = usuarioLogado
        state.isLogado = true
    },
    changeUrlBack(state, urlBack){
        state.urlBack = urlBack
    },
    sair(state){
        localStorage.removeItem('token')
        localStorage.removeItem('usuarioLogado')
        delete window.axios.defaults.headers.common['Authorization']
        state.usuarioLogado = {}
        state.isLogado = false
    }
}