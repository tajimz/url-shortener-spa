<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import SecurityController from '@/actions/App/Http/Controllers/Settings/SecurityController';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { edit } from '@/routes/security';
import { edit as profileEdit } from '@/routes/profile';

type Props = {
    passwordRules: string;
};

const props = defineProps<Props>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Security Settings',
                href: edit(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Change Password" />

    <div class="max-w-3xl">
        <h1 class="sr-only">Security settings</h1>

        <!-- Navigation Capsule -->
        <div
            class="mb-6 flex items-center rounded-2xl border border-black/[0.08] bg-white p-4 shadow-sm dark:border-[#3E3E3A]/40 dark:bg-[#111110]"
        >
            <nav class="flex items-center gap-2">
                <Link
                    :href="profileEdit()"
                    class="rounded-xl px-4 py-2 text-sm font-medium text-[#71717a] transition-colors hover:text-[#FF4433] dark:text-[#A1A09A] dark:hover:text-[#FF4433]"
                >
                    Profile
                </Link>
                <Link
                    :href="edit()"
                    class="rounded-xl bg-black/[0.05] px-4 py-2 text-sm font-semibold text-[#18181b] dark:bg-[#222] dark:text-white"
                >
                    Change password
                </Link>
            </nav>
        </div>

        <!-- Main Security Card -->
        <div
            class="rounded-2xl border border-black/[0.12] bg-white/80 p-6 shadow-[0_20px_50px_rgba(0,0,0,0.06)] backdrop-blur-xl dark:border-[#3E3E3A]/60 dark:bg-[#111110] dark:shadow-[0_15px_50px_rgba(0,0,0,0.4)]"
        >
            <Heading
                variant="small"
                title="Update password"
                description="Ensure your account is using a long, random password to stay secure"
                class="mb-6"
            />

            <Form
                v-bind="SecurityController.update.form()"
                :options="{ preserveScroll: true }"
                reset-on-success
                :reset-on-error="[
                    'password',
                    'password_confirmation',
                    'current_password',
                ]"
                class="space-y-6"
                v-slot="{ errors, processing }"
            >
                <div class="grid gap-2">
                    <Label
                        for="current_password"
                        class="text-[#18181b] dark:text-[#EDEDEC]"
                        >Current password</Label
                    >
                    <PasswordInput
                        id="current_password"
                        name="current_password"
                        class="border-black/[0.14] bg-white/70 focus:border-[#FF4433] dark:border-[#3E3E3A] dark:bg-[#161615] dark:text-[#EDEDEC]"
                        autocomplete="current-password"
                        placeholder="Current password"
                    />
                    <InputError
                        class="mt-1"
                        :message="errors.current_password"
                    />
                </div>

                <div class="grid gap-2">
                    <Label
                        for="password"
                        class="text-[#18181b] dark:text-[#EDEDEC]"
                        >New password</Label
                    >
                    <PasswordInput
                        id="password"
                        name="password"
                        class="border-black/[0.14] bg-white/70 focus:border-[#FF4433] dark:border-[#3E3E3A] dark:bg-[#161615] dark:text-[#EDEDEC]"
                        autocomplete="new-password"
                        placeholder="New password"
                        :passwordrules="props.passwordRules"
                    />
                    <InputError class="mt-1" :message="errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label
                        for="password_confirmation"
                        class="text-[#18181b] dark:text-[#EDEDEC]"
                        >Confirm password</Label
                    >
                    <PasswordInput
                        id="password_confirmation"
                        name="password_confirmation"
                        class="border-black/[0.14] bg-white/70 focus:border-[#FF4433] dark:border-[#3E3E3A] dark:bg-[#161615] dark:text-[#EDEDEC]"
                        autocomplete="new-password"
                        placeholder="Confirm password"
                        :passwordrules="props.passwordRules"
                    />
                    <InputError
                        class="mt-1"
                        :message="errors.password_confirmation"
                    />
                </div>

                <div class="pt-2">
                    <Button
                        :disabled="processing"
                        data-test="update-password-button"
                        class="bg-[#FF4433] px-8 py-2.5 font-semibold text-white shadow-[0_4px_12px_rgba(255,68,51,0.2)] transition-all hover:scale-[1.02] hover:bg-[#e63222] active:scale-[0.98]"
                    >
                        Save password
                    </Button>
                </div>
            </Form>
        </div>
    </div>
</template>
