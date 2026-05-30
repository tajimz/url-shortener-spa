<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { register } from '@/routes';
</script>

<template>
    <Head title="Link Not Found - Premium URL Shortener" />

    <main
        class="mx-auto w-full max-w-3xl px-4 pt-12 pb-16 text-center sm:px-6 sm:pt-20"
    >
        <div
            class="mx-auto flex h-14 w-14 items-center justify-center rounded-xl bg-[#FF4433]/10 text-2xl text-[#FF4433] shadow-[0_4px_12px_rgba(255,68,51,0.15)] dark:bg-[#FF4433]/20"
        >
            ⚠️
        </div>
        <h1
            class="mx-auto mt-6 text-3xl leading-tight font-extrabold tracking-tight xs:text-4xl sm:mt-8 sm:text-6xl"
        >
            Link destination <br />
            <span
                class="bg-gradient-to-r from-[#FF4433] via-[#ff6042] to-[#ff7c5c] bg-clip-text text-transparent"
            >
                could not be found.
            </span>
        </h1>

        <div
            class="mx-auto mt-8 max-w-2xl rounded-2xl border border-black/[0.12] bg-white/80 p-5 text-left shadow-[0_20px_50px_rgba(0,0,0,0.06)] backdrop-blur-xl sm:mt-12 sm:p-8 dark:border-[#3E3E3A]/60 dark:bg-[#111110] dark:shadow-[0_15px_50px_rgba(0,0,0,0.4)]"
        >
            <h3 class="mb-4 text-base font-bold sm:text-lg">
                Why did this happen?
            </h3>

            <div class="space-y-4">
                <div
                    class="flex items-start gap-3 rounded-xl border border-black/[0.06] bg-black/[0.02] p-3.5 sm:gap-4 sm:p-4 dark:border-[#3E3E3A]/30 dark:bg-white/[0.01]"
                >
                    <span class="shrink-0 text-lg sm:text-xl">✏️</span>
                    <div>
                        <h4 class="text-sm font-semibold">
                            Mistyped Short Code
                        </h4>
                        <p
                            class="mt-0.5 text-xs leading-relaxed text-[#52525b] sm:text-sm dark:text-[#A1A09A]"
                        >
                            Our links are strictly case-sensitive. Check for
                            capitalization errors or typos in your browser's
                            address bar.
                        </p>
                    </div>
                </div>

                <div
                    class="flex items-start gap-3 rounded-xl border border-black/[0.06] bg-black/[0.02] p-3.5 sm:gap-4 sm:p-4 dark:border-[#3E3E3A]/30 dark:bg-white/[0.01]"
                >
                    <span class="shrink-0 text-lg sm:text-xl">⏳</span>
                    <div>
                        <h4 class="text-sm font-semibold">
                            Link Lifetime Expired
                        </h4>
                        <p
                            class="mt-0.5 text-xs leading-relaxed text-[#52525b] sm:text-sm dark:text-[#A1A09A]"
                        >
                            Unauthenticated custom links expire inside
                            <strong class="text-[#b91c1c] dark:text-[#ff6b5c]"
                                >24 hours</strong
                            >. The owner may have also manually configured a
                            custom expiry cap.
                        </p>
                    </div>
                </div>

                <div
                    class="flex items-start gap-3 rounded-xl border border-black/[0.06] bg-black/[0.02] p-3.5 sm:gap-4 sm:p-4 dark:border-[#3E3E3A]/30 dark:bg-white/[0.01]"
                >
                    <span class="shrink-0 text-lg sm:text-xl">🛡️</span>
                    <div>
                        <h4 class="text-sm font-semibold">
                            Removed or Flagged
                        </h4>
                        <p
                            class="mt-0.5 text-xs leading-relaxed text-[#52525b] sm:text-sm dark:text-[#A1A09A]"
                        >
                            The redirect destination has been deleted by its
                            original creator, or taken down via automated
                            malware and threat monitoring.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex flex-col gap-3 sm:mt-8 sm:flex-row">
                <Link
                    href="/"
                    class="inline-flex w-full items-center justify-center rounded-xl bg-[#FF4433] px-6 py-3.5 text-base font-semibold text-white shadow-[0_4px_12px_rgba(255,68,51,0.2)] transition-all duration-200 hover:scale-[1.01] hover:bg-[#e63222] active:scale-[0.99] sm:flex-1"
                >
                    Back to Home
                </Link>
                <Link
                    href="/"
                    class="inline-flex w-full items-center justify-center rounded-xl border border-black/[0.12] bg-white px-6 py-3.5 text-base font-semibold shadow-sm transition-all duration-200 hover:bg-neutral-50 sm:flex-1 dark:border-[#3E3E3A] dark:bg-[#161615] dark:hover:bg-[#222]"
                >
                    Create Your Own Link →
                </Link>
            </div>
        </div>
    </main>
</template>