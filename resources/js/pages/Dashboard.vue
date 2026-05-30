<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard } from '@/routes';

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Dashboard', href: dashboard() }],
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <div class="flex h-full flex-col gap-8 p-6 sm:p-12">
        <!-- Header: The "Command" Area -->
        <div
            class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center"
        >
            <div>
                <h1 class="text-3xl font-bold tracking-tight">Dashboard</h1>
                <p class="mt-1 text-sm text-[#71717a]">
                    Manage your shortened links and traffic.
                </p>
            </div>

            <Link
                href="/create"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#FF4433] px-6 py-3 font-semibold text-white transition-all hover:scale-[1.02] hover:bg-[#e63222] active:scale-[0.98]"
            >
                <span class="text-lg">+</span> Create New
            </Link>
        </div>

        <!-- Bento Stats: Focused on scale -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div
                class="rounded-3xl border border-black/[0.06] bg-white p-8 dark:border-[#3E3E3A]/40 dark:bg-[#161615]"
            >
                <p
                    class="text-xs font-semibold tracking-widest text-[#71717a] uppercase"
                >
                    Total Links
                </p>
                <h2 class="mt-3 text-5xl font-extrabold tracking-tighter">
                    1,248
                </h2>
            </div>
            <div
                class="rounded-3xl border border-black/[0.06] bg-white p-8 dark:border-[#3E3E3A]/40 dark:bg-[#161615]"
            >
                <p
                    class="text-xs font-semibold tracking-widest text-[#71717a] uppercase"
                >
                    Total Views
                </p>
                <h2 class="mt-3 text-5xl font-extrabold tracking-tighter">
                    84.2K
                </h2>
            </div>
        </div>

        <!-- Modern List View -->
        <div
            class="flex-1 overflow-hidden rounded-3xl border border-black/[0.06] bg-white shadow-sm dark:border-[#3E3E3A]/40 dark:bg-[#161615]"
        >
            <div
                class="border-b border-black/[0.03] px-8 py-6 dark:border-[#3E3E3A]/40"
            >
                <h3 class="text-lg font-bold">Active Links</h3>
            </div>

            <div class="overflow-y-auto">
                <div
                    v-for="i in 8"
                    :key="i"
                    class="group flex items-center justify-between border-b border-black/[0.03] px-8 py-6 transition-colors hover:bg-neutral-50/50 dark:border-[#3E3E3A]/20 dark:hover:bg-[#1f1f1d]"
                >
                    <div class="flex flex-col gap-1.5">
                        <span
                            class="font-mono text-sm font-medium tracking-tight text-[#FF4433]"
                            >url.sh/abc-{{ i }}</span
                        >
                        <span class="max-w-md truncate text-sm text-neutral-500"
                            >https://long-url-destination-example.com/{{
                                i
                            }}</span
                        >
                    </div>

                    <div class="flex items-center gap-8">
                        <div class="text-right">
                            <p class="text-2xl font-bold tracking-tight">
                                1,240
                            </p>
                            <p
                                class="text-[10px] tracking-widest text-neutral-400 uppercase"
                            >
                                Views
                            </p>
                        </div>
                        <button
                            class="p-2 text-neutral-300 transition-colors hover:text-[#FF4433]"
                        >
                            <!-- Simple Edit Icon Placeholder -->
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                ></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
