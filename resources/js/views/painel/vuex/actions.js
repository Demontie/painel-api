export default {
    setChamadaAtual({commit}, chamadaAtual){
        commit('setChamadaAtual', chamadaAtual)
    },
    setSenhasChamadas({commit}, senhasChamadas){
        commit('setSenhasChamadas', senhasChamadas)
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