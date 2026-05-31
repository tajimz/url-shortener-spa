<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { dashboard } from '@/routes';
import { Check, Lock, Trash2 } from 'lucide-vue-next'; // Removed unused Pencil
import { ref } from 'vue';

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Dashboard', href: dashboard() }],
    },
});

defineProps({
    urls: Array,
    total_urls: Number,
    total_clicks: Number,
});

const domain = window.location.hostname;
const showToast = ref(false);
const toastMessage = ref('URL copied to clipboard!');

const copyToClipboard = (shortCode: string) => {
    toastMessage.value = 'URL copied to clipboard!';
    const fullUrl = `${domain}/${shortCode}`;
    navigator.clipboard.writeText(fullUrl).then(() => {
        showToast.value = true;
        setTimeout(() => (showToast.value = false), 1500);
    });
};

const deleteUrl = (id: number) => {
    if (confirm('Are you sure you want to delete this link?')) {
        router.delete(`/urls/${id}`, {
            onSuccess: () => {
                toastMessage.value = 'URL deleted successfully!';
                showToast.value = true;
                setTimeout(() => (showToast.value = false), 1500);
            },
        });
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <div
        class="flex h-full flex-col gap-8 bg-[#f4f4f5] p-6 sm:p-12 dark:bg-[#0d0d0c]"
    >
        <div
            class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center"
        >
            <div>
                <h1
                    class="text-3xl font-bold tracking-tight text-[#18181b] dark:text-[#EDEDEC]"
                >
                    Dashboard
                </h1>
                <p class="mt-1 text-sm text-[#71717a] dark:text-[#A1A09A]">
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

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div
                class="rounded-3xl border border-black/[0.08] bg-white p-8 shadow-sm dark:border-[#3E3E3A]/40 dark:bg-[#161615]"
            >
                <p
                    class="text-xs font-semibold tracking-widest text-[#71717a] uppercase dark:text-[#A1A09A]"
                >
                    Total Links
                </p>
                <h2
                    class="mt-3 text-5xl font-extrabold tracking-tighter text-[#18181b] dark:text-white"
                >
                    {{ total_urls }}
                </h2>
            </div>
            <div
                class="rounded-3xl border border-black/[0.08] bg-white p-8 shadow-sm dark:border-[#3E3E3A]/40 dark:bg-[#161615]"
            >
                <p
                    class="text-xs font-semibold tracking-widest text-[#71717a] uppercase dark:text-[#A1A09A]"
                >
                    Total Views
                </p>
                <h2
                    class="mt-3 text-5xl font-extrabold tracking-tighter text-[#18181b] dark:text-white"
                >
                    {{ total_clicks }}
                </h2>
            </div>
        </div>

        <div
            class="flex-1 overflow-hidden rounded-3xl border border-black/[0.08] bg-white shadow-sm dark:border-[#3E3E3A]/40 dark:bg-[#161615]"
        >
            <div
                class="border-b border-black/[0.08] px-8 py-6 dark:border-[#3E3E3A]/40"
            >
                <h3 class="text-lg font-bold text-[#18181b] dark:text-white">
                    Active Links
                </h3>
            </div>

            <div
                v-if="urls.length === 0"
                class="p-12 text-center text-neutral-500"
            >
                <p>No links created yet.</p>
                <Link href="/create" class="text-[#FF4433] underline"
                    >Create your first one</Link
                >
            </div>

            <div v-else class="overflow-y-auto">
                <div
                    v-for="url in urls"
                    :key="url.id"
                    @click="copyToClipboard(url.short_code)"
                    class="group flex cursor-pointer items-center justify-between border-b border-black/[0.06] px-8 py-6 transition-colors hover:bg-neutral-50 dark:border-[#3E3E3A]/20 dark:hover:bg-[#1f1f1d]"
                >
                    <div class="flex items-center gap-3">
                        <div
                            class="flex w-6 shrink-0 justify-center text-neutral-400"
                        >
                            <Lock v-if="url.password" :size="16" />
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <span
                                class="font-mono text-sm font-medium tracking-tight text-[#FF4433]"
                            >
                                {{ domain }}/{{ url.short_code }}
                            </span>
                            <span
                                class="max-w-md truncate text-sm text-neutral-500 dark:text-[#A1A09A]"
                            >
                                {{ url.long_url }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-8">
                        <div class="text-right">
                            <p
                                class="text-2xl font-bold tracking-tight text-[#18181b] dark:text-white"
                            >
                                {{ url.clicks }}
                            </p>
                            <p
                                class="text-[10px] tracking-widest text-neutral-400 uppercase"
                            >
                                Views
                            </p>
                        </div>
                        <button
                            @click.stop="deleteUrl(url.id)"
                            class="text-neutral-400 transition-colors hover:text-red-600"
                        >
                            <Trash2 class="size-5" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <transition
        enter-active-class="transition ease-out duration-200"
        enter-from-class="opacity-0 translate-y-2"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition ease-in duration-150"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="opacity-0 translate-y-2"
    >
        <div
            v-if="showToast"
            class="fixed bottom-10 left-1/2 z-50 flex -translate-x-1/2 items-center gap-2 rounded-xl bg-[#FF4433] px-6 py-3 text-white shadow-lg"
        >
            <Check :size="20" stroke-width="3" />
            <span class="text-sm font-semibold">{{ toastMessage }}</span>
        </div>
    </transition>
</template>
