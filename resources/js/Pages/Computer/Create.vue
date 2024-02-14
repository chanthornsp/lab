<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { ComputerType } from "@/types/computerType";
import { useForm } from "@inertiajs/vue3";
import { MoveLeft } from "lucide-vue-next";
import Swal from "sweetalert2";

const props = defineProps<{
    rooms: {
        room_id: string;
        name: string;
    }[];
    statuses: {
        id: number;
        name: string;
    }[];
    computer?: ComputerType;
}>();

// form object
const form = useForm({
    computer_id: props.computer?.computer_id ?? "",
    name: props.computer?.name ?? "",
    description: props.computer?.description ?? "",
    room_id: props.computer?.room_id ?? "",
    status_id: props.computer?.status_id ?? null,
});

// handle form submission
const onSave = () => {
    form.post(route("computer.store"), {
        onSuccess: () => {
            Swal.fire({
                icon: "success",
                title: "Success",
                timer: 3000,
                position: "top-end",
                toast: true,
            });
        },
    });
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
                            :class="{ 'input-error': form.errors.name }"
                        />
                        <div class="text-error" v-if="form.errors.name">
                            {{ form.errors.name }}
                        </div>
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
                                :class="{ 'select-error': form.errors.room_id }"
                            >
                                <option value="">Select Room</option>
                                <option
                                    :value="item.room_id"
                                    v-for="(item, index) in rooms"
                                >
                                    {{ item.name }}
                                </option>
                            </select>
                            <div class="text-error" v-if="form.errors.room_id">
                                {{ form.errors.room_id }}
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="label">Status</label>
                            <select
                                v-model="form.status_id"
                                class="select select-primary w-full"
                                :class="{
                                    'select-error': form.errors.status_id,
                                }"
                            >
                                <option :value="null">Select Status</option>
                                <option
                                    :value="item.id"
                                    v-for="(item, index) in statuses"
                                >
                                    {{ item.name }}
                                </option>
                            </select>
                            <div
                                class="text-error"
                                v-if="form.errors.status_id"
                            >
                                {{ form.errors.status_id }}
                            </div>
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
