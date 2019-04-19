import axios from "axios";

export default {
    async fazerLogin({ commit }, dadosLogin){
        try{
            const request = await axios({
                method: 'post',
                url: 'http://painel-api/api/autenticar',
                data: dadosLogin})

            localStorage.setItem('token', request.data.token)

            commit('setUsuarioLogado',request.data)

            return request.data
        }catch (e) {
            throw new Error(e.response.data.error)
        }
    },
    async checkLogin({ commit }, dadosLogin){
        const token = localStorage.getItem('token')

        if(!token){
            return false
        }else {

        }
    }
}