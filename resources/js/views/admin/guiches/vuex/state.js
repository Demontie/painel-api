export default {
    guiche:{},
    guicheSelecionado: () => localStorage.getItem('guicheSelecionado') ? JSON.parse(localStorage.getItem('guicheSelecionado')) : {},
    guiches:[],
    guichesDisponiveis: [],
    dialogGuiche: false
}