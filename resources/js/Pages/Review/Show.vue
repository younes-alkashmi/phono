<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Head } from "@inertiajs/vue3";
import { Rating, initTE } from "tw-elements";
initTE({ Rating });

const props = defineProps(["review"]);
const review = props.review;
</script>

<template>
    <Head title="Reviews" />

    <Layout>
        <div class="py-12 h-full w-full flex flex-col gap-4 text-right">
            <div
                class="flex flex-col items-center gap-8 max-w-7xl py-6 mx-auto sm:px-6 lg:px-8 bg-white w-4/5"
            >
                <!-- start of article -->
                <div>حرر بتاريخ {{ review.created_at.slice(0, 10) }}</div>
                <div
                    class="flex flex-col items-center bg-white border-gray-200 rounded-lg shadow md:flex-row dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                >
                    <img
                        class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                        :src="`/${review.image}`"
                        alt=""
                    />
                    <div class="flex flex-col justify-between p-4">
                        <h5
                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                        >
                            {{ review.title }}
                        </h5>
                        <p
                            class="mb-3 font-normal text-gray-700 dark:text-gray-400"
                        >
                            {{ review.desc }}
                        </p>
                        <div class="flex justify-between">
                            <ul
                                class="my-1 flex list-none gap-1 p-0"
                                data-te-rating-init
                                data-te-readonly="false"
                                data-te-value="3"
                            >
                                <li v-for="rate in 5">
                                    <span
                                        class="[&>svg]:h-5 [&>svg]:w-5"
                                        :class="
                                            rate <= review.rate
                                                ? 'text-yellow-300'
                                                : 'text-gray-300'
                                        "
                                        data-te-rating-icon-ref
                                        :key="rate"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor"
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

                            <span class="text-stone-400">
                                حرر بـواسطـة {{ review.user_name }}</span
                            >
                        </div>
                    </div>
                </div>
                <!-- end of article -->
            </div>
        </div>
    </Layout>
</template>
