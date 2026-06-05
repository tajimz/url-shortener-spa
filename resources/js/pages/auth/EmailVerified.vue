<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { CheckCircle2 } from 'lucide-vue-next';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
</script>

<template>
    <Head title="Email Verified" />

    <div
        class="relative flex min-h-screen items-center justify-center overflow-x-hidden bg-[#f4f4f5] text-[#18181b] antialiased dark:bg-[#0d0d0c] dark:text-[#EDEDEC]"
    >
        <!-- Background Decor -->
        <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
            <div
                class="absolute -top-[20%] -left-[10%] h-[50%] w-[100%] rounded-full bg-gradient-to-br from-[#22c55e]/10 to-transparent blur-3xl dark:hidden"
            ></div>
            <div
                class="absolute -right-[10%] -bottom-[20%] h-[50%] w-[100%] rounded-full bg-gradient-to-br from-[#22c55e]/5 to-transparent blur-3xl dark:hidden"
            ></div>
        </div>

        <!-- Main Card -->
        <div class="relative z-10 w-full max-w-md px-6">
            <div
                class="rounded-3xl border border-black/[0.06] bg-white p-8 shadow-[0_4px_20px_rgba(0,0,0,0.04)] backdrop-blur-xl dark:border-[#3E3E3A]/40 dark:bg-[#111110]/80 dark:shadow-[0_15px_50px_rgba(0,0,0,0.4)]"
            >
                <!-- Icon -->
                <div
                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#22c55e]/10 text-[#22c55e]"
                >
                    <CheckCircle2 :size="32" stroke-width="2.5" />
                </div>

                <!-- Content -->
                <h1 class="mt-6 text-2xl font-bold tracking-tight text-neutral-900 dark:text-white">
                    Email Verified!
                </h1>
                <p
                    class="mt-3 text-sm leading-relaxed text-[#52525b] dark:text-[#A1A09A]"
                >
                    Your email address has been successfully verified. You can
                    now access all features of <strong>{{ appName }}</strong
                    >.
                </p>

                <!-- Action / Closing Message -->
                <div
                    class="mt-8 rounded-xl border border-[#22c55e]/20 bg-[#22c55e]/5 p-4 text-center dark:border-[#22c55e]/20 dark:bg-[#22c55e]/10"
                >
                    <p
                        class="text-xs font-semibold tracking-wider text-[#16a34a] uppercase dark:text-[#4ade80]"
                    >
                        You can safely close this page now.
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <p
                class="mt-8 text-center text-xs text-[#71717a] dark:text-[#52525b]"
            >
                &copy; 2026 {{ appName }}. All rights reserved.
            </p>
        </div>
    </div>
</template>