<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Home" />

    <Layout>
        <div
            class="py-12 h-full flex flex-col text-center items-end gap-6"
            style="
                background-image: url('./images/phono-slider-1.png');
                height: 86.7vh;
                position: relative;
            "
        >
            <div
                class="flex flex-col gap-6 text-center text-white text-2xl font-bold mr-20 mt-40"
            >
                <span class="uppercase"> Phono App </span>
                <span>
                    هنا تجد أحدث الهواتف هنا تجد أحدث الهواتف هنا تجد أحدث
                    الهواتف</span
                >
                <span> تابعنا لترى كل جديد </span>
            </div>
            <div>
                <Link
                    :href="route('products.index')"
                    class="px-8 py-2 border rounded-xl bg-transparent text-white"
                    style="position: absolute; right: 25%"
                >
                    إضغط هنا
                </Link>
            </div>
        </div>
    </Layout>
</template>
