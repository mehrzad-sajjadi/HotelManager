<template>
    <Head title="Room" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <h2
                    class="font-semibold dark:text-white text-xl text-gray-800 leading-tight"
                >
                    Device
                </h2>
                <div>
                    <Link
                        :href="route('device_create')"
                        as="button"
                        type="button"
                        class="h-8 px-4 m-2 text-sm duration-150 rounded focus:shadow-outline bg-[#6c757d] hover:bg-[#757b80] text-white border border-[#6c757d] hover:border-transparent"
                    >
                        ایجاد وسیله جدید
                    </Link>
                </div>
            </div>
        </template>
        <div class="w-5/6 mx-auto my-16 border border-gray-500 rounded-lg">
            <div
                class="flex flex-row justify-between items-center w-full min-h-min bg-[#21252908] border-b-2"
            >
                <p class="px-4 m-2 text-xl">لیست وسایل</p>
            </div>
            <ul>
                <li
                    v-for="(device, index) in devices"
                    :key="index"
                    class="flex flex-row justify-between w-full min-h-min py-4 px-4 border-b-2 border-neutral-100 items-center hover:bg-[#21252908]"
                >
                    <div class="content">
                        {{ device.name }}
                    </div>
                    <div class="min-w-max px-5 flex flex-row justify-between">
                        <button
                            @click="remove(device.id)"
                            class="h-8 px-4 m-2 flex items-center text-sm text-white duration-150 rounded-lg bg-red-600 border-red-600 border hover:border-black"
                            as="button"
                            type="button"
                        >
                            حذف
                            <TrashIcon class="size-5"></TrashIcon>
                        </button>

                        <Link
                            :href="route('device_edit', device.id)"
                            as="button"
                            type="button"
                            class="h-8 px-4 m-2 flex items-center text-sm transition-colors duration-150 rounded-lg focus:shadow-outline bg-white hover:bg-black text-black hover:text-white border border-black hover:border-transparent"
                        >
                            ویرایش
                            <PencilSquareIcon class="size-5"></PencilSquareIcon>
                        </Link>
                    </div>
                </li>
            </ul>
        </div>
        <p
            class="flex flex-row justify-center text-xl text-center pt-5"
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
import {
    TrashIcon,
    EyeIcon,
    PencilSquareIcon,
    PlusCircleIcon,
} from "@heroicons/vue/24/solid";
const props = defineProps({
    devices: Object,
});
function remove(id) {
    if (confirm("آیا از وسیله اتاق مطمئنید ؟")) {
        router.delete(route("device_delete", id));
    }
}

// if (usePage().props.crud.success) {
//     window.setTimeout(function () {
//         window.alert(usePage().props.crud.success);
//     }, 500);
// }
</script>

<style></style>
