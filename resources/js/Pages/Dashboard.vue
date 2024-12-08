<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <h2
                    class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
                >
                    رزروهای شما
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
        <div class="flex justify-center">
            <Table :headers="header" :arrays="rooms"></Table>
        </div>

        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <ul>
                            <li
                                v-for="(room, index) in rooms"
                                :key="index"
                                class="flex flex-row justify-between w-full min-h-min py-4 px-4 border-b-2 border-neutral-100 items-center hover:bg-[#21252908]"
                            >
                                <div
                                    class="content flex flex-row w-[20%] justify-between"
                                >
                                    <div>
                                        اتاق شماره :
                                        {{ room.room_number }}
                                    </div>
                                    <div>
                                        طبقه :
                                        {{ room.room_floor }}
                                    </div>
                                </div>
                                <div
                                    class="content flex flex-row w-[35%] justify-between"
                                >
                                    <div>
                                        شروع رزرو :
                                        {{ room.start_shamsi }}
                                    </div>
                                    <div>
                                        پایان رزرو :
                                        {{ room.end_shamsi }}
                                    </div>
                                </div>

                                <div
                                    class="min-w-max px-5 flex flex-row justify-between"
                                >
                                    <Link
                                        :href="route('reserve.edit', room.id)"
                                        class="h-8 px-4 m-2 flex items-center text-sm transition-colors duration-150 rounded-lg focus:shadow-outline bg-white hover:bg-black text-black hover:text-white border border-black hover:border-transparent"
                                        as="button"
                                        type="button"
                                    >
                                        ویرایش رزرو
                                        <PencilSquareIcon
                                            class="size-5"
                                        ></PencilSquareIcon>
                                    </Link>

                                    <button
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
                        <p
                            class="flex flex-row justify-center text-xl text-center"
                            v-if="$page.props.crud.success"
                        >
                            {{ $page.props.crud.success }}
                        </p>
                    </div>
                </div>
            </div>
        </div> -->
    </AuthenticatedLayout>
</template>

<script setup>
import { Link, router, usePage, Head, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import "../../css/font.css";
import {
    TrashIcon,
    EyeIcon,
    PencilSquareIcon,
    PlusCircleIcon,
} from "@heroicons/vue/24/solid";
import Table from "@/Components/Table.vue";
const props = defineProps({
    rooms: Object,
    header: Object,
});
// function remove(id) {
//     if (confirm("آیا از حذف اتاق مطمئنید ؟")) {
//         router.delete(route("reserve_delete", id));
//     }
// }
</script>
