import axios from 'axios'

export default {
    setPaciente({commit},paciente){
        commit('setPaciente',paciente)
    },
    setDialogPaciente({commit}, dialogPaciente){
        commit('setDialogPaciente',dialogPaciente)
    },
    async loadPacientes({commit}){
        try{
            const request = await  axios.get('pacientes')
            commit('setPacientes',request.data)
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    },
    async loadPaciente({commit},idPaciente){
        try{
            const request = await  axios.get(`pacientes/${idPaciente}`)
            commit('setPaciente',request.data)
        }catch (e){
            throw new Error(e.response.data.error)
        }
    },
    async loadGrupoPacientes({ commit }){
        try{
            const request = await  axios.get(`grupoPacientes`)

            commit('setGrupoPacientes',request.data)
        }catch (e){
            throw new Error(e.response.data.error)
        }
    },
    async insertPaciente({ dispatch },paciente){
        try{
            const request = await  axios.post(`pacientes`, paciente)

            dispatch('loadPacientes')

            return request.data
        }catch (e){
            console.log(e.response)
            throw new Error(e.response.data.error)
        }
    },
    async updatePaciente({ dispatch }, paciente){
        try{
            console.log(paciente)
            const request = await  axios.put(`pacientes/${paciente.id}`, paciente)

            dispatch('loadPacientes')

            return request
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    },
    async deletePaciente({ dispatch },paciente){
        console.log(paciente)
        try{
            console.log(paciente)
            const request = await  axios.delete(`pacientes/${paciente.id}`)

            dispatch('loadPacientes')

            return request
        }catch (e){
            console.log(e)
            throw new Error(e.response.data.error)
        }
    }
}
