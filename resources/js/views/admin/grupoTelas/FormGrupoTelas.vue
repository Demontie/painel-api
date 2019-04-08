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
                                v-model="grupoTela.descricao"
                                label="Descrição"/>
                    </v-flex>
                    <v-flex xs12 sm2>
                        <v-switch
                                v-model="grupoTela.ativo"
                                :label="labelAtivo"
                        ></v-switch>
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
        data(){
            return{
                idGrupoTela: this.$route.params.idGrupoTela,
                load: false
            }
        },
        computed:{
            ...mapGetters({

            }),
            grupoTela: {
                get(){
                    return this.$store.getters.getGrupoTela
                },
                set(valor){
                    this.$store.dispatch('setGrupoTela',valor)
                }
            },
            tituloForm(){
                return this.idTipoSenha ? 'Editar grupo de telas' : 'Novo grupo de telas'
            },
            labelAtivo(){
                return this.grupoTela.ativo ? 'Ativo' : 'Inativo'
            }
        },
        methods:{
            ...mapActions({
                loadGrupoTela: 'loadGrupoTela'
            }),
            async salvar(){
                if(this.idGrupoTela){
                    try{
                        await this.$store.dispatch('updateGrupoTela',this.grupoTela )
                        this.$router.push({name:'admin.grupo-telas'})
                        this.setMensagem({
                            ativo: true,
                            texto: 'Grupo de telas editado com sucesso',
                            tipo: 'success'
                        })
                    }catch (e){

                    }
                }else{
                    try{
                        await this.$store.dispatch('insertGrupoTela', this.grupoTela)
                        this.$router.push({name:'admin.grupo-telas'})
                        this.setMensagem({
                            ativo: true,
                            texto: 'Grupo de inserido com sucesso',
                            tipo: 'success'
                        })
                    }catch (e){

                    }

                }
            }
        },
        created(){
            if(!this.grupoTela.id && this.idGrupoTela){
                this.loadGrupoTela(this.idGrupoTela)
            }else if(!this.idGrupoTela){
                this.grupoTela.ativo = true
            }
        }
    }
</script>
