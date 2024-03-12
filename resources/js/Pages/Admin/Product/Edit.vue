<script setup>
import Layout from "@/Layouts/Layout.vue";
import { ref } from "vue";
import { Head, useForm,usePage, router, Link } from "@inertiajs/vue3";
import { Plus } from "@element-plus/icons-vue";
import { useToast } from "vue-toastification";

const props = defineProps(["product"]);
const product = props.product;
const toast = useToast();
const page = usePage()
const images = ref(
    product.product_images.map((image) => {
        return {
            url: `/${image.image}`,
            id: image.id,
            uid: Math.floor(Math.random() * 10000),
        };
    })
);

const form = useForm({
    title: product.title,
    price: product.price,
    desc: product.desc,
    brand: product.brand,
    processor: product.processor,
    resolution: product.resolution,
    charger: product.charger,
    dimension: product.dimension,
    weight: product.weight,
    storage: product.storage,
    ram: product.ram,
    rear_cam: product.rear_cam,
    rear_cam_no: product.rear_cam_no,
    front_cam: product.front_cam,
    screen_size: product.screen_size,
    proximity: product.proximity,
    battery: product.battery,
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
    router.put(
        `/admin/products/${product.id}`,
        form.transform((data) => ({ ...data })),
        {
            onSuccess: () => {
                toast.success("تم تحديث المنتج بنجاح");
            },
            onError: () => {
                Object.values(page.props.errors).map((err) => toast.error(err));
            },
        }
    );
};

//end
</script>

<template>
    <Head title="Product" />

    <Layout>
        <div class="py-12 h-full flex flex-col gap-4 text-right">
            <div class="mx-auto w-4/5">
                <Link
                    class="inline-flex items-center px-6 py-2 bg-[#38547a] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#133e53] focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    :href="route('admin.products')"
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
                            >نوع الهاتف</label
                        >
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            type="text"
                            name="floating_price"
                            id="floating_price"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                            v-model="form.price"
                        />
                        <label
                            for="floating_price"
                            class="peer-focus:font-medium absolute right-1 text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                            >السعر</label
                        >
                    </div>

                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.resolution"
                            type="text"
                            name="resolution"
                            id="resolution"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                        />
                        <label
                            for="screen"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 right-1"
                            >دقة الشاشة</label
                        >
                    </div>

                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.processor"
                            type="text"
                            name="processor"
                            id="processor"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                        />
                        <label
                            for="processor"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 right-1"
                        >
                            المعالج</label
                        >
                    </div>

                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.charger"
                            type="text"
                            name="charger"
                            id="charger"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                        />
                        <label
                            for="charger"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 right-1"
                        >
                            سرعة الشحن</label
                        >
                    </div>

                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.dimension"
                            type="text"
                            name="dimension"
                            id="dimension"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                        />
                        <label
                            for="dimension"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 right-1"
                        >
                            أبعاد الهاتف</label
                        >
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.weight"
                            type="text"
                            name="weight"
                            id="weight"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                        />
                        <label
                            for="weight"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 right-1"
                        >
                            الوزن</label
                        >
                    </div>

                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.storage"
                            type="text"
                            name="storage"
                            id="storage"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                        />
                        <label
                            for="storage"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 right-1"
                        >
                            التخزين</label
                        >
                    </div>

                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.ram"
                            type="text"
                            name="ram"
                            id="ram"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                        />
                        <label
                            for="ram"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 right-1"
                        >
                            الذاكرة المؤقتة</label
                        >
                    </div>

                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.rear_cam"
                            type="text"
                            name="rear_cam"
                            id="rear_cam"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                        />
                        <label
                            for="rear_cam"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 right-1"
                        >
                            الكاميرا الخلفية</label
                        >
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.rear_cam_no"
                            type="text"
                            name="rear_cam_no"
                            id="rear_cam_no"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                        />
                        <label
                            for="rear_cam_no"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 right-1"
                        >
                            عدد الكاميرات الخلفية</label
                        >
                    </div>

                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.front_cam"
                            type="text"
                            name="front_cam"
                            id="front_cam"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                        />
                        <label
                            for="front_cam"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 right-1"
                            >الكاميرا الأمامية
                        </label>
                    </div>

                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.proximity"
                            type="text"
                            name="proximity"
                            id="proximity"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                        />
                        <label
                            for="proximity"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 right-1"
                        >
                            حساس التقارب</label
                        >
                    </div>

                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.battery"
                            type="text"
                            name="battery"
                            id="battery"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                        />
                        <label
                            for="battery"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 right-1"
                        >
                            البطارية</label
                        >
                    </div>

                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.screen_size"
                            type="text"
                            name="screen_size"
                            id="screen_size"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                        />
                        <label
                            for="screen_size"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 right-1"
                        >
                            حجم الشاشة</label
                        >
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.brand"
                            type="text"
                            name="brand"
                            id="brand"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" "
                            required
                        />
                        <label
                            for="brand"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 right-1"
                        >
                            الشركة المصنعة</label
                        >
                    </div>

                    <!-- <div>
                        <label
                            for="countries"
                            class="block mb-2 text-sm font-medium text-gray-900 right-1 dark:text-white text-right"
                        >
                            الشركة المصنعة</label
                        >
                        <select
                            id="countries"
                            v-model="brand_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            <option
                                v-for="brand in brands"
                                :key="brand.id"
                                :value="brand.id"
                            >
                                {{ brand.name }}
                            </option>
                        </select>
                    </div> -->

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
                                placeholder="اترك وصفا للمنتج"
                            ></textarea>
                        </div>
                    </div>
                    <!-- multiple images upload -->
                    <div class="grid md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                            <el-upload
                                v-model:file-list="images"
                                list-type="picture-card"
                                multiple
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
                    <!-- end -->

                    <!-- list of images for selected product -->

                    <!-- <div class="flex flex-nowrap mb-8">
                        <div
                            v-for="(pimage, index) in product_images"
                            :key="pimage.id"
                            class="relative w-32 h-32"
                        >
                            <img
                                class="w-24 h-20 rounded"
                                :src="`${pimage.url}`"
                                alt=""
                            />
                            <span
                                class="absolute top-0 right-8 transform -translate-y-1/2 w-3.5 h-3.5 bg-red-400 border-2 border-white dark:border-gray-800 rounded-full"
                            >
                                <span
                                    @click="deleteImage(pimage, index)"
                                    class="flex flex-col-reverse items-center justify-center text-white text-sm font-bold"
                                    >x</span
                                >
                            </span>
                        </div>
                    </div> -->

                    <!-- end -->

                    <div class="flex gap-4 justify-end">
                        <button
                            @click="onUpdate"
                            type="button"
                            class="text-white bg-[#38547a] hover:bg-[#133e53] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
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
