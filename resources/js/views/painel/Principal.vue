<template>
    <v-layout row wrap v-on:dblclick="sair">
        <v-flex d-flex  class="chamados-noticias">
            <v-layout column>
                <div class="chamadas">
                    <Chamada></Chamada>
                </div>
                <v-flex class="noticias">

                </v-flex>
                <ListaSenhas></ListaSenhas>
            </v-layout>
        </v-flex>

    </v-layout>
</template>

<script>
    import ListaSenhas from './ListaSenhas'
    import Chamada from './Chamada'

    export default {
        components:{
            ListaSenhas,
            Chamada
        },
        methods:{
            async sair(){
                let res = await this.$confirm('Deseja realmente sair do sistema?',{
                    title:'Atenção',
                    icon:'warning',
                    color:'warning'
                })

                if(res){
                    try{
                        return this.$router.push({name:'sair'})
                    }catch (e){
                        console.log(e)
                    }
                }
            }
        }
    }
</script>

<style scoped>
    *{
        margin:0;
        padding:0;
    }

    .chamadas{
        position: relative;
        top:0;
        width: 70%;
        height: 20%;
    }

    .chamados-noticias{
        position: absolute;
        top:0;
        left:0;
        width: 100%;
        height: 100%;
    }

    .noticias{
        position: relative;
        top:0;
        width: 70%;
        height: 80%;
    }
</style>