import axios from 'axios'

export default {
    setTipoSenha({commit},tipoSenha){
        commit('setTipoSenha',tipoSenha)
    },
    async loadTipoSenhas({commit}){
        try{
            const request = await  axios.get('tipoSenhas')
            commit('setTipoSenhas',request.data)
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    },
    async loadTipoSenha({commit},idTipoSenha){
        try{
            const request = await  axios.get(`tipoSenhas/${idTipoSenha}`)
            commit('setTipoSenha',request.data)
        }catch (e){
            throw new Error(e.response.data.error)
        }
    },
    async insertTipoSenha({ dispatch },tipoSenha){
        try{
            const request = await  axios.post(`tipoSenhas`, tipoSenha)

            dispatch('loadTipoSenhas')

            return request
        }catch (e){
            console.log(e.response)
            throw new Error(e.response.data.error)
        }
    },
    async updateTipoSenha({ dispatch }, tipoSenha){
        try{
            console.log(tipoSenha)
            const request = await  axios.put(`tipoSenhas/${tipoSenha.id}`, tipoSenha)

            dispatch('loadTipoSenhas')

            return request
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    }
}