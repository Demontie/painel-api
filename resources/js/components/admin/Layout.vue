<template>
    <v-content>
        <Header/>
        <router-view/>
    </v-content>
</template>

<script>
import Header from './Header'

    export default {
        components:{
            Header
        }
    }
</script>

<style scoped>

</style>