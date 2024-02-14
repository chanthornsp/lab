<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { ComputerType } from "@/types/computerType";
import { PaginateType } from "@/types/paginateType";

defineProps<{
    computers: PaginateType<ComputerType>;
}>();
</script>
<template>
    <App>
        <div class="p-3">
            <div class="mb-2">
                <h2 class="text-2xl font-bold">Computer Management</h2>
                <div class="mt-4">
                    <div class="bg-base-100 p-2 rounded-xl">
                        <Link
                            :href="route('computer.create')"
                            class="btn btn-primary"
                            >New</Link
                        >
                    </div>
                </div>
            </div>
            <div class="bg-base-100 rounded-xl">
                <table class="table table-lg">
                    <thead>
                        <tr>
                            <th>Computer ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Room</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(item, index) in computers.data"
                            :key="index"
                        >
                            <td>{{ item.computer_id }}</td>
                            <td>{{ item.name.toUpperCase() }}</td>
                            <td>{{ item.description }}</td>
                            <td>{{ item.room_id }}</td>
                            <td>{{ item.status_id }}</td>
                            <td>
                                <Link
                                    :href="
                                        route('computer.edit', item.computer_id)
                                    "
                                    class="btn btn-warning mr-2"
                                >
                                    Edit
                                </Link>
                                <button class="btn btn-error">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-base-100 rounded-xl mt-2 flex justify-center p-2">
                <div class="join">
                    <Link
                        v-for="link in computers.links"
                        :href="link.url"
                        class="join-item btn"
                        :class="{ 'btn-primary': link.active }"
                    >
                        <span v-html="link.label"></span>
                    </Link>
                </div>
            </div>
        </div>
    </App>
</template>
