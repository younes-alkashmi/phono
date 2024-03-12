<script setup>
import Layout from "@/Layouts/ModLayout.vue";
import { ref } from "vue";
import { Head, useForm, router, Link } from "@inertiajs/vue3";
import { Plus } from "@element-plus/icons-vue";
import { useToast } from "vue-toastification";

const props = defineProps(["news"]);
const news = props.news;
const toast = useToast();
const images = ref([
    {
        url: `/${news.image}`,
        id: news.id,
        uid: Math.floor(Math.random() * 10000),
    },
]);

const form = useForm({
    title: news.title,
    desc: news.desc,
    user_name: news.user_name,
    image: "",
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
        `/admin/news/${news.id}`,
        form.transform((data) => ({ ...data })),
        {
            onSuccess: () => {
                toast.success("تم تعديل الخبر بنجاح");
            },
            onError: () => {
                Object.values(page.props.errors).map((err) => toast.error(err));
            },
        }
    );
};
</script>

<template>
    <Head title="News Edit" />

    <Layout>
        <div class="py-12 h-full flex flex-col gap-4 text-right">
            <div class="mx-auto w-4/5">
                <Link
                    class="inline-flex items-center px-6 py-2 bg-[#38547a] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#133e53] focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    :href="route('admin.news')"
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
                                rows="4"
                                v-model="form.desc"
                                class="block p-2.5 w-full text-right text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="  اكتب الخبر هنا"
                            ></textarea>
                        </div>
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
                            class="inline-flex items-center px-4 py-2 bg-[#38547a] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#133e53] focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
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
