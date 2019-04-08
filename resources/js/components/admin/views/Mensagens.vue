<template>
    <v-snackbar
            v-model="mensagem.ativo"
            :right="true"
            :timeout="2500"
            :top="true"
            :color="mensagem.tipo"
    >
        {{ mensagem.texto }}
    </v-snackbar></template>
<script>
    import { mapGetters } from 'vuex'

    export default {
        name: 'mensagens',
        computed:{
            ...mapGetters({
                mensagem: 'getMensagem'
            })
        }
    }
</script>

<style scoped>

</style>