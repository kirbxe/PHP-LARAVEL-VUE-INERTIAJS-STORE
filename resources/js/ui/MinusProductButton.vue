<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: String
})
</script>

<template>
   <Link
    method="patch" 
    :href="href"
    class="svg-link"
   > 
     <svg width="36" height="36" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <circle cx="12" cy="12" r="10" />
        <path d="M8 12H16" stroke="#ffffff" stroke-width="2" stroke-linecap="round" />
    </svg>  
   </Link>
</template>

<style scoped>
   .svg-link {
    color: #FF005A;     
    transition: all;
}

.svg-link:hover {
    color: #CC0048; 
}
</style>
