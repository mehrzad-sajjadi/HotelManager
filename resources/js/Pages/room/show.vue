<template>
    <Head title="Room" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Room Detail
            </h2>
        </template>

        <div class="w-5/6 mx-auto my-16 border border-gray-500 rounded-lg">
            <div
                class="flex flex-row justify-between items-center w-full min-h-min bg-[#21252908] border-b-2"
            >
                <p class="px-4 m-2 text-base">
                    لیست وسایل اتاق {{ $page.props.room.number }}
                    طبقه
                    {{ $page.props.room.floor }}
                </p>
                <p class="px-4 m-2 text-base">
                    هزینه هر شب اقامت :
                    {{ $page.props.room.price }}
                    <img :src="$page.props.url" alt="" />
                </p>
                <div>
                    <Link
                        :href="route('room_index')"
                        as="button"
                        type="button"
                        class="h-8 px-4 m-2 text-sm duration-150 rounded focus:shadow-outline bg-[#ffc107] hover:bg-[#ffe607] text-black border border-[#ffc107] hover:border-transparent"
                    >
                        بازگشت
                    </Link>
                </div>
            </div>
            <ul>
                <li
                    v-for="(room_device, index) in room_devices"
                    :key="index"
                    class="flex flex-row justify-between w-full min-h-min py-4 px-4 border-b-2 border-neutral-100 items-center hover:bg-[#21252908]"
                >
                    <div class="content w-[20%] flex flex-row justify-between">
                        {{ room_device.device_name }}

                        <span class="mx-5">
                            تعداد :
                            {{ room_device.number }}
                        </span>
                    </div>
                    <div class="min-w-max px-5 flex flex-row justify-between">
                        <button
                            v-if="$page.props.auth.user.is_admin == 1"
                            @click="remove(room.id)"
                            class="h-8 px-4 m-2 flex items-center text-sm text-white duration-150 rounded-lg bg-red-600 border-red-600 border hover:border-black"
                            as="button"
                            type="button"
                        >
                            حذف
                            <TrashIcon class="size-5"></TrashIcon>
                        </button>
                    </div>
                </li>
            </ul>
        </div>
        <p
            class="flex flex-row justify-center text-xl text-center"
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
    room_devices: Object,
    room: Object,
    url: String,
});
</script>

<style></style>
