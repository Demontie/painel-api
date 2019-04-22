import axios from 'axios'

export default {
    setSala({commit},sala){
        commit('setSala',sala)
    },
    async loadSalas({commit}){
        try{
            const request = await  axios.get('salas')
            commit('setSalas',request.data)
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    },
    async loadSala({commit},idSala){
        try{
            const request = await  axios.get(`salas/${idSala}`)
            commit('setSala',request.data)
        }catch (e){
            throw new Error(e.response.data.error)
        }
    },
    async insertSala({ dispatch },sala){
        try{
            const request = await  axios.post(`salas`, sala)

            dispatch('loadSalas')

            return request
        }catch (e){
            console.log(e.response)
            throw new Error(e.response.data.error)
        }
    },
    async updateSala({ dispatch }, sala){
        try{
            console.log(sala)
            const request = await  axios.put(`salas/${sala.id}`, sala)

            dispatch('loadSalas')

            return request
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    }
}