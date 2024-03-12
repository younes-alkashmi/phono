<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Layout from "@/Layouts/Layout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const toast = useToast();
const form = useForm({
    search: {
        os: "",
        brand: "",
        charger: "",
        storage: "",
        processor: "",
        ram: "",
        screen_size: "",
        rear_cam_no: 1,
        price_start: 100,
        price_end: 10000,
        battery: "",
        year: "",
    },
});

const onFind = () => {
    form.transform((data) => ({ ...data })).post("/products/phone-finder", {
        onSuccess: () => {},
        onError: () => {
            toast.error("لا يوجد منتج بهذه الموصفات حاليا.");
            // Object.values(page.props.errors).map((err) => toast.error(err));
        },
    });
};
</script>

<template>
    <Head title="Phone-Finder" />

    <Layout>
        <!-- component -->
        <body class="antialiased font-sans bg-gray-200">
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8 w-11/12 mx-auto">
                    <div class="my-2 flex sm:flex-row flex-col float-end w-40">
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
                            class="inline-block min-w-full rounded-lg overflow-hidden"
                        >
                            <!-- start form  -->

                            <form>
                                <div class="grid gap-6 mb-6 md:grid-cols-2">
                                    <div>
                                        <label
                                            for="os"
                                            class="block mb-2 text-sm text-right font-medium text-gray-900 dark:text-white"
                                            >نظام التشغيل</label
                                        >
                                        <input
                                            type="text"
                                            id="os"
                                            class="bg-gray-50 border text-right border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Android, IOS ..."
                                            v-model="form.search.os"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="brand"
                                            class="block text-right mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >الشركة المصنعة</label
                                        >
                                        <input
                                            type="text"
                                            id="brand"
                                            class="bg-gray-50 border text-right border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Apple, Samsung ..."
                                            v-model="form.search.brand"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="underline_select"
                                            class="flex justify-end"
                                            >الذاكرة المؤقتة</label
                                        >
                                        <select
                                            id="underline_select"
                                            class="block py-2.5 w-full mt-2 text-center rounded-md px-2 text-sm text-gray-500 bg-gray-50 border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                                            v-model="form.search.ram"
                                        >
                                            <option selected value="2GB">
                                                2GB Ram
                                            </option>
                                            <option value="4GB">4GB Ram</option>
                                            <option value="8GB">8GB Ram</option>
                                            <option value="12GB">
                                                12GB Ram
                                            </option>
                                            <option value="16GB">
                                                16GB Ram
                                            </option>
                                            <option value="24GB">
                                                24GB Ram
                                            </option>
                                        </select>
                                    </div>
                                    <div>
                                        <label
                                            for="battery"
                                            class="flex justify-end"
                                        >
                                            البطارية</label
                                        >
                                        <select
                                            id="battery"
                                            class="block py-2.5 w-full mt-2 text-center rounded-md px-2 text-sm text-gray-500 bg-gray-50 border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                                            v-model="form.search.battery"
                                        >
                                            <option value="2" selected>
                                                2500 mAh
                                            </option>
                                            <option value="3">3000 mAh</option>
                                            <option value="4">4000 mAh</option>
                                            <option value="5">5000 mAh</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label
                                            for="year"
                                            class="block mb-2 text-right text-sm font-medium text-gray-900 dark:text-white"
                                            >سنة التصنيع</label
                                        >
                                        <input
                                            type="text"
                                            id="year"
                                            class="bg-gray-50 border text-right border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="اكتب سنة إطلاق المنتج"
                                            v-model="form.search.year"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="camera"
                                            class="block mb-2 text-right text-sm font-medium text-gray-900 dark:text-white"
                                            >عدد الكاميرات</label
                                        >
                                        <input
                                            type="number"
                                            id="camera"
                                            min="1"
                                            max="5"
                                            class="bg-gray-50 text-center border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder=""
                                        />
                                    </div>
                                </div>

                                <div class="relative mb-10">
                                    <label
                                        for="labels-range-input"
                                        class="flex justify-end"
                                    >
                                        السعر من</label
                                    >
                                    <input
                                        id="labels-range-input"
                                        type="range"
                                        value="500"
                                        step="10"
                                        v-model="form.search.price_start"
                                        min="0"
                                        max="3000"
                                        class="w-full h-2 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                                    />
                                    <span
                                        class="text-sm text-gray-500 dark:text-gray-400 absolute start-0 -bottom-6"
                                        >0</span
                                    >
                                    <span
                                        class="text-sm text-gray-500 dark:text-gray-400 absolute start-1/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6"
                                        >1000</span
                                    >
                                    <span
                                        class="text-sm text-gray-500 dark:text-gray-400 absolute start-2/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6"
                                        >2000</span
                                    >
                                    <span
                                        class="text-sm text-gray-500 dark:text-gray-400 absolute end-0 -bottom-6"
                                        >3000</span
                                    >
                                </div>
                                <div class="relative mb-10">
                                    <label
                                        for="labels-range-input"
                                        class="flex justify-end"
                                    >
                                        إلى</label
                                    >
                                    <input
                                        id="labels-range-input"
                                        type="range"
                                        value="0"
                                        step="10"
                                        v-model="form.search.price_end"
                                        min="0"
                                        max="10000"
                                        class="w-full h-2 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                                    />
                                    <span
                                        class="text-sm text-gray-500 dark:text-gray-400 absolute start-0 -bottom-6"
                                        >0</span
                                    >
                                    <span
                                        class="text-sm text-gray-500 dark:text-gray-400 absolute start-1/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6"
                                        >3000</span
                                    >
                                    <span
                                        class="text-sm text-gray-500 dark:text-gray-400 absolute start-2/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6"
                                        >7000</span
                                    >
                                    <span
                                        class="text-sm text-gray-500 dark:text-gray-400 absolute end-0 -bottom-6"
                                        >10000</span
                                    >
                                </div>

                                <div class="grid gap-6 mb-6 md:grid-cols-2">
                                    <div>
                                        <label
                                            for="screen"
                                            class="flex justify-end"
                                            >حجم الشاشة</label
                                        >
                                        <select
                                            id="screen"
                                            class="block py-2.5 w-full mt-2 text-center rounded-md px-2 text-sm text-gray-500 bg-gray-50 border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                                            v-model="form.search.screen_size"
                                        >
                                            <option selected value="3">
                                                3 inches
                                            </option>
                                            <option selected value="4">
                                                4 inches
                                            </option>
                                            <option selected value="5">
                                                5 inches
                                            </option>
                                            <option selected value="6">
                                                6 inches
                                            </option>
                                            <option selected value="7">
                                                7 inches
                                            </option>
                                        </select>
                                    </div>
                                    <div>
                                        <label
                                            for="charger"
                                            class="flex justify-end"
                                        >
                                            سرعة الشحن</label
                                        >
                                        <select
                                            id="charger"
                                            class="block py-2.5 w-full mt-2 text-center rounded-md px-2 text-sm text-gray-500 bg-gray-50 border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                                            v-model="form.search.charger"
                                        >
                                            <option selected value="18">
                                                18W
                                            </option>
                                            <option selected value="20">
                                                20W
                                            </option>
                                            <option selected value="25">
                                                25W
                                            </option>
                                            <option selected value="45">
                                                45W
                                            </option>
                                            <option selected value="65">
                                                65W
                                            </option>
                                            <option selected value="120">
                                                120W
                                            </option>
                                        </select>
                                    </div>
                                    <div>
                                        <label
                                            for="storage"
                                            class="flex justify-end"
                                            >الذاكرة</label
                                        >
                                        <select
                                            id="storage"
                                            class="block py-2.5 w-full mt-2 text-center rounded-md px-2 text-sm text-gray-500 bg-gray-50 border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                                            v-model="form.search.storage"
                                        >
                                            <option selected value="32GB">
                                                32GB
                                            </option>
                                            <option selected value="64GB">
                                                64GB
                                            </option>
                                            <option selected value="128GB">
                                                128GB
                                            </option>
                                            <option selected value="256GB">
                                                256GB
                                            </option>
                                            <option selected value="512GB">
                                                512GB
                                            </option>
                                            <option selected value="1024GB">
                                                1024GB
                                            </option>
                                        </select>
                                    </div>
                                    <div>
                                        <label
                                            for="processor"
                                            class="flex justify-end"
                                        >
                                            نوع المعالج</label
                                        >
                                        <select
                                            id="processor"
                                            class="block py-2.5 w-full mt-2 text-center rounded-md px-2 text-sm text-gray-500 bg-gray-50 border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                                            v-model="form.search.processor"
                                        >
                                            <option selected value="Snapdragon">
                                                Snapdragon
                                            </option>
                                            <option selected value="Exynos">
                                                Exynos
                                            </option>
                                            <option selected value="Dimensity">
                                                Dimensity
                                            </option>
                                            <option selected value="Kirin">
                                                Kirin
                                            </option>
                                            <option selected value="A14">
                                                A14 Bionic
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex justify-end">
                                    <PrimaryButton
                                        class="text-white focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700"
                                        @click.prevent="onFind()"
                                    >
                                        إيجاد
                                    </PrimaryButton>
                                </div>
                            </form>

                            <!-- end form  -->
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </Layout>
</template>
