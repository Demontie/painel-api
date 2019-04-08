<template>
    <v-text-field
            v-model="param"
            append-icon="search"
            label="Pesquisar"
            single-line
            hide-details
    ></v-text-field>
</template>

<script>
    export default {
        props: ['param']
    }
</script>

<style scoped>

</style>