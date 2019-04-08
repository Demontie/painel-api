<template>
    <v-progress-linear v-show="load" :indeterminate="load"/>
</template>

<script>
    export default {
        props:['load']
    }
</script>