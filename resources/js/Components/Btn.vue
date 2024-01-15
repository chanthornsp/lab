<script setup >
defineProps({
    label: {
        type: String,
        required: false,
        default: 'Button'
    },
})

const emit = defineEmits(['onClick'])

function clickMe() {
emit('onClick', 'Clicked from Btn component')
}

</script>

<template>

    <button
    @click="clickMe"
        class="p-3 text-white bg-blue-600 rounded-sm"
    >{{label}}</button>
</template>
