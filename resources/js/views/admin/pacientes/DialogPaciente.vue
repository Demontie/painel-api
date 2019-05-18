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
                                    :error-messages="nomeError"
                                    v-model.trim="paciente.nome"
                                    label="Nome"/>
                        </v-flex>
                        <v-flex xs12 sm4>
                            <v-text-field
                                    :error-messages="cpfError"
                                    v-model.trim="paciente.cpf"
                                    mask="###.###.###-##"
                                    label="CPF"/>
                        </v-flex>
                        <v-flex xs12 sm4>
                            <v-select
                                    :error-messages="medicoError"
                                    v-model="paciente.medico_id"
                                    :items="medicos"
                                    menu-props="auto"
                                    label="Médico"
                                    item-text="name"
                                    item-value="id"
                                    hide-details
                            ></v-select>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>

            <v-card-actions>
                <v-layout justify-end>
                    <v-btn color="default" @click="cancelar">Cancelar</v-btn>
                    <v-btn :disabled="dasabilitarBotao" color="primary darken-1" @click="salvar">Salvar</v-btn>
                </v-layout>
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
                senha: 'getSenha',
                paciente: 'getPaciente',
                grupoTelas: 'getGrupoTelas',
                guiche: 'getGuicheSelecionado',
                medicos: 'getMedicos'
            }),
            dialogPaciente: {
                get(){
                    return this.$store.getters.getDialogPaciente
                },
                set(valor){
                    this.$store.dispatch('setDialogPaciente',valor)
                }
            },
            nomeError(){
                const erros = []
                const nome = this.$v.paciente.nome

                if(nome.$dirty) {return erros}
                //!descricao.required && erros.push('Descrição obrigatória')
                !nome.minLength && erros.push(`Mínimo de ${nome.$params.minLength.min} caracteres`)

                return erros
            },
            cpfError(){
                const erros = []
                const cpf = this.$v.paciente.cpf

                if(cpf.$dirty) {return erros}
                //!descricao.required && erros.push('Descrição obrigatória')
                !cpf.minLength && erros.push(`Mínimo de ${cpf.$params.minLength.min} caracteres`)

                return erros
            },
            medicoError(){
                const erros = []
                const medico_id = this.$v.paciente.medico_id

                if(medico_id.$dirty) {return erros}
                //!descricao.required && erros.push('Descrição obrigatória')

                return erros
            },
            dasabilitarBotao(){
                return this.$v.paciente.$invalid
            }
        },
        validations: {
            paciente:{
                nome: {
                    required,
                    minLength: minLength(4)
                },
                cpf: {
                    required,
                    minLength: minLength(11)
                },
                medico_id: {
                    required
                }
            },
        },
        methods:{
            ...mapActions({
                setMensagem: 'setMensagem',
                setPaciente: 'setPaciente',
                loadMedicos: 'loadMedicos',
                ultimaSenhaChamada: 'ultimaSenhaChamada',
                atenderSenha: 'atenderSenha',
                loadSenhas: 'loadSenhas',
            }),
            async salvar(){
                try{
                    const paciente = await this.$store.dispatch('insertPaciente', this.paciente)
                    console.log(paciente)
                    try{
                        let chamadaObj = {
                            guiche_id: this.guiche.id,
                            paciente_id: paciente.id,
                            medico_id: this.paciente.medico_id
                        }

                        const senha = await this.atenderSenha(chamadaObj)
                        console.log(senha)

                        this.setMensagem({
                            texto: 'Senha atendida.',
                            tipo: 'success darken-2',
                            ativo: true
                        })

                    }catch(e){
                        this.setMensagem({
                            texto: e.message,
                            tipo: 'error darken-2',
                            ativo: true
                        })
                    }

                    this.loadSenhas()
                    this.setPaciente({})
                    this.$store.dispatch('setDialogPaciente',false)
                }catch (e){
                    this.setMensagem({
                        texto: e.message,
                        tipo: 'error darken-2',
                        ativo: true
                    })
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
            // if(!this.paciente.id && this.idPaciente){
            //     this.$store.dispatch('loadPaciente',this.idPaciente)
            // }
            //
            // if(this.paciente.length <= 0){
            //     this.$store.dispatch('loadPaciente')
            // }
            this.loadMedicos();
        }
    }
</script>

<style scoped>
</style>
