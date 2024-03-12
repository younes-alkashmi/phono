<template>
    <AdminLayout>
        <!--Main layout-->
        <div
            class="py-12 h-full w-11/12 flex flex-col gap-4 text-right mx-auto"
        >
            <div
                class="flex justify-between items-center px-1 flex-row-reverse"
            >
                <h2 class="my-4 text-gray-500 dark:text-gray-400 font-bold">
                    قائمة الأخبار
                </h2>
                <a
                    href="/admin/news/create"
                    class="inline-flex items-center px-4 py-2 bg-[#38547a] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#456591] focus:bg-gray-700 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    إضافة خبر</a
                >
            </div>
            <div class="flex flex-col gap-8 bg-white">
                <table
                    class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                >
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                    >
                        <tr>
                            <th scope="col" class="px-16 py-3">
                                <span class="">صورة المنتج</span>
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                اسم المنتج
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                العمليات
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="anew in news"
                            :key="anew.id"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                        >
                            <td class="p-4">
                                <img
                                    :src="`/${anew.image}`"
                                    class="w-16 md:w-32 max-w-full max-h-full"
                                    alt="image"
                                />
                            </td>
                            <td
                                class="px-6 py-4 text-center font-semibold text-gray-900 dark:text-white"
                            >
                                {{ anew.title }}
                            </td>

                            <td class="text-center" style="z-index: 1000">
                                <Link
                                    :href="`/admin/news/${anew.id}`"
                                    as="button"
                                    style="z-index: 1100"
                                    class="inline-flex mx-2 items-center px-3 py-2 bg-[#38547a] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#456591] focus:bg-gray-700 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    >تعديل
                                </Link>
                                <Link
                                    as="button"
                                    :href="`/admin/news/${anew.id}`"
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    >حذف
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--Main layout-->
    </AdminLayout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/ModLayout.vue";

const props = defineProps(["news"]);
const news = props.news;
</script>
