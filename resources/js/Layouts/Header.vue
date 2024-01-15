<script setup>
const props = defineProps({
    headerText: {
        type: String,
        default: "Header"
        }
    })
const emit = defineEmits(["clickFromHeaderButn"]);
</script>
<template>
    <header>
        <h1>{{headerText}}</h1>
        <button @click="emit('clickFromHeaderButn')">Click me</button>
    </header>
</template>
