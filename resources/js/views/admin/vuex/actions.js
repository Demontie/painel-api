import axios from "axios";
import utils from './../../../utils'

const BASE_URL = utils.URL_BASE + 'api/'

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
                contentType: 'application/json',
                url: BASE_URL + 'autenticar',
                data: dadosLogin}
                )

            localStorage.setItem('token', request.data.token)

            localStorage.setItem('usuarioLogado', JSON.stringify(request.data.user))

            window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + request.data.token;

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
            //console.log(token)
            const usuarioLogado = JSON.parse(localStorage.getItem('usuarioLogado'))
            console.log(usuarioLogado.name)

            const request = await axios({
                method: 'get',
                contentType: 'application/jsonp',
                url: BASE_URL + 'getUsuarioAutenticado',
                'X-Requested-With': 'XMLHttpRequest'
            })

            if(!token){
                return false
            }else {
                //localStorage.setItem('usuarioLogado', JSON.stringify(request.data.user))

                // commit('setUsuarioLogado')
                // return true
                commit('setUsuarioLogado',request.data.user)
                return true
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
    sair({commit}){
        commit('sair')
    }
}