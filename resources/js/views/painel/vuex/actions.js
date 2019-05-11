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
    setSenhaInSenhasChamadas({commit}, ultimaSenhaChamada){
        commit('setSenhaInSenhasChamadas', ultimaSenhaChamada)
    },
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