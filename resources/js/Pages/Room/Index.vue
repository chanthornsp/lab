<script setup>
import App from "@/Layouts/App.vue";
import Heading from "@/Components/Heading.vue";
import Btn from "@/Components/Btn.vue";

defineProps({
    rooms: Object,
});

function btnClick(e) {
   alert(e)
}

</script>

<template>
    <App>
        <Btn
            @onClick="btnClick"
        label="Click me" />
        <Heading text="List Rooms" />
        <ul>
            <li v-for="item in rooms">
                {{ item.name }}
            </li>
        </ul>
    </App>
</template>
