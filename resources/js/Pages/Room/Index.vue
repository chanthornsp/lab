<script setup>
import App from "@/Layouts/App.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <App>
        <div class="p-4">
            <h2 class="text-2xl font-bold">Room List</h2>
            <div class="my-2">
                <Link
                    href="/room/create"
                    class="p-2 text-white bg-blue-600 rounded-md"
                >
                    Add Room
                </Link>
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
                        <tr v-for="(room, index) in 10">
                            <td class="text-center border border-blue-600">
                                {{ index + 1 }}
                            </td>
                            <td class="border border-blue-600">G-101</td>
                            <td class="text-center border border-blue-600">
                                Active
                            </td>
                            <td class="p-1 border border-blue-600">
                                <button
                                    class="p-2 mr-1 text-white bg-green-600 rounded-md"
                                >
                                    Edit
                                </button>
                                <button
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
