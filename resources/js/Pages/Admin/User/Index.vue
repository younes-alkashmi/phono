<template>
    <Layout>
        <!--Main layout-->
        <div
            class="py-12 h-full w-11/12 flex flex-col gap-4 text-right mx-auto"
        >
            <div
                class="flex justify-between items-center px-1 flex-row-reverse"
            >
                <h2 class="my-4 text-gray-500 dark:text-gray-400 font-bold">
                    قائمة المستخدمين
                </h2>
                <a
                    href="/admin/users/create"
                    class="inline-flex items-center px-4 py-2 bg-[#38547a] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#456591] focus:bg-gray-700 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    إضافة مستخدم</a
                >
            </div>
            <!-- <div class="flex flex-col gap-8 bg-white"> -->

            <div class="h-full">
                <!-- Table -->
                <div
                    class="w-full bg-white shadow-lg rounded-sm border border-gray-200"
                >
                    <div class="p-3">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead
                                    class="text-xs font-semibold uppercase text-gray-400 bg-gray-50"
                                >
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div
                                                class="font-semibold text-left"
                                            >
                                                الاسم
                                            </div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div
                                                class="font-semibold text-left"
                                            >
                                                البريد الإلكتروني
                                            </div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div
                                                class="font-semibold text-left"
                                            >
                                                الصفة
                                            </div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div
                                                class="font-semibold text-center"
                                            >
                                                العمليات
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100">
                                    <tr v-for="user in users" :key="user.id">
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"
                                                >
                                                    <img
                                                        class="rounded-full"
                                                        src="/images/avatar.png"
                                                        width="40"
                                                        height="40"
                                                        alt="Alex Shatov"
                                                    />
                                                </div>
                                                <div
                                                    class="font-medium text-gray-800"
                                                >
                                                    {{ user.name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">
                                                {{ user.email }}
                                            </div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div
                                                class="text-left font-medium capitalize"
                                            >
                                                {{ user.role }}
                                            </div>
                                        </td>
                                        <td class="p-4 whitespace-nowrap w-1/5">
                                            <div class="text-lg text-center">
                                                <Link
                                                    :href="`/admin/users/${user.id}`"
                                                    as="button"
                                                    class="inline-flex items-center px-3 py-2 bg-[#38547a] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#456591] focus:bg-gray-700 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                                    >تعديل
                                                </Link>
                                                <Link
                                                    as="button"
                                                    :href="`admin/users/${user.id}`"
                                                    class="inline-flex items-center mx-4 px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                                    >حذف
                                                </Link>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
        <!--Main layout-->
    </Layout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Layout from "@/Layouts/ModLayout.vue";

const props = defineProps(["users"]);
const users = props.users;
</script>
