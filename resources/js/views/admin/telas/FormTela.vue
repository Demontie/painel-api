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
                                v-model="tela.descricao"
                                label="Descrição"/>
                    </v-flex>
                    <v-flex xs12 sm4 class="ml-2">
                        <v-select
                                v-model="tela.grupo_tela_id"
                                :items="grupoTelas"
                                menu-props="auto"
                                label="Grupo de telas"
                                item-text="descricao"
                                item-value="id"
                                hide-details
                        ></v-select>
                    </v-flex>
                    <v-flex v-if="idTela" xs12 sm2>
                        <v-switch
                                v-model="tela.ativo"
                                color="primary"
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
        props:[],
        data(){
            return{
                idTela: this.$route.params.idTela,
                load:false,
                grupoTela: {},

            }
        },
        computed:{
            ...mapGetters({
                telas: 'getTelas',
                grupoTelas: 'getGrupoTelas'
            }),
            tela: {
                get(){
                    return this.$store.getters.getTela
                },
                set(valor){
                    this.$store.dispatch('setTela',valor)
                }
            },
            tituloForm(){
                return this.idTela ? 'Editar tela' : 'Nova tela'
            },
            labelAtivo(){
                return this.tela.ativo ? 'Ativo' : 'Inativo'
            }
        },
        methods:{
            loadGrupoTela(){
                if(this.idTela){
                    const grupoTelaFiltrado = this.grupoTelas.find(grupoTela => {
                        if(grupoTela.id === this.tela.grupo_tela_id){
                            return grupoTela
                        }
                    })

                    return this.grupoTela = grupoTelaFiltrado
                }
            },
            async salvar(){
                if(this.idTela){
                    try{
                        await this.$store.dispatch('updateTela',this.tela )
                        this.$router.push({name:'admin.telas'})
                    }catch (e){

                    }
                }else{
                    try{
                        await this.$store.dispatch('insertTela', this.tela)
                        this.$router.push({name:'admin.telas'})
                    }catch (e){

                    }
                }
            }
        },
        created(){
            this.$store.dispatch('loadGrupoTelas')

            if(!this.tela.id && this.idTela){
                this.$store.dispatch('loadTela',this.idTela)
            }

            if(this.telas.length <= 0){
                this.$store.dispatch('loadTelas')
            }

            this.loadGrupoTela()
        }
    }
</script>

<style scoped>

</style>