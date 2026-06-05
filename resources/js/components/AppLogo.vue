<script setup lang="ts">
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
</script>
<template>
    <div
        class="group flex cursor-pointer items-center gap-3 rounded-xl p-2 transition-all duration-300 hover:bg-[#FF4433]/5"
    >
        <div
            class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#FF4433] text-white shadow-[0_4px_12px_rgba(255,68,51,0.25)] transition-transform duration-300 group-hover:scale-105"
        >
            <span class="text-lg">⚡</span>
        </div>

        <div class="grid flex-1 text-left text-sm leading-none">
            <span class="font-bold tracking-tight text-[#18181b] dark:text-[#EDEDEC]">
                {{ appName }}
            </span>
            <span class="mt-1 text-[11px] font-medium text-[#71717a] dark:text-[#A1A09A]">
                Internal Dashboard
            </span>
        </div>
    </div>
</template>