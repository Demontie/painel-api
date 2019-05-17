<template>
    <v-card>
        <v-card-title>
            <span class="headline">Perfil do usuário</span>
        </v-card-title>
        <v-card-text>
            <Loader :load="load" />
            <v-container grid-list-md>
                <v-layout wrap>
                    <v-flex xs12 sm4>
                        <v-text-field
                                :error-messages="nameError"
                                v-model.trim="usuario.name"
                                label="Nome"/>
                    </v-flex>
                    <v-flex xs12 sm8>
                        <v-text-field
                                :error-messages="emailError"
                                v-model.trim="usuario.email"
                                label="E-mail"/>
                    </v-flex>
                    <v-flex xs12 sm4>
                        <v-text-field
                                :error-messages="passwordError"
                                type="password"
                                v-model.trim="usuario.password"
                                label="Senha"/>
                    </v-flex>
                    <v-flex xs12 sm4>
                        <v-select
                                v-model="usuario.perfil_id"
                                :error-messages="perfilError"
                                :items="perfis"
                                menu-props="auto"
                                label="Perfil"
                                item-text="descricao"
                                item-value="id"
                                hide-details
                        ></v-select>
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
</template>

<script>
    import Loader from './../../../components/admin/views/Loader'
    import { required, minLength,email } from 'vuelidate/lib/validators'
    import { mapGetters,mapActions } from 'vuex'

    export default {
        components:{
            Loader
        },
        data(){
            return{
                idUsuario: this.$route.params.idUsuario,
                load:false,
                //usuario:{}
            }
        },
        computed:{
            ...mapGetters({
                perfis: 'getPerfis'
            }),
            usuario: {
                get(){
                    return this.$store.getters.getUsuario
                },
                set(valor){
                    this.$store.dispatch('setUsuario',valor)
                }
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
            emailError(){
                const erros = []
                const email = this.$v.usuario.email

                if(email.$dirty) {return erros}
                //!name.required && erros.push('Descrição obrigatória')
                !email.email && erros.push(`Deve ser um e-mail válido`)

                return erros
            },
            passwordError(){
                const erros = []
                const password = this.$v.usuario.password

                if(password.$dirty) {return erros}
                //!name.required && erros.push('Descrição obrigatória')
                !password.minLength && erros.push(`Mínimo de ${password.$params.minLength.min} caracteres`)

                return erros
            },
            perfilError(){
                const erro = []
                const perfil = this.$v.usuario.perfil_id

                if(!perfil.dirty){return erro}
                !perfil.required && erro.push('Grupo de telas obrigatório')
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
                },
                email:{
                    required,
                    email
                },
                password:{
                    required,
                    minLength: minLength(4)
                },
                perfil_id:{
                    required
                }
            },
        },
        methods:{
            loadPerfis(){
                if(this.idTela){
                    const perfis = this.perfis.find(perfil => {
                        if(perfil.id === this.usuario.perfil_id){
                            return perfil
                        }
                    })

                    return this.grupoTela = perfis
                }
            },
            async salvar(){
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
        created(){
            this.$store.dispatch('loadPerfis')

            if(this.idUsuario){
                this.$store.dispatch('loadUsuario',this.idUsuario)
            }
            //
            // if(this.usuario.length <= 0){
            //     this.$store.dispatch('loadUsuario')
            // }
            this.loadPerfis()
        }
    }
</script>

<style scoped>

</style>