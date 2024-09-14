<template>
    <Head title="Room" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Room
                </h2>
                <Link
                    :href="route('reserve_index')"
                    as="button"
                    type="button"
                    class="h-8 px-4 m-2 text-sm duration-150 rounded focus:shadow-outline bg-[#6c757d] hover:bg-[#757b80] text-white border border-[#6c757d] hover:border-transparent"
                    >صفحه اصلی</Link
                >
            </div>
        </template>

        <div class="w-5/6 mx-auto my-16 border border-gray-500 rounded-lg">
            <div
                class="flex flex-row justify-between items-center w-full min-h-min bg-[#21252908] border-b-2"
            >
                <p class="px-4 m-2 text-xl">لیست اتاق ها</p>
                <div>
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
            </div>
            <ul>
                <li
                    v-for="(room, index) in rooms"
                    :key="index"
                    class="flex flex-row justify-between w-full min-h-min py-4 px-4 border-b-2 border-neutral-100 items-center hover:bg-[#21252908]"
                >
                    <div class="content">
                        اتاق :
                        {{ room.number }}
                        طبقه :
                        {{ room.floor }}
                    </div>
                    <div class="min-w-max px-5 flex flex-row justify-between">
                        <Link
                            :href="route('room_show', room.id)"
                            as="button"
                            type="button"
                            class="h-8 px-4 flex items-center m-2 text-sm text-indigo-100 transition-colors duration-150 bg-blue-500 hover:bg-blue-600 rounded-lg focus:shadow-outline"
                        >
                            نمایش
                            <EyeIcon class="size-5"></EyeIcon>
                        </Link>
                        <button
                            v-if="$page.props.auth.user.is_admin == 1"
                            @click="addDevice(room.id)"
                            as="button"
                            type="button"
                            class="h-8 px-4 flex items-center m-2 text-sm transition-colors duration-150 bg-[#9dff00] hover:bg-[#11ff00] rounded-lg focus:shadow-outline"
                        >
                            اضافه کردن وسیله
                            <PlusCircleIcon class="size-5"></PlusCircleIcon>
                        </button>

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

                        <Link
                            v-if="$page.props.auth.user.is_admin == 1"
                            :href="route('room_edit', room.id)"
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
            class="flex flex-row justify-center text-xl text-center"
            v-if="$page.props.crud.success"
        >
            {{ $page.props.crud.success }}
        </p>
    </AuthenticatedLayout>
</template>

<script>
import { Link, router, usePage, Head, useForm } from "@inertiajs/vue3";
import Dashboard from "@/Pages/Dashboard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import {
    TrashIcon,
    EyeIcon,
    PencilSquareIcon,
    PlusCircleIcon,
} from "@heroicons/vue/24/solid";

export default {
    components: {
        Link,
        usePage,
        router,
        useForm,
        AuthenticatedLayout,
        Head,
        Dashboard,
        TrashIcon,
        EyeIcon,
        PlusCircleIcon,
        PencilSquareIcon,
    },
    props: {
        rooms: Object,
    },
    setup(props) {
        console.log("klsdjfljddklsj");
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

        return { remove, addDevice };
    },
};
</script>

<style></style>
