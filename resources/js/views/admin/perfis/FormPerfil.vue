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
                                    v-model.trim="perfil.descricao"
                                    label="Descrição"/>
                        </v-flex>

                        <v-flex v-if="idPerfil" xs12 sm2>
                            <v-switch
                                    v-model="perfil.ativo"
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
                idPerfil: this.$route.params.idPerfil,
                load:false,
            }
        },
        computed:{
            ...mapGetters({
                perfis: 'getPerfis',
                grupoTelas: 'getGrupoTelas'
            }),
            perfil: {
                get(){
                    return this.$store.getters.getPerfil
                },
                set(valor){
                    this.$store.dispatch('setPerfil',valor)
                }
            },
            tituloForm(){
                return this.idPerfil ? 'Editar perfil' : 'Novo perfil'
            },
            labelAtivo(){
                return this.perfil.ativo ? 'Ativo' : 'Inativo'
            },
            descricaoError(){
                const erros = []
                const descricao = this.$v.perfil.descricao

                if(descricao.$dirty) {return erros}
                //!descricao.required && erros.push('Descrição obrigatória')
                !descricao.minLength && erros.push(`Mínimo de ${descricao.$params.minLength.min} caracteres`)

                return erros
            },
            dasabilitarBotao(){
                return this.$v.perfil.$invalid
            }
        },
        validations: {
            perfil:{
                descricao: {
                    required,
                    minLength: minLength(4)
                }
            },
        },
        methods:{
            async salvar(){

                this.perfil.descricao = this.perfil.descricao.toUpperCase()

                if(this.idPerfil){
                    try{
                        await this.$store.dispatch('updatePerfil',this.perfil )
                        this.$router.push({name:'admin.perfis'})
                    }catch (e){

                    }
                }else{
                    try{
                        await this.$store.dispatch('insertPerfil', this.perfil)
                        this.$router.push({name:'admin.perfis'})
                    }catch (e){

                    }
                }
            }
        },
        // watch:{
        //   perfil:{
        //       handler(novoValor){
        //           novoValor
        //       },
        //       deep:true
        //   }
        // },
        created(){

            if(!this.perfil.id && this.idPerfil){
                this.$store.dispatch('loadPerfil',this.idPerfil)
            }

            if(this.perfil.length <= 0){
                this.$store.dispatch('loadPerfil')
            }

        }
    }
</script>

<style scoped>
</style>