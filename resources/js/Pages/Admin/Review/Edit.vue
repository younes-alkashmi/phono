<script setup>
import Layout from "@/Layouts/ModLayout.vue";
import { ref } from "vue";
import { Head, useForm, router, Link } from "@inertiajs/vue3";
import { Plus } from "@element-plus/icons-vue";
import { useToast } from "vue-toastification";
import { onMounted } from "vue";
import { Rating, initTE, Datepicker, Input } from "tw-elements";

const props = defineProps(["review"]);
const review = props.review;
const toast = useToast();
const rate = ref(review.rate);
const images = ref([
    {
        url: `/${review.image}`,
        id: review.id,
        uid: Math.floor(Math.random() * 10000),
    },
]);

const form = useForm({
    title: review.title,
    desc: review.desc,
    user_name: review.user_name,
    image: "",
    rate: review.rate,
});

onMounted(() => {
    initTE({ Datepicker, Input, Rating }, { allowReinits: true });
    const icons = document.querySelectorAll(
        "#selected-value-example [data-te-rating-icon-ref]"
    );

    icons.forEach((el) => {
        el.addEventListener("onSelect.te.rating", (e) => {
            form.rate = e.value;
            rate.value = e.value;
        });
    });
});

const dialogImageUrl = ref("");
const dialogVisible = ref(false);

const handlePictureCardPreview = (file) => {
    dialogImageUrl.value = file.url;
    dialogVisible.value = true;
};

const handleFileChange = (file) => {
    images.value.push(file);
};

const handleRemove = (file) => {
    console.log(file);
};

const onUpdate = () => {
    form.image = images.value[0].raw;
    router.put(
        `/admin/reviews/${review.id}`,
        form.transform((data) => ({ ...data })),
        {
            onSuccess: () => {
                toast.success("تم التعديل بنجاح");
            },
            onError: () => {
                Object.values(page.props.errors).map((err) => toast.error(err));
            },
        }
    );
};
</script>

<template>
    <Head title="Reviews Edit" />

    <Layout>
        <div class="py-12 h-full flex flex-col gap-4 text-right">
            <div class="mx-auto w-4/5">
                <Link
                    class="inline-flex items-center px-6 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    :href="route('admin.reviews')"
                    >رجوع</Link
                >
            </div>
            <div class="max-w-7xl py-6 mx-auto sm:px-6 lg:px-8 bg-white w-4/5">
                <form>
                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.title"
                            type="text"
                            name="floating_title"
                            id="floating_title"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                        />
                        <label
                            for="floating_title"
                            class="peer-focus:font-medium absolute right-1 text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                            >العنوان
                        </label>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            type="text"
                            name="floating_price"
                            id="floating_price"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                            v-model="form.user_name"
                        />
                        <label
                            for="floating_price"
                            class="peer-focus:font-medium absolute right-1 text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                            >اسم الناشر</label
                        >
                    </div>

                    <div class="grid md:gap-6 mt-1">
                        <div class="relative z-0 w-full mb-6 group">
                            <label
                                for="message"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-right mt-1"
                                >الوصف</label
                            >
                            <textarea
                                id="message"
                                rows="8"
                                v-model="form.desc"
                                class="block p-2.5 w-full text-right text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="اكتب الوصف..."
                            ></textarea>
                        </div>
                    </div>

                    <div>
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
                                                rate > 0 ? '#3b71ca' : 'none'
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
                                                rate > 1 ? '#3b71ca' : 'none'
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
                                                rate > 2 ? '#3b71ca' : 'none'
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
                                                rate > 3 ? '#3b71ca' : 'none'
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
                                                rate > 4 ? '#3b71ca' : 'none'
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
                    </div>

                    <!--  image upload -->
                    <div class="grid md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                            <el-upload
                                v-model:file-list="images"
                                list-type="picture-card"
                                :on-preview="handlePictureCardPreview"
                                :on-remove="handleRemove"
                                :on-change="handleFileChange"
                                :auto-upload="false"
                            >
                                <el-icon>
                                    <Plus />
                                </el-icon>
                            </el-upload>
                        </div>
                    </div>

                    <div class="flex gap-4 justify-end">
                        <button
                            @click="onUpdate"
                            type="button"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        >
                            تحديث
                        </button>
                    </div>
                </form>
                <el-dialog v-model="dialogVisible" width="30%">
                    <img
                        class="w-full h-full rounded"
                        :src="`${dialogImageUrl}`"
                        alt=""
                    />
                </el-dialog>
            </div>
        </div>
    </Layout>
</template>
<style scoped>
input {
    text-align: right;
}
</style>
