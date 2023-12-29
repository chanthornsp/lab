<script setup>
import { ref, reactive } from "vue";

const message = ref("Hello world");

const count = reactive({ number: 0 });

function updateMessage() {
    message.value = "Hello world updated";
    count.number = 90;
}
</script>
<template>
    <div>{{ message }}, {{ count.number }}</div>
    <div>
        <button
            class="p-5 text-lg text-white bg-red-500 rounded-lg"
            @click="updateMessage"
        >
            Click me
        </button>
    </div>
</template>
