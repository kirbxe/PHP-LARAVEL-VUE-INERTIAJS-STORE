<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div v-if="$page.props.flash.success || $page.props.flash.error"  class="fixed flex justify-center inset-0 items-center z-50">
    <div class="w-[350px] flex flex-col h-[150px] top-1/2 right-auto mx-2 bg-white border-4 border-[#FF005A] rounded-lg text-white shadow-lg ">
        <div class="flex justify-end p-2">
            <Link
            as="button"
            @click="$page.props.flash.success = null; $page.props.flash.error = null"
            >
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 50 50">
            <path fill="#FF005A" d="M 7.71875 6.28125 L 6.28125 7.71875 L 23.5625 25 L 6.28125 42.28125 L 7.71875 43.71875 L 25 26.4375 L 42.28125 43.71875 L 43.71875 42.28125 L 26.4375 25 L 43.71875 7.71875 L 42.28125 6.28125 L 25 23.5625 Z"></path>
            </svg>
            </Link>
        </div>
        <div class="flex flex-col items-center w-full h-full">
            <div v-if="$page.props.flash.success" class="text-[20px] text-black text-center">
                {{ $page.props.flash.success }}
            </div>
            <div v-if="$page.props.flash.error" class="text-[20px] text-black text-center">
                {{ $page.props.flash.error }}
            </div>
        </div>
    </div>
    </div>
</template>
