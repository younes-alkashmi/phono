<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { Rating, initTE } from "tw-elements";
initTE({ Rating });

const props = defineProps(["news"]);
const news = props.news;

console.log(news);
</script>

<template>
    <Head title="News" />

    <Layout>
        <div class="py-12 h-full w-full flex flex-col gap-4 text-right">
            <div
                class="flex flex-col items-center gap-8 max-w-7xl py-6 mx-auto sm:px-6 lg:px-8 bg-white w-4/5"
            >
                <!-- start of article -->
                <div>حرر بتاريخ {{ news.created_at.slice(0, 10) }}</div>
                <div
                    class="flex flex-col items-center bg-white border-gray-200 rounded-lg shadow md:flex-row dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                >
                    <img
                        class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                        :src="`/${news.image}`"
                        alt=""
                    />
                    <div class="flex flex-col justify-between p-4">
                        <h5
                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                        >
                            {{ news.title }}
                        </h5>
                        <p
                            class="mb-3 font-normal text-gray-700 dark:text-gray-400"
                        >
                            {{ news.desc }}
                        </p>
                        <div class="flex justify-end">
                            <span class="text-stone-400">
                                حرر بـواسطـة {{ news.user_name }}</span
                            >
                        </div>
                    </div>
                </div>
                <!-- end of article -->
            </div>
        </div>
    </Layout>
</template>
