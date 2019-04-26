const ADMIN = 1
const GUICHE = 2
const TELA = 3

const usuarioLogado = JSON.parse(localStorage.getItem('usuarioLogado'))

export default {
    ADMIN,
    GUICHE,
    TELA,
    /**
     * Retorna true ou false com base nas permissões definidas e as permissões do usuario
     * @param permissoes
     * @returns {boolean}
     */
    verificarPermissao(permissoes){
        let permissaoUsuario = Object.values(permissoes).find((valor,key) => {
            if(valor === usuarioLogado.perfil_id){
                return true
            }
        })

        return !!permissaoUsuario
    }
}