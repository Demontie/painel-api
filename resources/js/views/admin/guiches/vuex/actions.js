import axios from 'axios'

export default {
    setGuiche({commit},guiche){
        commit('setGuiche',guiche)
    },
    async loadGuiches({commit}){
        try{
            const request = await  axios.get('guiches')
            commit('setGuiches',request.data)
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    },
    async loadGuiche({commit},idGuiche){
        try{
            const request = await  axios.get(`guiches/${idGuiche}`)
            commit('setGuiche',request.data)
        }catch (e){
            throw new Error(e.response.data.error)
        }
    },
    async loadGrupoGuiches({ commit }){
        try{
            const request = await  axios.get(`grupoGuiches`)

            commit('setGrupoGuiches',request.data)
        }catch (e){
            throw new Error(e.response.data.error)
        }
    },
    async insertGuiche({ dispatch },guiche){
        try{
            const request = await  axios.post(`guiches`, guiche)

            dispatch('loadGuiches')

            return request
        }catch (e){
            console.log(e.response)
            throw new Error(e.response.data.error)
        }
    },
    async updateGuiche({ dispatch }, guiche){
        try{
            console.log(guiche)
            const request = await  axios.put(`guiches/${guiche.id}`, guiche)

            dispatch('loadGuiches')

            return request
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    },
    async deleteGuiche({ dispatch },guiche){
        console.log(guiche)
        try{
            console.log(guiche)
            const request = await  axios.delete(`guiches/${guiche.id}`)

            dispatch('loadGuiches')

            return request
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    }
}