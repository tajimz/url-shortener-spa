<script setup lang="ts">
import { Form, Head, usePage, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import DeleteUser from '@/components/DeleteUser.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { edit } from '@/routes/profile';
import { send } from '@/routes/verification';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Profile settings',
                href: edit(),
            },
        ],
    },
});

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <Head title="Profile settings" />

    <div class="max-w-3xl">
        <h1 class="sr-only">Profile settings</h1>

        <!-- Navigation Card -->
        <div class="mb-6 flex items-center justify-between rounded-2xl border border-black/[0.08] bg-white p-4 shadow-sm dark:border-[#3E3E3A]/40 dark:bg-[#111110]">
            <nav class="flex items-center gap-2">
                <Link
                    :href="edit()"
                    class="rounded-xl bg-black/[0.05] px-4 py-2 text-sm font-semibold text-[#18181b] dark:bg-[#222] dark:text-white"
                >
                    Profile
                </Link>
                <Link
                    href="/settings/security"
                    class="rounded-xl px-4 py-2 text-sm font-medium text-[#71717a] transition-colors hover:text-[#FF4433] dark:text-[#A1A09A] dark:hover:text-[#FF4433]"
                >
                    Change password
                </Link>
            </nav>
            <Link
                href="/logout"
                method="post"
                as="button"
                class="px-4 py-2 text-sm font-medium text-[#b91c1c] transition-colors hover:text-[#e11d48] dark:text-[#ff6b5c]"
            >
                Log out
            </Link>
        </div>

        <!-- Form Card -->
        <div class="rounded-2xl border border-black/[0.12] bg-white/80 p-6 shadow-[0_20px_50px_rgba(0,0,0,0.06)] backdrop-blur-xl dark:border-[#3E3E3A]/60 dark:bg-[#111110] dark:shadow-[0_15px_50px_rgba(0,0,0,0.4)]">
            <Heading
                variant="small"
                title="Profile"
                description="Update your name and email address"
                class="mb-6"
            />

            <Form
                v-bind="ProfileController.update.form()"
                class="space-y-6"
                v-slot="{ errors, processing }"
            >
                <div class="grid gap-2">
                    <Label for="name" class="text-[#18181b] dark:text-[#EDEDEC]">Name</Label>
                    <Input
                        id="name"
                        name="name"
                        :default-value="user.name"
                        required
                        autocomplete="name"
                        placeholder="Full name"
                        class="border-black/[0.14] bg-white/70 focus:border-[#FF4433] dark:border-[#3E3E3A] dark:bg-[#161615] dark:text-[#EDEDEC]"
                    />
                    <InputError class="mt-1" :message="errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email" class="text-[#18181b] dark:text-[#EDEDEC]">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        :default-value="user.email"
                        disabled
                        autocomplete="username"
                        placeholder="Email address"
                        class="border-black/[0.14] bg-white/70 focus:border-[#FF4433] dark:border-[#3E3E3A] dark:bg-[#161615] dark:text-[#EDEDEC]"
                    />
                    <InputError class="mt-1" :message="errors.email" />
                </div>

                <div v-if="page.props.mustVerifyEmail && !user.email_verified_at" class="rounded-xl border border-[#FF4433]/20 bg-[#FF4433]/5 p-4 dark:bg-[#FF4433]/10">
                    <p class="text-sm text-[#52525b] dark:text-[#A1A09A]">
                        Your email address is unverified.
                        <Link
                            :href="send()"
                            as="button"
                            class="font-medium text-[#FF4433] underline underline-offset-4 hover:text-[#e63222]"
                        >
                            Click here to re-send the verification email.
                        </Link>
                    </p>

                    <div
                        v-if="page.props.status === 'verification-link-sent'"
                        class="mt-2 text-sm font-medium text-[#FF4433]"
                    >
                        A new verification link has been sent to your email address.
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <Button 
                        :disabled="processing" 
                        data-test="update-profile-button"
                        class="bg-[#FF4433] px-8 py-2.5 font-semibold text-white shadow-[0_4px_12px_rgba(255,68,51,0.2)] transition-all hover:scale-[1.02] hover:bg-[#e63222] active:scale-[0.98]"
                    >
                        Save changes
                    </Button>
                </div>
            </Form>
        </div>

        <div class="mt-8">
            <DeleteUser />
        </div>
    </div>
</template>