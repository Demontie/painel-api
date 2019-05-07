export default {
    setChamadaAtual(state, chamadaAtual){
        state.chamadaAtual = chamadaAtual
    },
    setUltimaSenhaChamada(state, ultimaSenhaChamada){
        state.ultimaSenhaChamada = ultimaSenhaChamada
    },
    setSenhasChamadas(state, senhasChamadas){
        state.senhasChamadas = senhasChamadas
    },
    setSenhaInSenhasChamadas(state, ultimaSenhaChamada){
        state.senhasChamadas.push(ultimaSenhaChamada)
    }
}