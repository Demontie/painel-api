<template>
    <v-menu :nudge-width="100">
        <template v-slot:activator="{ on }">
            <v-toolbar-title v-on="on">
                <span>{{menuObj.texto}}</span>
                <v-icon dark>arrow_drop_down</v-icon>
            </v-toolbar-title>
        </template>

        <v-list>
            <v-list-tile
                    v-for="(item,index) in menuObj.itens"
                    :key="index"
                    v-if="item.permissao"
                    :to="item.rota"
            >
                <v-list-tile-title v-if="!item.metodo">
                    <span>{{item.texto}}</span>
                    <v-icon flat v-if="item.icone">{{ item.icone }}</v-icon>
                </v-list-tile-title>

                <v-list-tile-title v-else v-on:click="item.metodo">
                    <span>{{item.texto}}</span>
                    <v-icon flat v-if="item.icone">{{ item.icone }}</v-icon>
                </v-list-tile-title>
            </v-list-tile>
        </v-list>
    </v-menu>
</template>

<script>
    export default {
        props:['menuObj']
    }
</script>

<style scoped>

</style>