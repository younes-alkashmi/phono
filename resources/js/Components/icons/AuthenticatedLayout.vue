<template>
    <div class="common-layout">
        <el-container>
            <el-header class="bg-white !m-0 !p-0 !min-h-max !h-max">
                <div class="bg-white py-5 w-[80%] mx-auto">
                    <div
                        class="flex flex-row justify-around items-center w-full"
                    >
                        <!-- logo -->
                        <figure>
                            <img
                                class="w-1/2"
                                src="/logos/primary_logo.png"
                                alt=""
                            />
                        </figure>
                        <!-- menu -->
                        <el-menu
                            class="el-menu-demo !border-0"
                            mode="horizontal"
                            menu-trigger="hover"
                        >
                            <el-sub-menu index="1">
                                <template #title>
                                    <div
                                        class="flex flex-col justify-center items-center text-white rounded-lg p-3 space-y-4 text-lg font-semibold bg-gradient-primary"
                                    >
                                        <el-icon class="!self-center">
                                            <span
                                                class="!self-center text-center w-full mx-auto text-2xl font-bold"
                                                ><dashboard-icon
                                            /></span>
                                        </el-icon>
                                        <span
                                            class="self-center leading-4"
                                            >Home</span
                                        >
                                    </div>
                                </template>
                            </el-sub-menu>
                            <el-sub-menu index="2">
                                <template #title>
                                    <div
                                        class="flex flex-col justify-center flex-shrink-0 space-y-4 text-lg font-semibold text-gray-900"
                                    >
                                        <el-icon class="self-center">
                                            <span
                                                class="text-2xl text-gray-400 font-bold"
                                                ><itemsIcon
                                            /></span>
                                        </el-icon>
                                        <span
                                            class="self-center leading-4 text-gray-700"
                                            >Pages</span
                                        >
                                    </div>
                                </template>
                            </el-sub-menu>
                            <el-sub-menu index="3">
                                <template #title>
                                    <div
                                        class="flex flex-col justify-center flex-shrink-0 space-y-4 text-lg font-semibold"
                                    >
                                        <el-icon class="self-center">
                                            <span
                                                class="text-2xl text-gray-400 font-bold"
                                                ><resourcesIcon
                                            /></span>
                                        </el-icon>
                                        <span
                                            class="self-center leading-4 text-gray-700"
                                            >Resources</span
                                        >
                                    </div>
                                </template>
                            </el-sub-menu>
                            <el-sub-menu index="4">
                                <template #title>
                                    <div
                                        class="flex flex-col justify-center flex-shrink-0 space-y-4 text-lg font-semibold"
                                    >
                                        <el-icon class="self-center">
                                            <span
                                                class="text-2xl text-gray-400 font-bold"
                                                ><settingIcon/></span>
                                        </el-icon>
                                        <span
                                            class="self-center leading-4 text-gray-700"
                                            >Settings</span
                                        >
                                    </div>
                                </template>
                            </el-sub-menu>
                            <el-sub-menu index="" popper-class="!text-gray-400"> </el-sub-menu>
                        </el-menu>
                        <!-- auth user -->
                        <div
                            class="flex flex-row space-x-2 border border-dashed rounded-lg border-gray-300 p-2 cursor-pointer"
                        >
                            <el-avatar src="/avatars/300-1.jpg"></el-avatar>
                            <span class="flex flex-col">
                                <span class="text-sm text-black font-semibold"
                                    >Marwan Mohamed</span
                                >
                                <span
                                    class="text-sm text-gray-400 font-semibold"
                                    >Marwan@gmail.com</span
                                >
                            </span>
                            <span class="self-center text-gray-400"><arrowDownIcon /></span>
                        </div>
                    </div>
                </div>
            </el-header>

            <el-container>
                <el-main>
                    <div class="w-[80%] mx-auto">
                        <slot></slot>
                    </div>
                </el-main>
            </el-container>
        </el-container>
    </div>
</template>

<script setup>
import dashboardIcon from "@/Components/icons/dashboardIcon.vue";
import itemsIcon from "@/Components/icons/itemsIcon.vue";
import resourcesIcon from "@/Components/icons/resourcesIcon.vue";
import arrowDownIcon from "@/Components/icons/arrowDownIcon.vue";
import settingIcon from '@/Components/icons/settingIcon.vue';
</script>

<style>
body {
    background-color: theme("colors.app-bg-light");
}

.el-sub-menu__icon-arrow {
    display: none;
}
</style>
