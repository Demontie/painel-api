<template>
    <v-container grid-list-md>
        <v-card xs12 sm12>
            <v-layout row wrap>
                <v-flex
                        v-for="(guiche, index) in guiches" :key="index"
                >
                    <v-btn color="primary darken-4" block @click="selecionarGuiche(guiche)"> {{ guiche.descricao }}</v-btn>
                </v-flex>
            </v-layout>
        </v-card>
    </v-container>
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
                guiches: 'getGuiches',
            })
        },
        methods:{
            ...mapActions({
                loadGuiches: 'loadGuiches'
            }),
            selecionarGuiche(guiche){
                localStorage.setItem('guiche',guiche)
            }
        },
        created(){
            this.loadGuiches()
        }
    }
</script>

<style scoped>

</style>