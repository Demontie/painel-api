<template>
    <v-dialog v-model="dialogPaciente" persistent>
        <v-card>
            <v-card-title>
                <span class="headline">Paciente</span>
            </v-card-title>
            <v-card-text>
                <Loader :load="load" />
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12 sm4>
                            <v-text-field
                                    :error-messages="descricaoError"
                                    v-model.trim="paciente.nome"
                                    label="Nome"/>
                        </v-flex>
                        <v-flex xs12 sm4>
                            <v-text-field
                                    :error-messages="descricaoError"
                                    v-model.trim="paciente.cpf"
                                    label="CPF"/>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>

            <v-card-actions>
                <v-btn color="deafault" @click="cancelar">Cancelar</v-btn>
                <v-spacer></v-spacer>
                <v-btn :disabled="dasabilitarBotao" color="primary darken-1" @click="salvar">Salvar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
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
                load:false,
            }
        },
        computed:{
            ...mapGetters({
                pacientes: 'getPacientes',
                grupoTelas: 'getGrupoTelas',
                guiche: 'getGuicheSelecionado'
            }),
            senha:{
                get(){
                    return this.$store.getters.getSenha
                },
                set(value){
                    this.$store.dispatch('setSenha',value)
                }
            },
            dialogPaciente: {
                get(){
                    return this.$store.getters.dialogPaciente
                },
                set(valor){
                    this.$store.dispatch('setDialogPaciente',valor)
                }
            },
            descricaoError(){
                const erros = []
                const descricao = this.$v.paciente.descricao

                if(descricao.$dirty) {return erros}
                //!descricao.required && erros.push('Descrição obrigatória')
                !descricao.minLength && erros.push(`Mínimo de ${descricao.$params.minLength.min} caracteres`)

                return erros
            },
            dasabilitarBotao(){
                return this.$v.paciente.$invalid
            }
        },
        validations: {
            paciente:{
                descricao: {
                    required,
                    minLength: minLength(4)
                }
            },
        },
        methods:{
            async salvar(){
                try{
                    const paciente = await this.$store.dispatch('insertPaciente', this.paciente)

                    paciente.guiche_id = this.guiche.id

                    try{
                        const senha = await this.atenderSenha(paciente)

                        console.log(senha)

                        this.loadSenhas()
                    }catch(e){
                        this.setMensagem({
                            texto: e.message,
                            tipo: 'error darken-2',
                            ativo: true
                        })
                    }

                    this.$store.dispatch('setDialogPaciente',valor)
                }catch (e){

                }
            },
            cancelar(){
                this.$store.dispatch('setDialogPaciente',false)
            }
        },
        // watch:{
        //   paciente:{
        //       handler(novoValor){
        //           novoValor
        //       },
        //       deep:true
        //   }
        // },
        created(){

            if(!this.paciente.id && this.idPaciente){
                this.$store.dispatch('loadPaciente',this.idPaciente)
            }

            if(this.paciente.length <= 0){
                this.$store.dispatch('loadPaciente')
            }

        }
    }
</script>

<style scoped>
</style>
