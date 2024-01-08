<script setup>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
import Sidebar from "./Sidebar.vue";
</script>
<template>
    <div>
        <Header />
    </div>
    <div class="flex gap-4">
        <div class="w-60 bg-red-200 shrink-0">
            <Sidebar />
        </div>
        <div class="w-full">
            <!-- main content -->
            <slot />
        </div>
    </div>

    <div>
        <Footer />
    </div>
</template>
