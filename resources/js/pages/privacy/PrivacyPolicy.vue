<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Privacy Policy" />

    <div
        class="relative min-h-screen overflow-x-hidden bg-[#f4f4f5] text-[#18181b] antialiased selection:bg-[#FF4433]/20 selection:text-[#FF4433] dark:bg-[#0d0d0c] dark:text-[#EDEDEC] dark:selection:bg-[#FF4433]/30 dark:selection:text-white"
    >
        <!-- Background Orbs -->
        <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
            <div
                class="absolute -top-[40%] -left-[20%] h-[60%] w-[140%] rounded-full bg-gradient-to-br from-[#FF4433]/10 to-transparent blur-3xl sm:w-[80%] dark:hidden"
            ></div>
            <div
                class="absolute -top-[40%] -left-[20%] hidden h-[60%] w-[140%] rounded-full bg-gradient-to-br from-[#FF4433]/10 to-transparent blur-3xl sm:w-[80%] dark:block"
            ></div>
        </div>

        <main class="relative z-10 mx-auto max-w-4xl px-4 pt-12 pb-24 sm:px-6 lg:px-8">
            <Link
                href="/"
                class="mb-8 inline-flex items-center gap-2 text-sm font-medium text-[#52525b] transition-colors hover:text-[#FF4433] dark:text-[#A1A09A] dark:hover:text-[#FF4433]"
            >
                ← Back to Home
            </Link>

            <h1 class="text-3xl font-extrabold tracking-tight sm:text-5xl">
                Privacy Policy
            </h1>
            <p class="mt-4 text-sm text-[#52525b] sm:text-base dark:text-[#A1A09A]">
                Last updated: June 4, 2026
            </p>

            <div class="mt-12 space-y-10 text-[#52525b] dark:text-[#A1A09A]">
                <section>
                    <h2 class="mb-4 text-lg font-bold text-[#18181b] dark:text-[#EDEDEC]">
                        1. Information We Collect
                    </h2>
                    <p class="leading-relaxed">
                        We collect minimal data to provide our URL shortening services:
                    </p>
                    <ul class="mt-4 list-inside list-disc space-y-2">
                        <li><strong>Account Data:</strong> Name, email address, and hashed passwords.</li>
                        <li><strong>Authentication:</strong> Google OAuth ID and session cookies.</li>
                        <li><strong>URL Data:</strong> The long URLs you submit, generated short codes, and optional password-protection settings.</li>
                        <li><strong>Usage Data:</strong> Aggregated click counts and server logs (IP addresses, timestamps) for security.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="mb-4 text-lg font-bold text-[#18181b] dark:text-[#EDEDEC]">
                        2. How We Use Data
                    </h2>
                    <p class="leading-relaxed">
                        Your information is used strictly to maintain the functionality of your links and account security. Specifically:
                    </p>
                    <ul class="mt-4 list-inside list-disc space-y-2">
                        <li>To authenticate your identity and manage your dashboard.</li>
                        <li>To route shortened links to their original destinations.</li>
                        <li>To provide security features such as rate-limiting and link protection.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="mb-4 text-lg font-bold text-[#18181b] dark:text-[#EDEDEC]">
                        3. Data Retention
                    </h2>
                    <ul class="list-inside list-disc space-y-2">
                        <li><strong>Guest Links:</strong> Expire and are purged automatically after 24 hours.</li>
                        <li><strong>Registered Accounts:</strong> Data is retained until you delete your account. Upon account deletion, all associated links are removed.</li>
                        <li><strong>Session Data:</strong> Cookies expire after 120 minutes of inactivity.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="mb-4 text-lg font-bold text-[#18181b] dark:text-[#EDEDEC]">
                        4. Security & Third-Party Services
                    </h2>
                    <p class="leading-relaxed">
                        We prioritize your data security using industry-standard hashing for passwords and HTTPS for all traffic. We use Google OAuth for authentication and reliable email providers for system notifications. We do not use external analytics SDKs; all click tracking is stored internally as aggregated counts only.
                    </p>
                </section>

                <section>
                    <h2 class="mb-4 text-lg font-bold text-[#18181b] dark:text-[#EDEDEC]">
                        5. Your Rights
                    </h2>
                    <p class="leading-relaxed">
                        You have the right to access, update, or delete your account information through your user dashboard at any time. If you require assistance, please contact us.
                    </p>
                </section>

                <section>
                    <h2 class="mb-4 text-lg font-bold text-[#18181b] dark:text-[#EDEDEC]">
                        6. Children
                    </h2>
                    <p class="leading-relaxed">
                        This service is not intended for individuals under the age of 16.
                    </p>
                </section>
            </div>
        </main>

        <!-- Exact Footer from Welcome Page -->
        <footer
            class="mx-auto max-w-7xl border-t border-black/[0.08] px-6 py-12 dark:border-[#3E3E3A]/20"
        >
            <div
                class="flex flex-col items-center justify-between gap-6 text-sm text-[#71717a] md:flex-row dark:text-[#A1A09A]"
            >
                <div class="space-y-1 text-center md:text-left">
                    <p>&copy; 2026 URLShortener. All rights reserved.</p>
                    <p class="inline-flex items-center gap-1">
                        A concern of
                        <a
                            href="https://tajimz.xyz"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="font-medium text-[#18181b] underline underline-offset-2 transition-all duration-200 hover:text-[#FF4433] dark:text-[#EDEDEC]"
                        >
                            Tajim
                        </a>
                    </p>
                </div>

                <div class="flex items-center gap-6 font-medium">
                    <Link
                        href="/privacy-policy"
                        class="underline-offset-4 transition-colors duration-200 hover:text-[#FF4433] hover:underline"
                    >
                        Privacy Policy
                    </Link>
                    <span
                        class="h-4 w-[1px] bg-black/[0.12] dark:bg-[#3E3E3A]/60"
                    ></span>
                    <Link
                        href="/terms-conditions"
                        class="underline-offset-4 transition-colors duration-200 hover:text-[#FF4433] hover:underline"
                    >
                        Terms of Service
                    </Link>
                </div>
            </div>
        </footer>
    </div>
</template>