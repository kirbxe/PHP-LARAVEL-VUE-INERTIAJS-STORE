<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps(
    {
        href: {
            type: String,
            required: true
        }
    }
)
</script>
<template>
<Link
    :href= "props.href"
>
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd"
            d="M15.2072 19.7071C15.5977 19.3166 15.5977 18.6834 15.2072 18.2929L8.9143 12L15.2072 5.70711C15.5977 5.31658 15.5977 4.68342 15.2072 4.29289C14.8167 3.90237 14.1835 3.90237 13.793 4.29289L6.90611 11.1798L6.90333 11.1825C6.89 11.1957 6.84526 11.2401 6.8054 11.2871C6.75442 11.3471 6.65609 11.4731 6.59534 11.6601C6.52356 11.881 6.52356 12.119 6.59534 12.3399C6.65609 12.5269 6.75442 12.6529 6.8054 12.7129C6.84527 12.7599 6.89 12.8043 6.90333 12.8175L6.90611 12.8202L13.793 19.7071C14.1835 20.0976 14.8167 20.0976 15.2072 19.7071Z"
            fill="currentColor">
        </path>
    </svg>
</Link>
    </template>