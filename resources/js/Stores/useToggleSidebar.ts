import { defineStore } from "pinia";
import { ref } from "vue";

export const useToggleSidebar = defineStore("toggleSidebar", () => {
    const isOpen = ref(false);
    const toggle = () => {
        isOpen.value = !isOpen.value;
    };
    return {
        isOpen,
        toggle,
    };
});
