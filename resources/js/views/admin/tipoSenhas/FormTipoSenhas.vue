<template>
    <v-card>
        <v-card-title>
            <span class="headline">{{ tituloForm }}</span>
        </v-card-title>
        <v-card-text>
            <Loader :load="load" />
            <v-container grid-list-md>
                <v-layout wrap>
                    <v-flex xs12 sm4>
                        <v-text-field
                                :autofocus="true"
                                v-model="tipoSenha.descricao"
                                label="Descrição"/>
                    </v-flex>
                    <v-flex xs12 sm2>
                        <v-text-field
                                title="Prefixo que virá antes do número"
                                v-model="tipoSenha.prefixo"
                                label="Prefixo"/>
                    </v-flex>
                    <v-flex xs12 sm2>
                        <v-text-field
                                title="Ordenação do botão no tablet"
                                v-model.number="tipoSenha.ordem"
                                type="number"
                                label="Ordem"/>
                    </v-flex>
                    <v-flex xs12 sm2>
                        <v-switch
                                v-model="tipoSenha.ativo"
                                color="primary"
                                :label="labelAtivo"
                        ></v-switch>
                    </v-flex>
                    <v-flex xs12 sm4>
                        <v-select
                                v-model="tipoSenha.grupo_tela_id"
                                :items="grupoTelas"
                                menu-props="auto"
                                label="Grupo de telas"
                                item-text="descricao"
                                item-value="id"
                                hide-details
                        ></v-select>
                    </v-flex>
                    <v-flex xs12 sm3>
                        <v-select
                                v-model="tipoSenha.tamanho_botao"
                                :items="tamanhoBotoes"
                                menu-props="auto"
                                label="Tamanho botões"
                                item-text="texto"
                                item-value="id"
                                hide-details
                        ></v-select>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-card-text>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary darken-1" @click="salvar">Salvar</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
    import Loader from './../../../components/admin/views/Loader'
    import { mapGetters,mapActions } from 'vuex'

    export default {
        components:{
            Loader
        },
        props:[],
        data(){
            return{
                idTipoSenha: this.$route.params.idTipoSenha,
                load:false,
                grupoTela: {},
                tamanhoBotao:{},
                tamanhoBotoes:[
                    {
                        id:3,
                        texto:'Pequeno'
                    },
                    {
                        id:6,
                        texto:'Médio'
                    },
                    {
                        id:12,
                        texto:'Grande'
                    },
                ]
            }
        },
        computed:{
            ...mapGetters({
                //tipoSenha: 'getTipoSenha',
                tipoSenhas: 'getTipoSenhas',
                grupoTelas: 'getGrupoTelas'
            }),
            tipoSenha: {
                get(){
                    return this.$store.getters.getTipoSenha
                },
                set(valor){
                    this.$store.dispatch('setTipoSenha',valor)
                }
            },
            tituloForm(){
                return this.idTipoSenha ? 'Editar tipo de senha' : 'Novo tipo de senha'
            },
            labelAtivo(){
                return this.tipoSenha.ativo ? 'Ativo' : 'Inativo'
            }
        },
        methods:{
            loadGrupoTela(){
                if(this.idTipoSenha){
                    const grupoTelaFiltrado = this.grupoTelas.find(grupoTela => {
                        if(grupoTela.id === this.tipoSenha.grupo_tela_id){
                            return grupoTela
                        }
                    })

                    return this.grupoTela = grupoTelaFiltrado
                }
            },
            loadTamanhoBotao(){
                if(this.idTipoSenha){
                    const tamanhoBotaoFiltrado = this.tamanhoBotoes.find(tamanhoBotao => {
                        if(tamanhoBotao.id === this.tipoSenha.tamanho_botao){
                            return tamanhoBotao
                        }
                    })

                    return this.tamanhoBotao = tamanhoBotaoFiltrado
                }
            },
            async salvar(){
                console.log(this.tipoSenha )
                if(this.idTipoSenha){
                    try{
                        await this.$store.dispatch('updateTipoSenha',this.tipoSenha )
                        this.$router.push({name:'admin.tipo-senhas'})
                    }catch (e){

                    }
                }else{
                    try{
                        await this.$store.dispatch('insertTipoSenha', this.tipoSenha)
                        this.$router.push({name:'admin.tipo-senhas'})
                    }catch (e){

                    }

                }

            }
        },
        created(){
            this.$store.dispatch('loadGrupoTelas')

            if(!this.tipoSenha.id && this.idTipoSenha){
                this.$store.dispatch('loadTipoSenha',this.idTipoSenha)
            }

            if(this.tipoSenhas.length <= 0){
                this.$store.dispatch('loadTipoSenhas')
            }

            this.loadTamanhoBotao()
            this.loadGrupoTela()
        }
    }
</script>

<style scoped>

</style>