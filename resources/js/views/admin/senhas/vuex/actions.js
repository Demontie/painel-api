import axios from 'axios'

export default {
    setSenha({commit},senha){
        commit('setSenha')
    },
    async loadSenhas({commit}){
        try{
            const request = await axios.get('senhas')

            commit('setSenhas',request.data)
        }catch (e){
            throw new Error(e.response.data.error)
        }

    },
    async loadSenha({commit},idSenha){
        try{
            const request = await axios.get(`senhas/${idSenha}`)

            commit('setSenha',request.data)
        }catch (e){
            throw new Error(e.response.data.error)
        }
    }
}