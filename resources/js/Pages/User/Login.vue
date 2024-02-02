<script setup lang="ts">
import { ref } from "vue";
// import { router } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

// defineProps({
//     errors: {
//         type: Object,
//     },
// });

// const form = ref({
//     email: "",
//     password: "",
//     remember: false,
// });

// function submit(e) {
//     e.preventDefault();
//     router.post("/login", form.value);
// }

const form = useForm({
    email: "",
    password: "",
    remember: false,
});
</script>

<template>
    <div class="flex items-center justify-center h-screen bg-gray-200">
        <form
            @submit.prevent="form.post(route('login'))"
            class="p-4 space-y-3 bg-white shadow-md rounded-xl w-96"
        >
            <div>
                <label class="label">Email</label>
                <input
                    v-model="form.email"
                    class="w-full input input-primary"
                    type="email"
                />
                <div class="text-red-600" v-if="form.errors.email">
                    {{ form.errors.email }}
                </div>
            </div>
            <div>
                <label class="label">Password</label>
                <input
                    v-model="form.password"
                    class="w-full input input-primary"
                    type="password"
                />
                <div class="text-red-600" v-if="form.errors.email">
                    {{ form.errors.password }}
                </div>
            </div>
            <div>
                <label class="flex justify-start gap-2 label">
                    <input
                        v-model="form.remember"
                        class="checkbox checkbox-primary"
                        type="checkbox"
                    />
                    Remeber me
                </label>
                <div class="text-red-600" v-if="form.errors.email">
                    {{ form.errors.remember }}
                </div>
            </div>
            <div class="flex items-center justify-end gap-3">
                <a class="link link-primary" href="#">Forgot password?</a>
                <button class="btn btn-primary" type="submit">Log in</button>
            </div>
        </form>
    </div>
</template>
