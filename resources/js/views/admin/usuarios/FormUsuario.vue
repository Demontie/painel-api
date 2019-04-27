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
                                    :error-messages="nameError"
                                    v-model.trim="usuario.name"
                                    label="Descrição"/>
                        </v-flex>

                        <v-flex v-if="idUsuario" xs12 sm2>
                            <v-switch
                                    v-model="usuario.ativo"
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
                idUsuario: this.$route.params.idUsuario,
                load:false,
            }
        },
        computed:{
            ...mapGetters({
                usuarios: 'getUsuarios',
                grupoTelas: 'getGrupoTelas'
            }),
            usuario: {
                get(){
                    return this.$store.getters.getUsuario
                },
                set(valor){
                    this.$store.dispatch('setUsuario',valor)
                }
            },
            tituloForm(){
                return this.idUsuario ? 'Editar usuario' : 'Novo usuario'
            },
            labelAtivo(){
                return this.usuario.ativo ? 'Ativo' : 'Inativo'
            },
            nameError(){
                const erros = []
                const name = this.$v.usuario.name

                if(name.$dirty) {return erros}
                //!name.required && erros.push('Descrição obrigatória')
                !name.minLength && erros.push(`Mínimo de ${name.$params.minLength.min} caracteres`)

                return erros
            },
            dasabilitarBotao(){
                return this.$v.usuario.$invalid
            }
        },
        validations: {
            usuario:{
                name: {
                    required,
                    minLength: minLength(4)
                }
            },
        },
        methods:{
            async salvar(){

                this.usuario.name = this.usuario.name.toUpperCase()

                if(this.idUsuario){
                    try{
                        await this.$store.dispatch('updateUsuario',this.usuario )
                        this.$router.push({name:'admin.usuarios'})
                    }catch (e){

                    }
                }else{
                    try{
                        await this.$store.dispatch('insertUsuario', this.usuario)
                        this.$router.push({name:'admin.usuarios'})
                    }catch (e){

                    }
                }
            }
        },
        // watch:{
        //   usuario:{
        //       handler(novoValor){
        //           novoValor
        //       },
        //       deep:true
        //   }
        // },
        created(){

            if(!this.usuario.id && this.idUsuario){
                this.$store.dispatch('loadUsuario',this.idUsuario)
            }

            if(this.usuario.length <= 0){
                this.$store.dispatch('loadUsuario')
            }

        }
    }
</script>

<style scoped>
</style>