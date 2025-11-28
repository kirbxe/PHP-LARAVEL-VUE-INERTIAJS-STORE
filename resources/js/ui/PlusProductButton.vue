<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: String
})
</script>

<template>
    <Link method="patch" :href="href" class="svg-link">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
            <path d="M8 12H16M12 8V16" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" />
        </svg>
    </Link>
</template>

<style scoped>
.svg-link {
    color: #FF005A;     
    transition: color 0.3s ease;
}

.svg-link:hover {
    color: #CC0048; 
}
</style>