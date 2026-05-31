<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { login } from '@/routes';
import { store } from '@/routes/register';

defineProps<{
    passwordRules: string;
}>();

defineOptions({
    layout: {
        title: 'Create an account',
        description: 'Enter your details below to create your account',
    },
});
</script>

<template>
    <Head title="Register" />

    <Form
        v-bind="store.form()"
        :reset-on-success="['password', 'password_confirmation']"
        v-slot="{ errors, processing }"
        class="flex flex-col gap-6"
    >
        <div class="grid gap-6">
            <div class="grid gap-2">
                <label
                    for="name"
                    class="text-sm font-medium text-[#18181b] dark:text-[#EDEDEC]"
                    >Name</label
                >
                <input
                    id="name"
                    type="text"
                    name="name"
                    required
                    autofocus
                    tabindex="1"
                    autocomplete="name"
                    placeholder="Full name"
                    class="w-full rounded-xl border border-black/[0.14] bg-white/70 px-4 py-3.5 text-base text-[#18181b] transition-all duration-200 outline-none focus:border-[#FF4433] focus:ring-4 focus:ring-[#FF4433]/10 dark:border-[#3E3E3A] dark:bg-[#161615] dark:text-[#EDEDEC]"
                />
                <InputError :message="errors.name" />
            </div>

            <div class="grid gap-2">
                <label
                    for="email"
                    class="text-sm font-medium text-[#18181b] dark:text-[#EDEDEC]"
                    >Email address</label
                >
                <input
                    id="email"
                    type="email"
                    name="email"
                    required
                    tabindex="2"
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="w-full rounded-xl border border-black/[0.14] bg-white/70 px-4 py-3.5 text-base text-[#18181b] transition-all duration-200 outline-none focus:border-[#FF4433] focus:ring-4 focus:ring-[#FF4433]/10 dark:border-[#3E3E3A] dark:bg-[#161615] dark:text-[#EDEDEC]"
                />
                <InputError :message="errors.email" />
            </div>

            <div class="grid gap-2">
                <label
                    for="password"
                    class="text-sm font-medium text-[#18181b] dark:text-[#EDEDEC]"
                    >Password</label
                >
                <PasswordInput
                    id="password"
                    name="password"
                    required
                    tabindex="3"
                    autocomplete="new-password"
                    placeholder="••••••••"
                    :passwordrules="passwordRules"
                    class="w-full rounded-xl border border-black/[0.14] bg-white/70 px-4 py-3.5 text-base text-[#18181b] transition-all duration-200 outline-none focus:border-[#FF4433] focus:ring-4 focus:ring-[#FF4433]/10 dark:border-[#3E3E3A] dark:bg-[#161615] dark:text-[#EDEDEC]"
                />
                <InputError :message="errors.password" />
            </div>

            <div class="grid gap-2">
                <label
                    for="password_confirmation"
                    class="text-sm font-medium text-[#18181b] dark:text-[#EDEDEC]"
                    >Confirm password</label
                >
                <PasswordInput
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    tabindex="4"
                    autocomplete="new-password"
                    placeholder="••••••••"
                    :passwordrules="passwordRules"
                    class="w-full rounded-xl border border-black/[0.14] bg-white/70 px-4 py-3.5 text-base text-[#18181b] transition-all duration-200 outline-none focus:border-[#FF4433] focus:ring-4 focus:ring-[#FF4433]/10 dark:border-[#3E3E3A] dark:bg-[#161615] dark:text-[#EDEDEC]"
                />
                <InputError :message="errors.password_confirmation" />
            </div>

            <button
                type="submit"
                :disabled="processing"
                tabindex="5"
                class="mt-2 flex w-full items-center justify-center rounded-xl bg-[#FF4433] px-8 py-3.5 text-base font-semibold text-white shadow-[0_4px_12px_rgba(255,68,51,0.2)] transition-all duration-200 hover:bg-[#e13825] hover:shadow-[0_6px_20px_rgba(225,56,37,0.3)] active:scale-[0.98] disabled:opacity-70"
            >
                <span v-if="processing" class="mr-2">Loading...</span>
                Create account
            </button>
            <a
                href="/auth/google/redirect"
                class="flex items-center justify-center gap-3 rounded-xl border border-gray-300 bg-white px-6 py-3 font-semibold text-gray-700 transition hover:bg-gray-50"
            >
                <img
                    src="https://developers.google.com/identity/images/g-logo.png"
                    class="h-5 w-5"
                    alt="Google"
                />
                Continue with Google
            </a>
        </div>

        <div class="text-center text-sm text-[#52525b] dark:text-[#A1A09A]">
            Already have an account?
            <TextLink
                :href="login()"
                class="font-semibold text-[#FF4433] hover:underline"
                tabindex="6"
                >Log in</TextLink
            >
        </div>
    </Form>
</template>
