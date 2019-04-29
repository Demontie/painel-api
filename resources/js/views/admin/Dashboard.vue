<template>
    <div>
        Dashboard
        <br>
        <ListaGuichesDashboard></ListaGuichesDashboard>
    </div>
</template>

<script>
    import ListaGuichesDashboard from './guiches/ListaGuichesDashboard'

    export default {
        components:{
            ListaGuichesDashboard
        },
        data(){
            return{

            }
        }
    }
</script>

<style scoped>

</style>