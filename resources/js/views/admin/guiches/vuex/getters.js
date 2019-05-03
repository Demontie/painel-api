export default {
    getGuiche(state){
        return state.guiche
    },
    getGuiches(state){
        return state.guiches
    },
    getGuichesDisponiveis(state){
        return state.guichesDisponiveis
    },
    getDialogGuiche(state){
        return state.dialogGuiche
    },
    getGuicheSelecionado(state){
        const guicheLocalStorage = localStorage.getItem('guicheSelecionado')
        return state.guicheSelecionado = guicheLocalStorage ? JSON.parse(guicheLocalStorage) : {}
    }
}