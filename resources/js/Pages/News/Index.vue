<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { Rating, initTE } from "tw-elements";
initTE({ Rating });

const props = defineProps(["news"]);
const news = props.news;
</script>

<template>
    <Head title="News" />

    <Layout>
        <div class="py-12 h-full w-full flex flex-col gap-4 text-right">
            <div
                class="flex flex-col items-center gap-8 max-w-7xl py-6 mx-auto sm:px-6 lg:px-8 bg-white w-4/5"
            >
                <div class="text-center" v-if="news.length === 0">
                    لا يوجد اخبار
                </div>
                <!-- news list -->

                <Link
                    v-else
                    v-for="n in news"
                    :href="`/news/show/${n.id}`"
                    class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                >
                    <img
                        class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                        :src="n.image"
                        alt=""
                    />
                    <div class="flex flex-col justify-between p-4">
                        <h5
                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                        >
                            {{ n.title }}
                        </h5>
                        <p
                            class="mb-3 font-normal text-gray-700 dark:text-gray-400"
                        >
                            {{ n.desc.slice(0, 780) }}
                        </p>
                    </div>
                </Link>
            </div>
        </div>
    </Layout>
</template>
