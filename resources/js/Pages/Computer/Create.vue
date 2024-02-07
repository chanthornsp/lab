<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { useForm } from "@inertiajs/vue3";
import { MoveLeft } from "lucide-vue-next";

const props = defineProps<{
    rooms: {
        room_id: string;
        name: string;
    }[];
    statuses: {
        id: number;
        name: string;
    }[];
}>();

// form object
const form = useForm({
    name: "",
    description: "",
    room_id: "",
    status_id: null,
});

// handle form submission
const onSave = () => {
    console.log(form.data());
};
</script>
<template>
    <App>
        <div class="p-3">
            <h2 class="text-2xl font-bold">Create a Computer</h2>
            <div class="mt-4">
                <div class="bg-base-100 p-2 rounded-xl">
                    <Link
                        :href="route('computer.index')"
                        class="btn btn-warning"
                    >
                        <MoveLeft class="w-5 h-5" />
                        Back</Link
                    >
                </div>
            </div>
            <div class="mt-4 p-4 bg-base-100 rounded-xl">
                <!-- form -->
                <form @submit.prevent="onSave">
                    <div>
                        <label class="label">Name</label>
                        <input
                            v-model="form.name"
                            class="input input-primary w-full"
                        />
                    </div>
                    <div>
                        <label class="label">Description</label>
                        <textarea
                            v-model="form.description"
                            class="textarea textarea-primary w-full"
                        ></textarea>
                    </div>
                    <div class="flex gap-2">
                        <div class="w-full">
                            <label class="label">Room</label>
                            <select
                                v-model="form.room_id"
                                class="select select-primary w-full"
                            >
                                <option value="">Select Room</option>
                                <option
                                    :value="item.room_id"
                                    v-for="(item, index) in rooms"
                                >
                                    {{ item.name }}
                                </option>
                            </select>
                        </div>
                        <div class="w-full">
                            <label class="label">Status</label>
                            <select
                                v-model="form.status_id"
                                class="select select-primary w-full"
                            >
                                <option :value="null">Select Status</option>
                                <option
                                    :value="item.id"
                                    v-for="(item, index) in statuses"
                                >
                                    {{ item.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-2 flex justify-end">
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </App>
</template>
