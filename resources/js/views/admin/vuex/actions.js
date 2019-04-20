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

            commit('setUsuarioLogado',request.data)

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
            commit('setUsuarioLogado',request.data)
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
    }
}