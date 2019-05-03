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
                                    v-model.trim="guiche.descricao"
                                    label="Descrição"/>
                        </v-flex>

                        <v-flex xs12 sm4 class="ml-2">
                            <v-select
                                    v-model="guiche.grupo_tela_id"
                                    :items="grupoTelas"
                                    menu-props="auto"
                                    label="Grupo de telas"
                                    item-text="descricao"
                                    item-value="id"
                                    hide-details
                            ></v-select>
                        </v-flex>

                        <v-flex v-if="idGuiche" xs12 sm2>
                            <v-switch
                                    v-model="guiche.ativo"
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
        data(){
            return{
                idGuiche: this.$route.params.idGuiche,
                load:false,
            }
        },
        computed:{
            ...mapGetters({
                perfis: 'getGuiches',
                grupoTelas: 'getGrupoTelas'
            }),
            guiche: {
                get(){
                    return this.$store.getters.getGuiche
                },
                set(valor){
                    this.$store.dispatch('setGuiche',valor)
                }
            },
            tituloForm(){
                return this.idGuiche ? 'Editar guiche' : 'Novo guiche'
            },
            labelAtivo(){
                return this.guiche.ativo ? 'Ativo' : 'Inativo'
            },
            descricaoError(){
                const erros = []
                const descricao = this.$v.guiche.descricao

                if(descricao.$dirty) {return erros}
                //!descricao.required && erros.push('Descrição obrigatória')
                !descricao.minLength && erros.push(`Mínimo de ${descricao.$params.minLength.min} caracteres`)

                return erros
            },
            dasabilitarBotao(){
                return this.$v.guiche.$invalid
            }
        },
        validations: {
            guiche:{
                descricao: {
                    required,
                    minLength: minLength(4)
                }
            },
        },
        methods:{
            loadGrupoTela(){
                if(this.idGuiche){
                    const grupoTelaFiltrado = this.grupoTelas.find(grupoTela => {
                        if(grupoTela.id === this.guiche.grupo_tela_id){
                            return grupoTela
                        }
                    })

                    return this.grupoTela = grupoTelaFiltrado
                }
            },
            async salvar(){
                if(this.idGuiche){
                    try{
                        await this.$store.dispatch('updateGuiche',this.guiche )
                        this.$router.push({name:'admin.guiches'})
                    }catch (e){

                    }
                }else{
                    try{
                        await this.$store.dispatch('insertGuiche', this.guiche)
                        this.$router.push({name:'admin.guiches'})
                    }catch (e){

                    }
                }
            }
        },
        // watch:{
        //   guiche:{
        //       handler(novoValor){
        //           novoValor
        //       },
        //       deep:true
        //   }
        // },
        created(){
            this.$store.dispatch('loadGrupoTelas')

            if(!this.guiche.id && this.idGuiche){
                this.$store.dispatch('loadGuiche',this.idGuiche)
            }

            if(this.guiche.length <= 0){
                this.$store.dispatch('loadGuiche')
            }

            this.loadGrupoTela()
        }
    }
</script>

<style scoped>
</style>