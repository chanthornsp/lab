<script setup lang="ts">
import { PropType } from "vue";

import App from "@/Layouts/App.vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import { ref } from "vue";
import axios from "axios";
import Swal from "sweetalert2";
import { AxiosError } from "axios";

type RoomType = {
    room_id: string;
    name: string;
    description: string;
    capacity: number;
    status: string;
    user_id: number;
};

defineProps({
    rooms: {
        type: Object as PropType<RoomType[]>,
        required: true,
    },
    errors: Object as PropType<Record<string, string[]>>,
});

const form = useForm({
    room_id: "",
    name: "",
    description: "",
    capacity: 0,
    status: "active",
});

const save = () => {
    form.post(route("room.store", form.room_id), {
        onSuccess: () => {
            Swal.fire({
                title: "Success",
                icon: "success",
                toast: true,
                position: "top-end",
                timer: 3000,
                showConfirmButton: false,
            });
            form.reset();
            form.isDirty = false;
            onClose();
        },
    });
};

const openModal = ref(false);

const edit = async (roomId: string) => {
    try {
        const { data } = (await axios.get(route("room.edit", roomId))) as {
            data: RoomType;
        };

        form.room_id = data.room_id;
        form.name = data.name;
        form.capacity = data.capacity;
        form.description = data.description;

        openModal.value = true;
    } catch (error: AxiosError | any) {
        if (error.response.status === 404) {
            Swal.fire({
                title: "Error",
                text: "Room not found",
                icon: "error",
            });
        } else if (error.response.status === 500) {
            Swal.fire({
                title: "Error",
                text: "Internal server error",
                icon: "error",
            });
        } else {
            Swal.fire({
                title: "Error",
                text: error.response.data?.message,
                icon: "error",
            });
        }
    }
};

const onDelete = (roomId: string) => {
    Swal.fire({
        title: "Do you want to delete?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Yes",
        denyButtonText: `No`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            router.delete(route("room.destroy", roomId), {
                onSuccess: () => {
                    Swal.fire({
                        title: "Success",
                        icon: "success",
                    });
                },
            });
        }
    });
};

const onClose = () => {
    if (form.isDirty) {
        Swal.fire({
            title: "Are you sure?",
            text: "You will lose your unsaved changes!",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Yes",
            denyButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed) {
                form.reset();
                openModal.value = false;
            }
        });
    } else {
        form.reset();
        openModal.value = false;
    }
};
</script>

<template>
    <Modal :show="openModal" @close="onClose">
        <div class="p-4">
            <h2 class="text-xl">Room</h2>
            <div>
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
                            <div
                                v-if="form.errors.name"
                                class="text-sm text-red-500"
                            >
                                {{ form.errors.name }}
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
                                v-if="form.errors.capacity"
                                class="text-sm text-red-500"
                            >
                                {{ form.errors.capacity }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label>Status</label>
                            <select v-model="form.status" class="rounded-md">
                                <option value="">Select a Staus</option>
                                <option value="active">Active</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                            <div
                                v-if="form.errors.status"
                                class="text-sm text-red-500"
                            >
                                {{ form.errors.status }}
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button
                            @click="onClose"
                            type="button"
                            class="mr-2 btn btn-error"
                        >
                            Cancel
                        </button>
                        <button
                            class="p-2 text-white bg-blue-600 rounded-lg active:bg-blue-800"
                            type="submit"
                        >
                            {{ form.room_id ? "Update" : "Create" }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Modal>

    <App>
        <div class="p-4">
            <h2 class="text-2xl font-bold">Room List</h2>
            <div class="my-2">
                <button
                    @click="openModal = true"
                    type="button"
                    class="p-2 text-white bg-blue-600 rounded-md"
                >
                    Add Room
                </button>
            </div>
            <div class="p-2 bg-white rounded-lg dark:bg-gray-800">
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th
                                class="bg-blue-100 border border-blue-600 dark:bg-blue-700"
                            >
                                No
                            </th>
                            <th
                                class="bg-blue-100 border border-blue-600 dark:bg-blue-700"
                            >
                                Room Name
                            </th>
                            <th
                                class="bg-blue-100 border border-blue-600 dark:bg-blue-700"
                            >
                                Status
                            </th>
                            <th
                                class="bg-blue-100 border border-blue-600 dark:bg-blue-700"
                            >
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(room, index) in rooms">
                            <td class="text-center border border-blue-600">
                                {{ index + 1 }}
                            </td>
                            <td class="border border-blue-600">
                                {{ room.name }}
                            </td>
                            <td class="text-center border border-blue-600">
                                {{ room.status.toUpperCase() }}
                            </td>
                            <td class="p-1 border border-blue-600">
                                <button
                                    @click="edit(room.room_id)"
                                    class="p-2 mr-1 text-white bg-green-600 rounded-md"
                                >
                                    Edit
                                </button>
                                <button
                                    type="button"
                                    @click="onDelete(room.room_id)"
                                    class="p-2 text-white bg-red-600 rounded-md"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </App>
</template>
