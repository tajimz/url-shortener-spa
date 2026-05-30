<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

type Props = {
    className?: HTMLAttributes['class'];
};

defineProps<Props>();
</script>

<template>
    <div
        class="group flex h-9 w-9 items-center justify-center rounded-xl
               bg-[#FF4433]
               shadow-[0_6px_18px_rgba(255,68,51,0.35)]
               transition-transform duration-300 hover:scale-105"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            class="h-5 w-5 text-white drop-shadow-sm"
            fill="currentColor"
        >
            <path d="M13 2L3 14h7l-1 8 10-12h-7l1-8z" />
        </svg>
    </div>
</template>