<script setup>
import { ref } from 'vue';
import { computed } from 'vue';

// const props = defineProps(['text','size'])
const props = defineProps({
    text: {
        type: String,
        required: true
    },
    size: {
        type: String,
        default: 'large'
    }
})


const textSize = computed(() => {
    if (props.size === 'medium') {
        return 'text-2xl'
    } else if (props.size === 'large') {
        return 'text-4xl'
    } else if (props.size === 'small') {
        return 'text-xl'
    } else {
        return 'text-3xl'
    }
})

// const number = ref(0)

// const doubleNumber = computed(() => {
//     return number.value *2
// })


</script>

<template>

    <!-- {{ doubleNumber }}

    <button @click="number++">Increment ({{ number }})</button> -->
<h1

:class="textSize"
>

    {{ text }}

</h1>


</template>
