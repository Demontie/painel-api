<template>
    <v-container grid-list-md>
        <v-card xs12 sm12>
            <v-layout row wrap>

                <v-flex
                        v-for="(item, index) in listaBotoes" :key="index"
                >
                    <BotaoGuiche></BotaoGuiche>
                </v-flex>
            </v-layout>
        </v-card>
    </v-container>
</template>

<script>
    import BotaoGuiche from './BotaoGuiche'
    export default {
        components:{
            BotaoGuiche
        },
        data(){
            return{
                listaBotoes:[
                    'a','b','c','d'
                ]
            }
        }
    }
</script>

<style scoped>

</style>