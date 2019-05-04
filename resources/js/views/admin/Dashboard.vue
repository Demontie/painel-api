<template>
    <div>
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
                guicheSelecionado: localStorage.getItem('guicheSelecionado')
            }
        },
        created(){
            //const guicheSelecionado = localStorage.getItem('guicheSelecionando')

            if(!this.guicheSelecionado)
                this.$store.dispatch('setDialogGuiche',true)
        }
    }
</script>

<style scoped>

</style>