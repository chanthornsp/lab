<script setup lang="ts">
import { type PropType, ref } from "vue";
import { Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {
    Moon,
    Sun,
    Bell,
    ChevronRightSquare,
    ChevronLeftSquare,
} from "lucide-vue-next";

import { onMounted } from "vue";
import { useToggleSidebar } from "@/Stores/useToggleSidebar";
const sidebar = useToggleSidebar();

defineProps({
    breadcrumbs: {
        type: Array as PropType<
            {
                name: string;
                url: string;
            }[]
        >,
        required: false,
        default: () => [],
    },
});

const dropdownOpen = ref(false);

const appTheme = ref("light");

const toggleTheme = () => {
    if (appTheme.value === "light") {
        appTheme.value = "dark";
        document.documentElement.classList.add("dark");
        // set localStorage

        localStorage.setItem("theme", "dark");
    } else {
        appTheme.value = "light";
        document.documentElement.classList.remove("dark");
        // set localStorage
        localStorage.setItem("theme", "light");
    }
};

onMounted(() => {
    const theme = localStorage.getItem("theme");
    if (theme) {
        appTheme.value = theme;
        if (theme === "dark") {
            document.documentElement.classList.add("dark");
        }
    }
});
</script>
<template>
    <header
        class="flex items-center justify-between px-6 py-2 bg-white border-b-4 rounded-t-2xl border-primary dark:border-darkPrimary dark:bg-slate-900/75 dark:text-gray-100"
    >
        <div class="flex items-center">
            <button
                class="mr-2 text-gray-500 focus:outline-none lg:hidden"
                @click="sidebar.toggle"
            >
                <ChevronLeftSquare
                    v-if="sidebar.isOpen"
                    class="w-6 h-6 dark:text-gray-100"
                />
                <ChevronRightSquare v-else class="w-6 h-6 dark:text-gray-100" />
            </button>

            <div class="relative mx-4 lg:mx-0">
                <div class="max-w-3xl text-sm breadcrumbs">
                    <ul>
                        <li>
                            <Link href="#">Home</Link>
                        </li>
                        <li
                            v-for="(breadcrumb, index) in breadcrumbs"
                            :key="index"
                        >
                            <Link href="#">{{ breadcrumb.name }}</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="center-header"></div>

        <div class="flex items-center">
            <button
                class="flex mr-3 text-gray-600 transition-all duration-500 ease-in transform dark:text-gray-400"
                :class="appTheme === 'dark' ? 'rotate-[360deg]' : 'rotate-0'"
                @click="toggleTheme"
            >
                <Moon
                    v-if="appTheme === 'dark'"
                    class="w-6 dark:text-gray-100"
                />
                <Sun v-else class="w-6 h-6 dark:text-gray-100" />
            </button>
            <button
                class="flex mr-3 text-gray-600 focus:outline-none dark:text-gray-400"
            >
                <Bell class="w-6 h-6 dark:text-gray-100" />
            </button>
            <div class="relative">
                <button
                    class="relative z-10 block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none"
                    @click="dropdownOpen = !dropdownOpen"
                >
                    <!-- <img
                        :src="userAuth.profile_image"
                        class="object-cover w-full h-full"
                        alt="Your avatar"
                    /> -->
                    <ApplicationLogo class="object-cover w-full h-full" />
                </button>

                <div
                    v-show="dropdownOpen"
                    class="fixed inset-0 z-10 w-full h-full"
                    @click="dropdownOpen = false"
                ></div>

                <transition
                    enter-active-class="transition duration-150 ease-out transform"
                    enter-from-class="scale-95 opacity-0"
                    enter-to-class="scale-100 opacity-100"
                    leave-active-class="transition duration-150 ease-in transform"
                    leave-from-class="scale-100 opacity-100"
                    leave-to-class="scale-95 opacity-0"
                >
                    <div
                        v-show="dropdownOpen"
                        class="absolute right-0 z-30 w-48 py-2 mt-2 bg-white rounded-md shadow-xl dark:bg-slate-900/75"
                    >
                        <Link
                            href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white dark:text-gray-300"
                            >Profile
                        </Link>
                        <Link
                            href="#"
                            method="post"
                            as="button"
                            class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-primary hover:text-white dark:text-gray-100"
                        >
                            Log out
                        </Link>
                    </div>
                </transition>
            </div>
        </div>
    </header>
</template>
