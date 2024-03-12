<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { Rating, initTE } from "tw-elements";
import eyeIcon from "@/Components/icons/eyeIcon.vue";
import comment from "@/Components/icons/comment.vue";
import { ref, reactive } from "vue";
import { FwbModal } from "flowbite-vue";
import { useToast } from "vue-toastification";

const isShowModal = ref(false);
const comments = ref([]);

function closeModal() {
    isShowModal.value = false;
}

function showModal(product_coms, id) {
    isShowModal.value = true;
    comments.value = product_coms;
    form.product_id = id;
}

initTE({ Rating });

const props = defineProps(["products"]);
const rates = [];
const products = props.products;
const page = usePage();
const toast = useToast();
const form = useForm({
    product_id: "",
    user_id: "",
    user_name: "",
    content: "",
});

const calcRate = (rates) => {
    return (
        rates.reduce((acc, curr) => acc + Number(curr.rate), 0) /
            rates.length || rates.length
    );
};

products.map((p) => {
    rates.push(calcRate(p.rates));
});

const state = reactive({
    word: "",
});

const search = () => {
    const routeName = "products.index";
    const params = { search: state.word };
    const url = window.route(routeName, params);
    window.location.replace(url);
};

const onComment = () => {
    const user = page.props.auth.user;
    if (!user?.id) {
        toast.error("للتعليق يجب تسجيل الدخول أولا");
        return;
    }

    form.user_id = user.id;
    form.user_name = user.name;

    form.transform((data) => ({ ...data })).post("products/comments", {
        onSuccess: () => {
            toast.success("تم إضافة تعليق على المنتج");
        },
        onError: () => {
            toast.error("!حدث خطأ أثناء التعليق");
        },
    });

    form.get("products");
};
</script>

<template>
    <Head title="Products" />

    <Layout>
        <div class="py-12 h-full flex flex-col gap-4 text-right">
            <div v-if="products.length !== 0" class="">
                <form class="max-w-md mx-auto">
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
                            class="block mx-auto w-11/12 text-right p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:border-[#38547a] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder=". . . اكتب للبحث"
                            required
                            v-model="state.word"
                            @keyup="search"
                        />
                        <!-- <button
                            type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            Search
                        </button> -->
                    </div>
                </form>
            </div>
            <div
                class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8 max-w-7xl py-6 mx-auto sm:px-6 lg:px-8 bg-white w-4/5"
            >
                <div class="flex justify-center" v-if="products.length === 0">
                    <span>لا يوجد منتجات</span>
                </div>
                <!-- Products list -->
                <div
                    v-else
                    v-for="(product, idx) in products"
                    class="w-full flex flex-col max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                >
                    <div>
                        <img
                            class="p-8 rounded-t-lg mx-auto"
                            style="width: 250px; height: 300px"
                            :src="
                                product.product_images.length > 0
                                    ? `/${product.product_images[0].image}`
                                    : 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png'
                            "
                            alt="product image"
                        />
                    </div>
                    <div class="px-5 pb-5 text-center">
                        <a href="#">
                            <h5
                                class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white"
                            >
                                {{ product.title }}
                            </h5>
                        </a>
                        <div class="flex items-center mt-2.5 mb-5">
                            <ul
                                class="my-1 flex list-none gap-1 p-0"
                                data-te-rating-init
                                data-te-readonly="false"
                                data-te-value="3"
                            >
                                <li v-for="i in 5">
                                    <span
                                        class="[&>svg]:h-5 [&>svg]:w-5"
                                        :class="
                                            i <= rates[idx]
                                                ? 'text-yellow-300'
                                                : 'text-gray-300'
                                        "
                                        data-te-rating-icon-ref
                                        :key="i.id"
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
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3"
                                >{{ rates[idx] }}</span
                            >

                            <!-- end of rate -->
                        </div>
                        <div class="flex items-center justify-center gap-6">
                            <span
                                class="text-xl font-bold text-gray-900 dark:text-white"
                                >LYD-{{ product.price }}</span
                            >
                            <span class="cursor-pointer">
                                <comment
                                    @click="
                                        showModal(product.comments, product.id)
                                    "
                                />
                            </span>
                            <Link :href="`/products/show/${product.id}`">
                                <eye-icon />
                            </Link>
                        </div>
                    </div>
                </div>
                <!--  modal-->
                <fwb-modal v-if="isShowModal" @close="closeModal">
                    <template #body>
                        <!-- component -->
                        <div
                            v-for="comment in comments"
                            class="flex justify-center relative top-1/3"
                        >
                            <!-- This is an example component -->
                            <div
                                class="relative grid grid-cols-1 gap-4 p-4 mb-8 border rounded-lg bg-white shadow-lg"
                            >
                                <div class="relative flex gap-4">
                                    <img
                                        src="https://icons.iconarchive.com/icons/diversity-avatars/avatars/256/charlie-chaplin-icon.png"
                                        class="relative rounded-lg -top-8 -mb-4 bg-white border h-20 w-20"
                                        alt=""
                                        loading="lazy"
                                    />
                                    <div class="flex flex-col w-full">
                                        <div
                                            class="flex flex-row justify-between"
                                        >
                                            <p
                                                class="relative text-xl whitespace-nowrap truncate overflow-hidden"
                                            >
                                                {{ comment.user_name }}
                                            </p>
                                            <a
                                                class="text-gray-500 text-xl"
                                                href="#"
                                                ><i
                                                    class="fa-solid fa-trash"
                                                ></i
                                            ></a>
                                        </div>
                                        <p class="text-gray-400 text-sm">
                                            {{
                                                comment.created_at.slice(0, 10)
                                            }}

                                            <span class="mx-1"></span>
                                            {{
                                                comment.created_at.slice(11, 19)
                                            }}
                                        </p>
                                    </div>
                                </div>
                                <p
                                    class="-mt-4 text-gray-500"
                                    style="direction: rtl"
                                >
                                    {{ comment.content }}
                                </p>
                            </div>
                        </div>
                    </template>
                    <template #footer>
                        <!-- comment form start -->

                        <form
                            class="w-full max-w-xl bg-white rounded-lg px-4 pt-2"
                        >
                            <div class="w-full md:w-full px-3 mb-2 mt-2">
                                <textarea
                                    class="bg-gray-100 text-right rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:border-[#38547a] focus:bg-white"
                                    name="body"
                                    placeholder="أكتب تعليقك..."
                                    style="direction: rtl"
                                    required
                                    v-model="form.content"
                                ></textarea>
                            </div>
                            <div class="w-full flex items-start md:w-full px-3">
                                <div
                                    class="flex items-start w-1/2 text-gray-700 px-2 mr-auto"
                                ></div>
                                <div class="-mr-1">
                                    <input
                                        @click="onComment"
                                        type="button"
                                        class="bg-white text-gray-700 cursor-pointer font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:text-white hover:bg-[#38547a]"
                                        value="إضافة تعليق"
                                    />
                                </div>
                            </div>
                        </form>

                        <!-- <div class="flex justify-between">
                            <fwb-button @click="closeModal" color="alternative">
                                Decline
                            </fwb-button>
                            <fwb-button @click="closeModal" color="green">
                                I accept
                            </fwb-button>
                        </div> -->
                    </template>
                </fwb-modal>
                <!--  modal-->
            </div>
        </div>
    </Layout>
</template>
