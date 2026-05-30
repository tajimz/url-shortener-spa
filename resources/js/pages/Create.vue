<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Create Link', href: '/create' }],
    },
});
const url = window.location.origin;

</script>

<template>
    <Head title="Create New Link" />

    <div class="flex h-full flex-col gap-8 p-6 sm:p-12">
        <div class="max-w-2xl">
            <h1 class="text-3xl font-bold tracking-tight">Create New Link</h1>
            <p class="mt-1 text-sm text-[#71717a]">
                Generate a short, trackable URL for your destination.
            </p>
        </div>

        <div class="max-w-2xl rounded-3xl border border-black/[0.06] bg-white p-8 dark:border-[#3E3E3A]/40 dark:bg-[#161615]">
            <div class="flex flex-col gap-6">
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold">Long URL</label>
                    <input 
                        type="url" 
                        placeholder="https://example.com/very-long-url-here" 
                        class="rounded-xl border border-black/[0.06] bg-neutral-50 px-4 py-3 outline-none focus:border-[#FF4433] dark:bg-[#1f1f1d] dark:border-none" 
                    />
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold">Custom Alias <span class="text-neutral-400 font-normal">(Optional)</span></label>
                    <div class="flex items-center gap-2 rounded-xl border border-black/[0.06] bg-neutral-50 px-4 py-3 focus-within:border-[#FF4433] dark:bg-[#1f1f1d] dark:border-none">
                        <span class="text-neutral-400 text-sm font-mono whitespace-nowrap">{{url}}/</span>
                        <input 
                            type="text" 
                            placeholder="my-custom-slug" 
                            class="w-full bg-transparent outline-none text-sm" 
                        />
                    </div>
                </div>

                <button 
                    class="mt-2 w-full rounded-xl bg-[#FF4433] py-3 font-semibold text-white transition-all hover:bg-[#e63222] active:scale-[0.98]"
                >
                    Create Link
                </button>
            </div>
        </div>

        <div class="max-w-2xl rounded-3xl border border-black/[0.06] bg-white p-8 dark:border-[#3E3E3A]/40 dark:bg-[#161615]">
            <h3 class="text-sm font-semibold mb-4">Result</h3>
            <div class="flex items-center justify-between gap-4 rounded-xl bg-neutral-50 p-4 dark:bg-[#1f1f1d]">
                <code class="font-mono text-[#FF4433] truncate">url.sh/example-link-slug</code>
                <button class="text-xs font-semibold uppercase text-neutral-500 hover:text-[#FF4433] transition-colors">
                    Copy
                </button>
            </div>
        </div>
    </div>
</template>