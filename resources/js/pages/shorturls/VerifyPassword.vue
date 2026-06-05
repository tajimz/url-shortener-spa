<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    short_code: string;
}>();

const form = useForm({
    password: '',
});

const submit = () => {
    const link = `/${props.short_code}/password`;
    form.post(link);
};
</script>

<template>
    <Head title="Password Protected - Premium URL Shortener" />

    <main
        class="mx-auto w-full max-w-xl px-4 pt-12 pb-16 text-center sm:px-6 sm:pt-20"
    >
        <div
            class="mx-auto flex h-14 w-14 items-center justify-center rounded-xl bg-[#FF4433]/10 text-2xl text-[#FF4433] shadow-[0_4px_12px_rgba(255,68,51,0.15)] dark:bg-[#FF4433]/20"
        >
            🔒
        </div>
        <h1
            class="xs:text-4xl mx-auto mt-6 text-3xl leading-tight font-extrabold tracking-tight sm:mt-8 sm:text-5xl"
        >
            Access is <br />
            <span
                class="bg-gradient-to-r from-[#FF4433] via-[#ff6042] to-[#ff7c5c] bg-clip-text text-transparent"
            >
                password protected.
            </span>
        </h1>
        <p class="mt-4 text-[#52525b] dark:text-[#A1A09A]">
            Please enter the password provided by the link creator to proceed.
        </p>

        <div
            class="mx-auto mt-8 rounded-2xl border border-black/[0.12] bg-white/80 p-5 text-left shadow-[0_20px_50px_rgba(0,0,0,0.06)] backdrop-blur-xl sm:mt-12 sm:p-8 dark:border-[#3E3E3A]/60 dark:bg-[#111110] dark:shadow-[0_15px_50px_rgba(0,0,0,0.4)]"
        >
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label
                        for="password"
                        class="mb-2 block text-sm font-semibold"
                        >Password</label
                    >
                    <input
                        id="password"
                        v-model="form.password"
                        type="password"
                        placeholder="Enter your password"
                        class="w-full rounded-xl border border-black/[0.12] bg-white px-4 py-3.5 text-base transition-all outline-none focus:border-[#FF4433] focus:ring-1 focus:ring-[#FF4433] dark:border-[#3E3E3A] dark:bg-[#161615]"
                    />
                    <div
                        v-if="form.errors.password"
                        class="mt-1 text-xs text-red-500"
                    >
                        {{ form.errors.password }}
                    </div>
                </div>

                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center rounded-xl bg-[#FF4433] px-6 py-3.5 text-base font-semibold text-white shadow-[0_4px_12px_rgba(255,68,51,0.2)] transition-all duration-200 hover:scale-[1.01] hover:bg-[#e63222] active:scale-[0.99]"
                >
                    Unlock Destination →
                </button>
            </form>
        </div>
    </main>
</template>

<style scoped>
/* Scoped styles if needed */
</style>
