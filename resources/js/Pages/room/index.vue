<template>
    <Head title="Room" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <h2
                    class="font-semibold dark:text-white text-xl text-gray-800 leading-tight"
                >
                    Room
                </h2>

                <Link
                    v-if="$page.props.auth.user.is_admin == 1"
                    :href="route('room_create')"
                    as="button"
                    type="button"
                    class="h-8 px-4 m-2 text-sm duration-150 rounded focus:shadow-outline bg-[#FFFF00] hover:bg-[#FFFF00] text-black border border-transparent hover:border-black"
                >
                    ایجاد اتاق جدید
                </Link>
            </div>
        </template>
        <div class="flex justify-center">
            <Table :headers="header" :arrays="rooms"></Table>
        </div>

        <p
            class="flex flex-row justify-center text-xl text-center my-10"
            v-if="$page.props.crud.success"
        >
            {{ $page.props.crud.success }}
        </p>
    </AuthenticatedLayout>
</template>

<script setup>
import { Link, router, usePage, Head, useForm } from "@inertiajs/vue3";
import Dashboard from "@/Pages/Dashboard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Table from "@/Components/Table.vue";
import {
    TrashIcon,
    EyeIcon,
    PencilSquareIcon,
    PlusCircleIcon,
} from "@heroicons/vue/24/solid";

const props = defineProps({
    rooms: Object,
    header: Object,
});

console.log(props.countries);
function remove(id) {
    if (confirm("آیا از حذف اتاق مطمئنید ؟")) {
        router.delete(route("room_delete", id));
    }
}

if (usePage().props.crud.success) {
    window.setTimeout(function () {
        window.alert(usePage().props.crud.success);
    }, 500);
}

function addDevice(id) {
    router.get(route("device_room_create", id));
}
</script>
