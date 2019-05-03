<template>
    <v-dialog persistent v-model="dialogGuiche" max-width="600">
        <v-layout align-start>
            <v-container grid-list-md>
                <v-card xs12 sm12>
                    <v-card-title primary-title>
                        <h3 class="headline">Selecione um guichê</h3>
                    </v-card-title>
                    <v-layout row wrap>
                        <div
                                v-for="(guiche, index) in guichesDisponiveis" :key="index"
                        >
                            <v-btn color="primary darken-4" class="mr-2" @click="selecionarGuiche(guiche)"> {{ guiche.descricao }}</v-btn>
                        </div>
                    </v-layout>
                </v-card>
            </v-container>
        </v-layout>
    </v-dialog>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    // import BotaoGuiche from './BotaoGuiche'

    export default {
        components:{
            //BotaoGuiche
        },
        data(){
            return{
            }
        },
        computed:{
            ...mapGetters({
                guichesDisponiveis: 'getGuichesDisponiveis',
            }),
            dialogGuiche:{
                get(){
                    return this.$store.getters.getDialogGuiche
                },
                set(valor){
                    this.$store.dispatch('setDialogGuiche',valor)
                }
            }
        },
        methods:{
            ...mapActions({
                loadGuiches: 'loadGuichesDisponiveis'
            }),
            selecionarGuiche(guiche){
                localStorage.setItem('guicheSelecionado',JSON.stringify(guiche))
                this.$store.dispatch('setGuicheSelecionado',guiche)
                this.$store.dispatch('setDialogGuiche',false)
            }
        },
        created(){
            this.loadGuiches()
        }
    }
</script>

<style scoped>

</style>