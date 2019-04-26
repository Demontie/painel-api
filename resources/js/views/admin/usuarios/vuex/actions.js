import axios from 'axios'

export default {
    setUsuario({commit},usuario){
        commit('setUsuario',usuario)
    },
    async loadUsuarios({commit}){
        try{
            const request = await  axios.get('users')
            commit('setUsuarios',request.data)
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    },
    async loadUsuario({commit},idUsuario){
        try{
            const request = await  axios.get(`users/${idUsuario}`)
            commit('setUsuario',request.data)
        }catch (e){
            throw new Error(e.response.data.error)
        }
    },
    async insertUsuario({ dispatch },usuario){
        try{
            const request = await  axios.post(`users`, usuario)

            dispatch('loadUsuarios')

            return request
        }catch (e){
            console.log(e.response)
            throw new Error(e.response.data.error)
        }
    },
    async updateUsuario({ dispatch }, usuario){
        try{
            console.log(usuario)
            const request = await  axios.put(`users/${usuario.id}`, usuario)

            dispatch('loadUsuarios')

            return request
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    },
    async deleteUsuario({ dispatch },usuario){
        console.log(usuario)
        try{
            console.log(usuario)
            const request = await  axios.delete(`users/${usuario.id}`)

            dispatch('loadUsuarios')

            return request
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    }
}