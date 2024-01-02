<script setup>
import { ref } from 'vue';



const roomName = ref()



</script>


<template>
    <div class="container p-4 px-8 mx-auto mt-6 border rounded-xl">
        <h2 class="text-2xl text-blue-600 sm:text-red-600 md:text-yellow-600 lg:text-purple-600 xl:text-teal-600">Create
            Room</h2>
        <div class="flex flex-col gap-4 mt-4">
            {{ roomName }}
            <!-- form in here -->
            <div class="flex flex-col gap-2 lg:flex-row">
                <div class="flex flex-col w-full">
                    <label>Room name</label>
                    <input v-model.trim="roomName" type="text" class="p-2 rounded-md" />
                </div>
                <div class="flex flex-col w-full">
                    <label>Description</label>
                    <textarea class="rounded-md"></textarea>
                </div>
            </div>
            <div class="flex flex-col gap-2 lg:flex-row">
                <div class="flex flex-col w-full">
                    <label>Capacity</label>
                    <input class="rounded-md" type="number" />
                </div>
                <div class="flex flex-col w-full">
                    <label>Status</label>
                    <select class="rounded-md">
                        <option value="">Select a Staus</option>
                        <option value="active">Active</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end">
                <button class="p-2 text-white bg-blue-600 rounded-lg active:bg-blue-800" type="submit">Create</button>
            </div>
        </div>
    </div>
</template>
