<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { home } from '@/routes';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>
<template>
    <div
        class="relative min-h-screen overflow-x-hidden bg-[#f4f4f5] text-[#18181b] antialiased selection:bg-[#FF4433]/20 selection:text-[#FF4433] dark:bg-[#0d0d0c] dark:text-[#EDEDEC] dark:selection:bg-[#FF4433]/30 dark:selection:text-white"
    >
        <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
            <div
                class="absolute -top-[40%] -left-[20%] h-[60%] w-[140%] rounded-full bg-gradient-to-br from-[#FF4433]/10 to-transparent blur-3xl sm:w-[80%] dark:hidden"
            ></div>
            <div
                class="absolute top-[20%] -right-[30%] h-[50%] w-[130%] rounded-full bg-gradient-to-br from-[#6366f1]/5 to-transparent blur-3xl sm:w-[70%] dark:hidden"
            ></div>
            <div
                class="absolute -top-[40%] -left-[20%] hidden h-[60%] w-[140%] rounded-full bg-gradient-to-br from-[#FF4433]/10 to-transparent blur-3xl sm:w-[80%] dark:block"
            ></div>
            <div
                class="absolute top-[20%] -right-[30%] hidden h-[50%] w-[130%] rounded-full bg-gradient-to-br from-[#ff6042]/5 to-transparent blur-3xl sm:w-[70%] dark:block"
            ></div>
        </div>

        <div class="relative z-10 flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="w-full max-w-sm">
                <div class="flex flex-col gap-8">
                    <div class="flex flex-col items-center gap-4">
                        <Link
                            :href="home()"
                            class="flex flex-col items-center gap-2 font-medium"
                        >
                            <div
                                class="mb-1 flex h-9 w-9 items-center justify-center rounded-md"
                            >
                                <AppLogoIcon
                                    class="size-9 fill-current text-[#FF4433]"
                                />
                            </div>
                            <span class="sr-only">{{ title }}</span>
                        </Link>
                        <div class="space-y-2 text-center">
                            <h1 class="text-2xl font-bold tracking-tight">{{ title }}</h1>
                            <p class="text-center text-sm text-[#52525b] dark:text-[#A1A09A]">
                                {{ description }}
                            </p>
                        </div>
                    </div>
                    <div class="w-full rounded-2xl border border-black/[0.08] bg-white/80 p-6 shadow-[0_20px_50px_rgba(0,0,0,0.06)] backdrop-blur-xl dark:border-[#3E3E3A]/60 dark:bg-[#111110] dark:shadow-[0_15px_50px_rgba(0,0,0,0.4)]">
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>