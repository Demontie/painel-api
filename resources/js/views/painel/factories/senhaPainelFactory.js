export default {
    fabricarChamadaAtual(senhaChamada){
        return `Senha: ${senhaChamada.tipo_senha.prefixo}  ${senhaChamada.numero}, ${senhaChamada.guiche.descricao}`
    },
    // fabricarTextoParaChamarSenha(senhaChamada){
    //     return `Senha: ${senhaChamada.prefix} - ${senhaChamada.numero}, Guichê: ${senhaChamada.guiche.descricao}`
    //},
    fabricarSenhasPainel(senhasApi){
        return senhasApi.map(senhaApi => {
            senhaApi.senhaCompleta = `${senhaApi.tipo_senha.prefixo} - ${senhaApi.numero}`
            return senhaApi
        })
    }
}