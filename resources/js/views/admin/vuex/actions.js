import axios from "axios";

const BASE_URL = 'http://painel-api/api/'

export default {
    /**
     * Realiza o login para a aplicação
     * @param commit
     * @param dadosLogin
     * @returns {Promise<*>}
     */
    async fazerLogin({ commit }, dadosLogin){
        try{
            const request = await axios({
                method: 'post',
                url: BASE_URL + 'autenticar',
                data: dadosLogin}
                )

            localStorage.setItem('token', request.data.token)

            localStorage.setItem('usuarioLogado', JSON.stringify(request.data.user))

            commit('setUsuarioLogado')

            return request.data
        }catch (e) {
            throw new Error(e.response.data.error)
        }
    },
    /**
     * Realiza a verificação e validação do token e login junto a API
     * @param commit
     * @returns {Promise<boolean>}
     */
    async checkLogin({ commit }){
        try{
            const token = localStorage.getItem('token')

            const request = await axios({
                method: 'get',
                url: BASE_URL + 'getUsuarioAutenticado',
                data: {

                }
            })

            if(!token){
                return false
            }else {
                localStorage.setItem('usuarioLogado', JSON.stringify(request.data.user))

                commit('setUsuarioLogado')
                return true
                //commit('setUsuarioLogado',request.data)
            }
        }catch (e) {
            throw new Error(e.message)
        }
    },
    /**
     * Armazena url acessada anteriormente
     * @param commit
     * @param urlBack
     * @returns {Promise<void>}
     */
    async changeUrlBack({commit}, urlBack) {
        commit('changeUrlBack',urlBack)
    },
    sair(){

    }
}