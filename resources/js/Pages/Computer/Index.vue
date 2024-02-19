<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { ComputerType } from "@/types/computerType";
import { PaginateType } from "@/types/paginateType";
import { RoomType } from "@/types/room";
import { StatusType } from "@/types/status";
import { useForm, router } from "@inertiajs/vue3";
import { watch } from "vue";
import { throttle, pickBy } from "lodash";
import Swal from "sweetalert2";

const props = defineProps<{
    computers: PaginateType<ComputerType>;
    rooms: RoomType[];
    statuses: StatusType[];
    filters?: {
        keyword: string;
        room_id: string;
        status_id: number | null;
    };
}>();

const filterForm = useForm({
    keyword: props.filters?.keyword ?? "",
    room_id: props.filters?.room_id ?? "",
    status_id: props.filters?.status_id ?? null,
});

watch(
    () => filterForm.data(),
    throttle(() => {
        // console.log("log data");
        router.get(route("computer.index"), pickBy(filterForm.data()), {
            preserveState: true,
            only: ["computers"],
            replace: true,
        });
    }, 500),
);

const onClearFilter = () => {
    filterForm.keyword = "";
    filterForm.status_id = null;
    filterForm.room_id = "";
};

const onDelete = async (pcId: string) => {
    await Swal.fire({
        title: "Do you want to delete?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Delete",
        denyButtonText: `Cancel`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            router.delete(route("computer.destroy", pcId), {
                onSuccess: () => {
                    Swal.fire({
                        title: "Success",
                        text: "Computer has been deleted",
                        icon: "success",
                        toast: true,
                        timer: 3000,
                    });
                },
            });
        }
    });
};
</script>
<template>
    <App>
        <div class="p-3">
            <div class="mb-2">
                <h2 class="text-2xl font-bold">Computer Management</h2>
                <div class="mt-4">
                    <div
                        class="bg-base-100 p-2 rounded-xl flex gap-2 items-center"
                    >
                        <Link
                            :href="route('computer.create')"
                            class="btn btn-primary"
                            >New</Link
                        >
                        <input
                            v-model="filterForm.keyword"
                            type="text"
                            class="input input-primary w-full"
                            placeholder="Search..."
                        />
                        <select
                            v-model="filterForm.room_id"
                            class="select select-primary w-full"
                        >
                            <option value="">Select Room</option>
                            <option
                                v-for="(room, index) in rooms"
                                :key="index"
                                :value="room.room_id"
                            >
                                {{ room.name }}
                            </option>
                        </select>
                        <select
                            v-model="filterForm.status_id"
                            class="select select-primary w-full"
                        >
                            <option :value="null">Select Status</option>
                            <option
                                v-for="(status, index) in statuses"
                                :key="index"
                                :value="status.id"
                            >
                                {{ status.name }}
                            </option>
                        </select>
                        <button
                            class="btn btn-warning"
                            type="button"
                            @click="onClearFilter"
                        >
                            Clear
                        </button>
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
                            <td>{{ item.room?.name }}</td>
                            <td>{{ item.status?.name }}</td>
                            <td>
                                <Link
                                    :href="
                                        route('computer.edit', item.computer_id)
                                    "
                                    class="btn btn-warning mr-2"
                                >
                                    Edit
                                </Link>
                                <button
                                    type="button"
                                    @click="onDelete(item.computer_id)"
                                    class="btn btn-error"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-base-100 rounded-xl mt-2 flex justify-center p-2">
                <div class="join">
                    <Link
                        v-for="link in computers.links"
                        :href="link.url ?? '#'"
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
