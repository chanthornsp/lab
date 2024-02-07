<script setup lang="ts">
import App from "@/Layouts/App.vue";
</script>
<template>
    <App>
        <div class="p-3">
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
    </App>
</template>
