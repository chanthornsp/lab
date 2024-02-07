<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { useForm } from "@inertiajs/vue3";
import axios from "axios";
import Swal from "sweetalert2";
import { router } from "@inertiajs/vue3";

defineProps<{
    status: {
        id: number;
        name: string;
        description: string;
    }[];
}>();

const form = useForm({
    id: null,
    name: "",
    description: "",
});

// handle sumbit form

const onSumit = () => {
    form.post(route("status.store", form.id), {
        onSuccess: () => {
            form.reset();
            Swal.fire({
                title: "Success",
                icon: "success",
                toast: true,
                position: "top-end",
                timer: 3000,
                showConfirmButton: false,
            });
        },
    });
};

const onEdit = async (id: number) => {
    const { data } = await axios.get(route("status.edit", id));

    form.id = data.id;
    form.name = data.name;
    form.description = data.description;
};

const onDelete = (id: number) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route("status.destroy", id), {
                onSuccess: () => {
                    Swal.fire({
                        title: "Delete Successfully!!",
                        icon: "success",
                        toast: true,
                        position: "top-end",
                        timer: 3000,
                        showConfirmButton: false,
                    });
                },
            });
        }
    });
};
</script>
<template>
    <App>
        <div class="p-4">
            <h2 class="text-2xl">Status</h2>
            <form
                @submit.prevent="onSumit"
                class="p-2 bg-white dark:bg-gray-900 rounded-lg"
            >
                <div class="flex items-start gap-4">
                    <div class="flex-1">
                        <label class="label">Name</label>
                        <input
                            v-model="form.name"
                            type="text"
                            class="input input-primary w-full"
                        />
                        <label
                            class="label text-red-500 text-sm"
                            v-if="form.errors.name"
                        >
                            {{ form.errors.name }}
                        </label>
                    </div>
                    <div class="flex-1">
                        <label class="label">Description</label>
                        <textarea
                            v-model="form.description"
                            class="textarea textarea-primary w-full"
                        ></textarea>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            <div class="mt-4 bg-base-100 p-2 rounded-xl">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Descirption</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in status" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.description }}</td>
                            <td>
                                <button
                                    @click="onEdit(item.id)"
                                    class="btn btn-success btn-sm mr-2"
                                >
                                    Edit
                                </button>
                                <button
                                    @click="onDelete(item.id)"
                                    class="btn btn-error btn-sm"
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
