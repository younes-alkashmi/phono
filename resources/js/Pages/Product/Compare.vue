<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Layout from "@/Layouts/Layout.vue";
import { Head, usePage, useForm } from "@inertiajs/vue3";
import { Rating, initTE, Datepicker, Input } from "tw-elements";
import { ref, reactive } from "vue";
import { useToast } from "vue-toastification";

const toast = useToast();
const props = defineProps(["product", "compared"]);
const product = props.product;
const productImg = ref(product.product_images[0]);
const compared = props.compared;
const comparedImg = ref(compared.product_images[0]);

const state = reactive({
    word: "",
});

const search = () => {
    const routeName = "products.compare";
    const params = { search: state.word, id: product.id };
    const url = window.route(routeName, params);
    window.location.replace(url);
};
</script>

<template>
    <Head title="Product" />

    <Layout>
        <!-- component -->
        <body class="antialiased font-sans bg-gray-200">
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8 mx-auto">
                    <div
                        class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto"
                    >
                        <div
                            class="mb-4 ml-2 w-1/2 flex justify-center items-center"
                        >
                            <form class="max-w-md">
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 start-4 flex items-center ps-3 pointer-events-none"
                                    >
                                        <svg
                                            class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                stroke="currentColor"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                                            />
                                        </svg>
                                    </div>
                                    <input
                                        type="search"
                                        id="default-search"
                                        class="mx-auto w-11/12 text-right ml-3 p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:border-[#38547a] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder=". . . اكتب للبحث"
                                        required
                                        v-model="state.word"
                                    />
                                </div>
                            </form>
                            <PrimaryButton @click="search"> بحث </PrimaryButton>
                        </div>

                        <div
                            class="flex justify-center gap-8 rounded-lg overflow-hidden"
                        >
                            <table class="leading-normal">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                        >
                                            الوصف
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                        >
                                            الخاصية
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap flex justify-end max-w-48"
                                            >
                                                <img
                                                    :src="`/${comparedImg.image}`"
                                                    alt="صورة المنتج"
                                                />
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative"
                                                    >صورة الهاتف</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.title }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative"
                                                    >نوع الهاتف</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.price }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    السعر</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.os }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    نظام التشغيل</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.resolution }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    دقة الشاشة</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.processor }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    المعالج</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.dimension }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative"
                                                    >أبعاد الهاتف
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.charger }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    سرعة الشحن</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.weight }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    الوزن
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.storage }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    التخزين
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.ram }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    الذاكرة المؤقتة
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.rear_cam }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    الكاميرات الخلفية
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.rear_cam_no }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    عدد الكاميرات الخلفية</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.front_cam }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    الكاميرا الأمامية
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.proximity }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    حساس التقارب
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.battery }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    البطارية
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.screen_size }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    حجم الشاشة
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ compared.brand }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    الشركة المصنعة
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="leading-normal">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                        >
                                            الوصف
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                        >
                                            الخاصية
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap flex justify-end max-w-48"
                                            >
                                                <img
                                                    :src="`/${productImg.image}`"
                                                />
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative"
                                                    >صورة الهاتف</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.title }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative"
                                                    >نوع الهاتف</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.price }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    السعر</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.os }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    نظام التشغيل</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.resolution }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    دقة الشاشة</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.processor }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    المعالج</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.dimension }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative"
                                                    >أبعاد الهاتف
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.charger }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    سرعة الشحن</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.weight }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    الوزن
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.storage }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    التخزين
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.ram }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    الذاكرة المؤقتة
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.rear_cam }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    الكاميرات الخلفية
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.rear_cam_no }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    عدد الكاميرات الخلفية</span
                                                >
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.front_cam }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    الكاميرا الأمامية
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.proximity }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    حساس التقارب
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.battery }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    البطارية
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.screen_size }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    حجم الشاشة
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                {{ product.brand }}
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    الشركة المصنعة
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </Layout>
</template>
