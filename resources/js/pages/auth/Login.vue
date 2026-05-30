<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineOptions({
    layout: {
        title: 'Log in to your account',
        description: 'Enter your email and password below to log in',
    },
});

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();
</script>

<template>
    <Head title="Log in" />

    <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
        {{ status }}
    </div>

    <Form
        v-bind="store.form()"
        :reset-on-success="['password']"
        v-slot="{ errors, processing }"
        class="flex flex-col gap-6"
    >
        <div class="grid gap-6">
            <div class="grid gap-2">
                <label for="email" class="text-sm font-medium text-[#18181b] dark:text-[#EDEDEC]">Email address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    required
                    autofocus
                    tabindex="1"
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="w-full rounded-xl border border-black/[0.14] bg-white/70 px-4 py-3.5 text-base text-[#18181b] outline-none transition-all duration-200 focus:border-[#FF4433] focus:ring-4 focus:ring-[#FF4433]/10 dark:border-[#3E3E3A] dark:bg-[#161615] dark:text-[#EDEDEC]"
                />
                <InputError :message="errors.email" />
            </div>

            <div class="grid gap-2">
                <div class="flex items-center justify-between">
                    <label for="password" class="text-sm font-medium text-[#18181b] dark:text-[#EDEDEC]">Password</label>
                    <TextLink v-if="canResetPassword" :href="request()" class="text-sm hover:text-[#FF4433]" >
                        Forgot password?
                    </TextLink>
                </div>
                <PasswordInput
                    id="password"
                    name="password"
                    required
                    tabindex="2"
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full rounded-xl border border-black/[0.14] bg-white/70 px-4 py-3.5 text-base text-[#18181b] outline-none transition-all duration-200 focus:border-[#FF4433] focus:ring-4 focus:ring-[#FF4433]/10 dark:border-[#3E3E3A] dark:bg-[#161615] dark:text-[#EDEDEC]"
                />
                <InputError :message="errors.password" />
            </div>

            <button
                type="submit"
                :disabled="processing"
                tabindex="4"
                class="mt-2 flex w-full items-center justify-center rounded-xl bg-[#FF4433] px-8 py-3.5 text-base font-semibold text-white shadow-[0_4px_12px_rgba(255,68,51,0.2)] transition-all duration-200 hover:bg-[#e13825] hover:shadow-[0_6px_20px_rgba(225,56,37,0.3)] active:scale-[0.98] disabled:opacity-70"
            >
                <span v-if="processing" class="mr-2">Loading...</span>
                Log in
            </button>
        </div>

        <div class="text-center text-sm text-[#52525b] dark:text-[#A1A09A]">
            Don't have an account?
            <TextLink :href="register()" class="font-semibold text-[#FF4433] hover:underline" tabindex="6">Sign up</TextLink>
        </div>
    </Form>
</template>