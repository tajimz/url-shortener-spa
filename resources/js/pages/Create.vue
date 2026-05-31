<script setup lang="ts">
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { Check } from 'lucide-vue-next';
import { computed, ref } from 'vue';

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Create Link', href: '/create' }],
    },
});
const url = window.location.hostname;

const form = useForm({
    long_url: '',
    short_code: '',
});
const submit = () => {
    form.post('/urls', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset('long_url', 'short_code');
        },
    });
};
const page = usePage();
const successMessage = computed(() => page.props.flash.success);
const newShortUrl = computed(() => page.props.flash.short_url);

const showToast = ref(false);

const copyToClipboard = () => {
    const fullUrl = `${url}/${newShortUrl.value.short_code}`;
    navigator.clipboard.writeText(fullUrl).then(() => {
        showToast.value = true;
        setTimeout(() => {
            showToast.value = false;
        }, 2000);
    });
};
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

        <form
            @submit.prevent="submit"
            class="max-w-2xl rounded-3xl border border-black/[0.06] bg-white p-8 dark:border-[#3E3E3A]/40 dark:bg-[#161615]"
        >
            <div class="flex flex-col gap-6">
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold">Long URL</label>
                    <input
                        @input="form.clearErrors()"
                        v-model="form.long_url"
                        type="url"
                        required
                        placeholder="https://example.com/very-long-url-here"
                        class="rounded-xl border border-black/[0.06] bg-neutral-50 px-4 py-3 outline-none focus:border-[#FF4433] dark:border-none dark:bg-[#1f1f1d]"
                    />
                </div>
                <div
                    v-if="form.errors.long_url"
                    class="mt-1 text-xs text-red-500"
                >
                    {{ form.errors.long_url }}
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold">
                        Custom Alias
                        <span class="font-normal text-neutral-400"
                            >(Optional)</span
                        >
                    </label>
                    <div
                        class="flex items-center gap-2 rounded-xl border border-black/[0.06] bg-neutral-50 px-4 py-3 focus-within:border-[#FF4433] dark:border-none dark:bg-[#1f1f1d]"
                    >
                        <span
                            class="font-mono text-sm whitespace-nowrap text-neutral-400"
                        >
                            {{ url }}/
                        </span>
                        <input
                            @input="form.clearErrors()"
                            v-model="form.short_code"
                            type="text"
                            placeholder="my-custom-slug"
                            class="w-full bg-transparent text-sm outline-none"
                        />
                    </div>
                    <div
                        v-if="form.errors.short_code"
                        class="mt-1 text-xs text-red-500"
                    >
                        {{ form.errors.short_code }}
                    </div>
                </div>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="mt-2 w-full rounded-xl bg-[#FF4433] py-3 font-semibold text-white transition-all hover:bg-[#e63222] active:scale-[0.98] disabled:opacity-50"
                >
                    {{ form.processing ? 'Creating...' : 'Create Link' }}
                </button>
            </div>
        </form>

        <div
            v-if="!form.isDirty && newShortUrl"
            class="max-w-2xl rounded-3xl border border-black/[0.06] bg-white p-8 dark:border-[#3E3E3A]/40 dark:bg-[#161615]"
        >
            <h3 class="mb-4 text-sm font-semibold">Result</h3>

            <div class="mb-4 text-xs text-neutral-500">
                <span class="mt-1 block max-w-full truncate italic">{{
                    newShortUrl.long_url
                }}</span>
            </div>

            <div
                class="flex items-center justify-between gap-4 rounded-xl bg-neutral-50 p-4 dark:bg-[#1f1f1d]"
            >
                <code class="truncate font-mono text-[#FF4433]"
                    >{{ url }}/{{ newShortUrl.short_code }}</code
                >
                <button
                    @click="copyToClipboard"
                    class="text-xs font-semibold text-neutral-500 uppercase transition-colors hover:text-[#FF4433]"
                >
                    Copy
                </button>
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

            <span class="text-sm font-semibold">URL copied to clipboard!</span>
        </div>
    </transition>
</template>
