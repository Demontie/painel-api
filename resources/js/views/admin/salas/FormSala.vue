<template>
    <v-form>
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
                                    :error-messages="descricaoError"
                                    v-model.trim="sala.descricao"
                                    label="Descrição"/>
                        </v-flex>

                        <v-flex xs12 sm4 class="ml-2">
                            <v-select
                                    v-model="sala.grupo_tela_id"
                                    :error-messages="grupoTelaError"
                                    :items="grupoTelas"
                                    menu-props="auto"
                                    label="Grupo de Telas"
                                    item-text="descricao"
                                    item-value="id"
                                    hide-details
                            ></v-select>
                        </v-flex>

                        <v-flex v-if="idSala" xs12 sm2>
                            <v-switch
                                    v-model="sala.ativo"
                                    color="primary"
                                    :label="labelAtivo"
                            ></v-switch>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn :disabled="dasabilitarBotao" color="primary darken-1" @click="salvar">Salvar</v-btn>
            </v-card-actions>
        </v-card>
    </v-form>
</template>

<script>
    import Loader from './../../../components/admin/views/Loader'
    import { required, minLength } from 'vuelidate/lib/validators'
    import { mapGetters,mapActions } from 'vuex'

    export default {
        components:{
            Loader
        },
        props:[],
        data(){
            return{
                idSala: this.$route.params.idSala,
                load:false,
                grupoTela: {}
            }
        },
        computed:{
            ...mapGetters({
                salas: 'getSalas',
                grupoTelas: 'getGrupoTelas'
            }),
            sala: {
                get(){
                    return this.$store.getters.getSala
                },
                set(valor){
                    this.$store.dispatch('setSala',valor)
                }
            },
            tituloForm(){
                return this.idSala ? 'Editar sala' : 'Nova sala'
            },
            labelAtivo(){
                return this.sala.ativo ? 'Ativo' : 'Inativo'
            },
            descricaoError(){
                const erros = []
                const descricao = this.$v.sala.descricao

                if(descricao.$dirty) {return erros}
                //!descricao.required && erros.push('Descrição obrigatória')
                !descricao.minLength && erros.push(`Mínimo de ${descricao.$params.minLength.min} caracteres`)

                return erros
            },
            grupoTelaError(){
                const erro = []
                const grupoTelas = this.$v.sala.grupo_tela_id

                if(!grupoTelas.dirty){return erro}
                !grupoTelas.required && erro.push('Grupo de telas obrigatório')
            },
            dasabilitarBotao(){
                return this.$v.sala.$invalid
            }
        },
        validations: {
            sala:{
                descricao: {
                    required,
                    minLength: minLength(4)
                },
                grupo_tela_id:{
                    required
                }
            },
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

                if(this.idSala){
                    try{
                        await this.$store.dispatch('updateSala',this.sala )
                        this.$router.push({name:'admin.salas'})
                    }catch (e){

                    }
                }else{
                    try{
                        await this.$store.dispatch('insertSala', this.sala)
                        this.$router.push({name:'admin.salas'})
                    }catch (e){

                    }
                }
            }
        },
        created(){

            this.$store.dispatch('loadGrupoTelas')

            if(!this.sala.id && this.idSala){
                this.$store.dispatch('loadSala',this.idSala)
            }

            if(this.sala.length <= 0){
                this.$store.dispatch('loadSala')
            }

            this.loadGrupoTela()
        }
    }
</script>

<style scoped>

</style>