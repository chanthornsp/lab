<script setup lang="ts">
import Header from "@/Layouts/Header.vue";
import Sidebar from "@/Layouts/Sidebar.vue";
import { Head } from "@inertiajs/vue3";
</script>
<template>
    <Head>
        <title>Dasboard</title>
    </Head>

    <div class="flex h-screen p-3 bg-blue-700 dark:bg-blue-900">
        <Sidebar />
        <div class="flex flex-col flex-1 overflow-hidden">
            <Header />
            <main
                id="full-screen-main"
                class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 dark:bg-slate-800 scroll-smooth rounded-b-2xl dark:text-white"
                scroll-region
            >
                <div>
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
