import axios from 'axios'

export default {
    setGrupoTela({ commit }, grupoTela){
        commit('setGrupoTela', grupoTela)
    },
    async loadGrupoTelas({commit}){
        try{
            const request = await axios.get('grupoTelas')

            commit('setGrupoTelas',request.data)
        }catch (e){
            throw new Error(e.response.data.error)
        }

    },
    async loadGrupoTela({commit},idGrupoTela){
        try{
            const request = await axios.get(`grupoTelas/${idGrupoTela}`)

            commit('setGrupoTela',request.data)
        }catch (e){
            throw new Error(e.response.data.error)
        }
    },
    async insertGrupoTela({ dispatch },grupoTela){
        try{
            const request = await  axios.post(`grupoTelas`, grupoTela)

            dispatch('loadGrupoTelas')

            return request
        }catch (e){
            console.log(e.response)
            throw new Error(e.response.data.error)
        }
    },
    async updateGrupoTela({ dispatch }, grupoTela){
        try{
            console.log(grupoTela)
            const request = await  axios.put(`grupoTelas/${grupoTela.id}`, grupoTela)

            dispatch('loadGrupoTelas')

            return request
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    },
    async deleteGrupoTela({ dispatch }, grupoTela){
        const request = await  axios.delete(`grupoTelas/${grupoTela.id}`, grupoTela)

        dispatch('loadGrupoTelas')

        return request
    }
}