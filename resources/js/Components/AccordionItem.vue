<script setup>
import { NCollapse, NCollapseItem } from 'naive-ui';
const props = defineProps(
    {   
        title: String
    }
)
</script>

<template>
    <n-collapse>
        <n-collapse-item class="border-b p-2 text-[20px]" :title="props.title">
            <slot></slot>
        </n-collapse-item>
    </n-collapse>
</template>