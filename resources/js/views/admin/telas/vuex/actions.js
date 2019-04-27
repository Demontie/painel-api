import axios from 'axios'

export default {
    setTela({commit},tela){
        commit('setTela',tela)
    },
    async loadTelas({commit}){
        try{
            const request = await  axios.get('telas')
            commit('setTelas',request.data)
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    },
    async loadTela({commit},idTela){
        try{
            const request = await  axios.get(`telas/${idTela}`)
            commit('setTela',request.data)
        }catch (e){
            throw new Error(e.response.data.error)
        }
    },
    async insertTela({ dispatch },tela){
        try{
            const request = await  axios.post(`telas`, tela)

            dispatch('loadTelas')

            return request
        }catch (e){
            console.log(e.response)
            throw new Error(e.response.data.error)
        }
    },
    async updateTela({ dispatch }, tela){
        try{
            console.log(tela)
            const request = await  axios.put(`telas/${tela.id}`, tela)

            dispatch('loadTelas')

            return request
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    }
}