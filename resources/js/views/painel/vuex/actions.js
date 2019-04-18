export default {
    setChamadaAtual({commit}, chamadaAtual){
        commit('setChamadaAtual', chamadaAtual)
    },
    setUltimaSenhaChamada({commit}, ultimaSenhaChamada){
        commit('setUltimaSenhaChamada',ultimaSenhaChamada)
    },
    setSenhasChamadas({commit}, senhasChamadas){
        commit('setSenhasChamadas', senhasChamadas)
    },
    // atualizarListaSenhasChamadas({state}) {
    //     let ultimoElementoArray = state.senhasChamadas.length - 1
    //
    //     state.senhasChamadas.splice(ultimoElementoArray,1)
    //     state.senhasChamadas.unshift(senha)
    // }
    // ,
    async loadSenhasChamadas(){
        try{
            const request = await axios.get('senhas/senhasChamadas')

            return request.data
        }catch (e){

        }
    },
    async loadUltimaSenha(){
        try{
            const request = await axios.get('senhas/senhasChamadas')

            return request.data
        }catch (e){

        }
    }
}