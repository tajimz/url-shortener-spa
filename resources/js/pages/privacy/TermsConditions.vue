<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Terms of Service" />

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
                Terms of Service
            </h1>
            <p class="mt-4 text-sm text-[#52525b] sm:text-base dark:text-[#A1A09A]">
                Last updated: June 4, 2026
            </p>

            <div class="mt-12 space-y-10 text-[#52525b] dark:text-[#A1A09A]">
                <section>
                    <h2 class="mb-4 text-lg font-bold text-[#18181b] dark:text-[#EDEDEC]">
                        1. Using the Service
                    </h2>
                    <p class="leading-relaxed">
                        By accessing this Service, you agree to these Terms. You are responsible for all activity under your account and for maintaining the security of your credentials. The Service provides tools for URL management, including password protection and API access via Sanctum tokens.
                    </p>
                </section>

                <section>
                    <h2 class="mb-4 text-lg font-bold text-[#18181b] dark:text-[#EDEDEC]">
                        2. User Content
                    </h2>
                    <p class="leading-relaxed">
                        You retain ownership of the URLs and content you submit. By using the service, you grant us a license to store and distribute your content as necessary to operate the Service. You warrant that your content is legal and does not infringe on the rights of others.
                    </p>
                </section>

                <section>
                    <h2 class="mb-4 text-lg font-bold text-[#18181b] dark:text-[#EDEDEC]">
                        3. Prohibited Use
                    </h2>
                    <ul class="list-inside list-disc space-y-2">
                        <li>Distributing malware, phishing, or illegal content.</li>
                        <li>Deceiving recipients about link destinations.</li>
                        <li>Harvesting personal data without proper consent.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="mb-4 text-lg font-bold text-[#18181b] dark:text-[#EDEDEC]">
                        4. Data, Analytics, and Guests
                    </h2>
                    <p class="leading-relaxed">
                        Guest-created links automatically expire after 24 hours. We store aggregate click counts internally; we do not store individual visitor logs by default. Accounts may be terminated for policy violations, and account deletion will trigger a cascade removal of your associated links.
                    </p>
                </section>

                <section>
                    <h2 class="mb-4 text-lg font-bold text-[#18181b] dark:text-[#EDEDEC]">
                        5. Disclaimers & Liability
                    </h2>
                    <p class="leading-relaxed">
                        The Service is provided "as is" without warranties of any kind. To the maximum extent permitted by law, we are not liable for any indirect, incidental, or consequential damages resulting from your use of the Service.
                    </p>
                </section>
            </div>
        </main>

        <!-- Footer -->
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