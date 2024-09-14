<template>
    <Head title="Create new Device" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Device
            </h2>
        </template>

        <div
            class="flex flex-col w-5/6 mx-auto my-16 border border-gray-500 rounded-lg"
        >
            <div
                class="flex flex-row items-center w-full min-h-min bg-[#21252908] border-b-2"
            >
                <p class="px-4 m-2 text-xl">ایجاد وسیله جدید</p>
            </div>
            <div class="flex flex-col justify-between">
                <div class="flex flex-col justify-start">
                    <div class="mb-5 py-2 px-2 w-full">
                        <label
                            class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                        >
                            نام وسیله
                        </label>
                        <input
                            v-model="form.name"
                            type="text"
                            class="block w-50 p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        />
                        <p v-if="$page.props.errors.name" class="text-red-600">
                            {{ $page.props.errors.name }}
                        </p>
                    </div>
                    <div class="flex flex-row justify-between p-2 w-full">
                        <div>
                            <p
                                v-if="$page.props.crud.errors"
                                class="text-red-600"
                            >
                                {{ $page.props.crud.errors }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-row justify-between mb-4">
                        <button
                            @click="submit"
                            type="button"
                            as="button"
                            class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-white hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-600 hover:border-transparent"
                        >
                            ایجاد وسیله
                        </button>
                        <Link
                            :href="route('device_index')"
                            type="submit"
                            as="button"
                            class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-[#ffc107] hover:bg-[#ffe607] text-black border border-[#ffc107] hover:border-transparent"
                        >
                            انصراف
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";
import Dashboard from "@/Pages/Dashboard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {
    components: {
        Head,
        useForm,
        Link,
        usePage,
        Dashboard,
        AuthenticatedLayout,
    },
    props: {
        errors: Object,
    },
    setup(props) {
        const form = useForm({
            name: "",
        });

        function submit() {
            form.post(route("device_store"), {});
        }
        return { submit, form };
    },
};
</script>

<style></style>
