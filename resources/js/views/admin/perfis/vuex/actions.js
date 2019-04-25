import axios from 'axios'

export default {
    setPerfil({commit},perfil){
        commit('setPerfil',perfil)
    },
    async loadPerfis({commit}){
        try{
            const request = await  axios.get('perfis')
            commit('setPerfis',request.data)
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    },
    async loadPerfil({commit},idPerfil){
        try{
            const request = await  axios.get(`perfis/${idPerfil}`)
            commit('setPerfil',request.data)
        }catch (e){
            throw new Error(e.response.data.error)
        }
    },
    async loadGrupoPerfis({ commit }){
        try{
            const request = await  axios.get(`grupoPerfis`)

            commit('setGrupoPerfis',request.data)
        }catch (e){
            throw new Error(e.response.data.error)
        }
    },
    async insertPerfil({ dispatch },perfil){
        try{
            const request = await  axios.post(`perfis`, perfil)

            dispatch('loadPerfis')

            return request
        }catch (e){
            console.log(e.response)
            throw new Error(e.response.data.error)
        }
    },
    async updatePerfil({ dispatch }, perfil){
        try{
            console.log(perfil)
            const request = await  axios.put(`perfis/${perfil.id}`, perfil)

            dispatch('loadPerfis')

            return request
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    },
    async deletePerfil({ dispatch },perfil){
        console.log(perfil)
        try{
            console.log(perfil)
            const request = await  axios.delete(`perfis/${perfil.id}`)

            dispatch('loadPerfis')

            return request
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    }
}