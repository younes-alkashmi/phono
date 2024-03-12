<script setup>
import Layout from "@/Layouts/ModLayout.vue";
import { ref } from "vue";
import { Head, useForm, usePage, Link } from "@inertiajs/vue3";
import { Plus } from "@element-plus/icons-vue";
import { useToast } from "vue-toastification";
import { Rating, initTE, Datepicker, Input } from "tw-elements";
import { onMounted } from "vue";

const props = defineProps(["user"]);
const user = props.user;
const toast = useToast();
const images = ref([]);

const form = useForm({
    name: user.name,
    email: user.email,
    password: '',
    role: user.role,
});

console.log(form.role)

const page = usePage();

const onUpdate = () => {
    form.transform((data) => ({ ...data })).put(`/admin/users/${user.id}`, {
        onSuccess: () => {
            toast.success("تم تحديث المستخدم");
        },
        onError: () => {
            Object.values(page.props.errors).map((err) => toast.error(err));
        },
    });
};
//end
</script>

<template>
    <Head title="User" />

    <Layout>
        <div class="py-12 h-full flex flex-col gap-4 text-right">
            <div class="mx-auto w-4/5">
                <Link
                    class="inline-flex items-center px-6 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    :href="route('admin.users')"
                    >رجوع</Link
                >
            </div>
            <div class="max-w-7xl py-6 mx-auto sm:px-6 lg:px-8 bg-white w-4/5">
                <form>
                    <div class="relative z-0 w-full mb-6 group">
                        <input
                            v-model="form.name"
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
                        >
                            الاسم
                        </label>
                    </div>

                    <div class="grid md:gap-6 mt-1">
                        <div class="relative z-0 w-full mb-6 group">
                            <label
                                for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-right mt-1"
                                >البريد الإلكتروني</label
                            >
                            <input
                                id="email"
                                rows="4"
                                v-model="form.email"
                                class="block p-2.5 w-full text-right text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="user@example.com"
                            ></input>
                        </div>
                    </div>

                    <div class="grid md:gap-6 mt-1">
                        <div class="relative z-0 w-full mb-6 group">
                            <label
                                for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-right mt-1"
                                > كلمة المرور</label
                            >
                            <input
                                id="password"
                                rows="4"
                                type="password"
                                v-model="form.password"
                                class="block p-2.5 w-full text-right text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder=""
                            ></input>
                        </div>
                    </div>



                    <div class="grid md:gap-4 mt-1 mb-4">
                        <select v-model="form.role" class="text-center">
                            <option value="admin">Admin</option>
                            <option value="moderator">Moderator</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <button
                        @click="onUpdate"
                        type="button"
                        class="inline-flex items-center px-6 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        تحديث
                    </button>
                </form>

            </div>
        </div>
    </Layout>
</template>
<style scoped>
input {
    text-align: right;
}
</style>
