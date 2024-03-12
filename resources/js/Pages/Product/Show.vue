<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Layout from "@/Layouts/Layout.vue";
import { Head, usePage, useForm, Link } from "@inertiajs/vue3";
import { Rating, initTE, Datepicker, Input } from "tw-elements";
import { onMounted } from "vue";
import { ref } from "vue";
import { useToast } from "vue-toastification";

const toast = useToast();
const id = usePage().props.auth.user?.id;
const rate = ref(0);
const rate_id = ref(0);
const props = defineProps(["product"]);
const product = props.product;
const images = ref(product.product_images);

onMounted(() => {
    initTE({ Datepicker, Input, Rating }, { allowReinits: true });
    const icons = document.querySelectorAll(
        "#selected-value-example [data-te-rating-icon-ref]"
    );

    icons.forEach((el) => {
        el.addEventListener("onSelect.te.rating", (e) => {
            rate.value = e.value;
            console.log(rate.value);
        });
    });
});

if (id) {
    const oldRate = product.rates.filter((r) => r.user_id === id);
    rate.value = oldRate[0]?.rate;
    rate_id.value = oldRate[0]?.id;
}

const onRate = () => {
    if (id) {
        const form = useForm({
            user_id: id,
            product_id: product.id,
            rate: rate.value,
        });

        form.transform((data) => ({ ...data })).put(
            `/products/rate/${rate_id.value}`,
            {
                onSuccess: () => {
                    toast.success("تم إضافة تقييم");
                },
                onError: () => {
                    Object.values(page.props.errors).map((err) =>
                        toast.error(err)
                    );
                },
            }
        );
    } else toast.error("يجب تسجيل الدخول أولا لتقوم بعملية التقييم");
};
</script>

<template>
    <Head title="Product" />

    <Layout>
        <!-- component -->
        <body class="antialiased font-sans bg-gray-200">
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8 w-11/12 mx-auto">
                    <div
                        class="bg-slate-50 text-center text-lg"
                        v-if="!product"
                    >
                        لم يتم إيجاد المنتج
                    </div>
                    <div
                        class="my-2 flex sm:flex-row flex-col float-end w-40"
                        v-else
                    >
                        <!-- multiple images -->
                        <div class="grid md:gap-6 mt-2">
                            <div
                                class="flex flex-col gap-6 z-0 w-full mb-6 group"
                            >
                                <div
                                    class="p-2 rounded-xl bg-slate-50"
                                    v-for="image in images"
                                >
                                    <img :src="`/${image.image}`" />
                                </div>
                                <Link
                                    :href="`/products/compare/${product.id}`"
                                    class="flex justify-center items-center px-4 py-2 bg-[#38547a] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    >مقارنة</Link
                                >
                            </div>
                        </div>

                        <!-- images end -->

                        <div class="flex flex-row mb-1 sm:mb-0">
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                            ></div>
                            <div class="relative">
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                                ></div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto"
                    >
                        <div
                            class="inline-block min-w-full shadow rounded-lg overflow-hidden"
                        >
                            <table class="min-w-full leading-normal">
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
                                    <tr>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm"
                                        >
                                            <p
                                                class="text-gray-900 whitespace-no-wrap"
                                            >
                                                <PrimaryButton
                                                    @click="onRate"
                                                    :class="
                                                        !$page.props.auth.user
                                                            ?.id &&
                                                        ' touch-none'
                                                    "
                                                    >تقييم</PrimaryButton
                                                >
                                            </p>
                                        </td>
                                        <td
                                            class="px-5 py-5 border-b border-gray-200 text-right bg-white text-sm"
                                        >
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"
                                            >
                                                <span class="relative">
                                                    <ul
                                                        id="selected-value-example"
                                                        class="my-1 flex list-none flex-row-reverse gap-1 p-0"
                                                        data-te-rating-init
                                                    >
                                                        <li>
                                                            <span
                                                                class="text-primary [&>svg]:h-5 [&>svg]:w-5"
                                                                data-te-rating-icon-ref
                                                            >
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    :fill="
                                                                        rate > 0
                                                                            ? '#3b71ca'
                                                                            : 'none'
                                                                    "
                                                                    viewBox="0 0 24 24"
                                                                    stroke-width="1.5"
                                                                    stroke="currentColor"
                                                                >
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                                                                    />
                                                                </svg>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span
                                                                class="text-primary [&>svg]:h-5 [&>svg]:w-5"
                                                                data-te-rating-icon-ref
                                                            >
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    :fill="
                                                                        rate > 1
                                                                            ? '#3b71ca'
                                                                            : 'none'
                                                                    "
                                                                    viewBox="0 0 24 24"
                                                                    stroke-width="1.5"
                                                                    stroke="currentColor"
                                                                >
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                                                                    />
                                                                </svg>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span
                                                                class="text-primary [&>svg]:h-5 [&>svg]:w-5"
                                                                data-te-rating-icon-ref
                                                            >
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    :fill="
                                                                        rate > 2
                                                                            ? '#3b71ca'
                                                                            : 'none'
                                                                    "
                                                                    viewBox="0 0 24 24"
                                                                    stroke-width="1.5"
                                                                    stroke="currentColor"
                                                                >
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                                                                    />
                                                                </svg>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span
                                                                class="text-primary [&>svg]:h-5 [&>svg]:w-5"
                                                                data-te-rating-icon-ref
                                                            >
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    :fill="
                                                                        rate > 3
                                                                            ? '#3b71ca'
                                                                            : 'none'
                                                                    "
                                                                    viewBox="0 0 24 24"
                                                                    stroke-width="1.5"
                                                                    stroke="currentColor"
                                                                >
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                                                                    />
                                                                </svg>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span
                                                                class="text-primary [&>svg]:h-5 [&>svg]:w-5"
                                                                data-te-rating-icon-ref
                                                            >
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    :fill="
                                                                        rate > 4
                                                                            ? '#3b71ca'
                                                                            : 'none'
                                                                    "
                                                                    viewBox="0 0 24 24"
                                                                    stroke-width="1.5"
                                                                    stroke="currentColor"
                                                                >
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                                                                    />
                                                                </svg>
                                                            </span>
                                                        </li>
                                                    </ul>
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
