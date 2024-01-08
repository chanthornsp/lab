<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import Layout from "@/Layouts/App.vue";

const props = defineProps({
    errors: Object,
});

// const roomName = ref();
// const descirption = ref();
// const capacity = ref();
// const status = ref("active");

const form = ref({
    name: "",
    description: "",
    capacity: 0,
    status: "active",
});

const message = ref("");

// function save (){

// }

const save = () => {
    // const data = {
    //     roomName: roomName.value,
    //     descirption: descirption.value,
    //     capacity: capacity.value,
    //     status: status.value,
    // };
    // https://inertiajs.com/manual-visits
    router.post("/room/store", form.value, {
        onSuccess: () => {
            // roomName.value = "";
            // descirption.value = "";
            // capacity.value = "";
            // status.value = "active";
            message.value = "Room created successfully";
            form.value = {
                name: "",
                description: "",
                capacity: 0,
                status: "active",
            };
        },
    });
};
</script>

<template>
    <Layout>
        <div class="container p-4 px-8 mx-auto mt-6 border rounded-xl">
            <h2
                class="text-2xl text-blue-600 sm:text-red-600 md:text-yellow-600 lg:text-purple-600 xl:text-teal-600"
            >
                Create Room
            </h2>
            <div class="text-green-600">
                {{ message }}
            </div>
            <form @submit.prevent="save" class="flex flex-col gap-4 mt-4">
                <!-- form in here -->
                <div class="flex flex-col gap-2 lg:flex-row">
                    <div class="flex flex-col w-full">
                        <label>Room name</label>
                        <input
                            v-model.trim="form.name"
                            type="text"
                            class="p-2 rounded-md"
                        />
                        <div v-if="errors.name" class="text-sm text-red-500">
                            {{ errors.name }}
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <label>Description</label>
                        <textarea
                            v-model="form.description"
                            class="rounded-md"
                        ></textarea>
                    </div>
                </div>
                <div class="flex flex-col gap-2 lg:flex-row">
                    <div class="flex flex-col w-full">
                        <label>Capacity</label>
                        <input
                            v-model.number="form.capacity"
                            class="rounded-md"
                            type="number"
                        />
                        <div
                            v-if="errors.capacity"
                            class="text-sm text-red-500"
                        >
                            {{ errors.capacity }}
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <label>Status</label>
                        <select v-model="form.status" class="rounded-md">
                            <option value="">Select a Staus</option>
                            <option value="active">Active</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                        <div v-if="errors.status" class="text-sm text-red-500">
                            {{ errors.status }}
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button
                        class="p-2 text-white bg-blue-600 rounded-lg active:bg-blue-800"
                        type="submit"
                    >
                        Create
                    </button>
                </div>
            </form>
        </div>
    </Layout>
</template>
