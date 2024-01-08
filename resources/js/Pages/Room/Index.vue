<script setup>
import App from "@/Layouts/App.vue";

defineProps({
    rooms: Object,
});
</script>

<template>
    <App>
        <ul>
            <li v-for="item in rooms">
                {{ item.name }}
            </li>
        </ul>
    </App>
</template>
