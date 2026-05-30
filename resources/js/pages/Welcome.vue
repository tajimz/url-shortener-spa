<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';
import { ref } from 'vue';
import axios from 'axios';
const url = window.location.origin;
const longUrl = ref('');
const result = ref(null);
const error = ref('');

const submit = async () => {
    try {
        const response = await axios.post('/api/public/shorten', {
            long_url: longUrl.value,
        });

        result.value = response.data.data;

        console.log(result.value);
    } catch (err) {
        error.value = err?.response?.data?.message || 'Request failed';
    }
};
const copied = ref(false);
const copyLink = async () => {
    const text = `${url}/${result.value.short_code}`;
    await navigator.clipboard.writeText(text);

    copied.value = true;
    setTimeout(() => {
        copied.value = false;
    }, 1500);
};
</script>

<template>
    <Head title="Premium URL Shortener" />

    <div
        class="relative min-h-screen overflow-x-hidden bg-[#f4f4f5] text-[#18181b] antialiased selection:bg-[#FF4433]/20 selection:text-[#FF4433] dark:bg-[#0d0d0c] dark:text-[#EDEDEC] dark:selection:bg-[#FF4433]/30 dark:selection:text-white"
    >
        <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
            <div
                class="absolute -top-[40%] -left-[20%] h-[60%] w-[140%] rounded-full bg-gradient-to-br from-[#FF4433]/10 to-transparent blur-3xl sm:w-[80%] dark:hidden"
            ></div>
            <div
                class="absolute top-[20%] -right-[30%] h-[50%] w-[130%] rounded-full bg-gradient-to-br from-[#6366f1]/5 to-transparent blur-3xl sm:w-[70%] dark:hidden"
            ></div>

            <div
                class="absolute -top-[40%] -left-[20%] hidden h-[60%] w-[140%] rounded-full bg-gradient-to-br from-[#FF4433]/10 to-transparent blur-3xl sm:w-[80%] dark:block"
            ></div>
            <div
                class="absolute top-[20%] -right-[30%] hidden h-[50%] w-[130%] rounded-full bg-gradient-to-br from-[#ff6042]/5 to-transparent blur-3xl sm:w-[70%] dark:block"
            ></div>
        </div>

        <div class="relative z-10">
            <div
                class="border-b border-black/[0.08] bg-white/20 backdrop-blur-sm dark:border-[#3E3E3A]/40 dark:bg-transparent dark:backdrop-blur-none"
            >
                <header
                    class="mx-auto flex max-w-7xl items-center justify-between p-4 sm:p-6 lg:p-8"
                >
                    <div
                        class="group flex cursor-default items-center gap-2.5 text-xl font-bold tracking-tight sm:text-2xl"
                    >
                        <span
                            class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#FF4433] text-white shadow-[0_4px_12px_rgba(255,68,51,0.25)] transition-transform duration-300 group-hover:scale-110"
                        >
                            ⚡
                        </span>
                        <span
                            >URL<span
                                class="text-[#FF4433] transition-colors duration-300 group-hover:text-[#ff7c5c]"
                                >Shortener</span
                            ></span
                        >
                    </div>

                    <nav class="flex items-center gap-3 sm:gap-5">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="dashboard()"
                            class="rounded-xl border border-black/[0.12] bg-white px-4 py-2 text-sm font-medium shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-neutral-50 hover:shadow-md active:translate-y-0 sm:px-5 sm:py-2.5 sm:text-base dark:border-[#3E3E3A] dark:bg-[#161615] dark:hover:bg-[#222]"
                        >
                            Dashboard →
                        </Link>
                        <template v-else>
                            <Link
                                :href="login()"
                                class="px-2 py-2 text-sm font-medium text-[#52525b] transition-colors duration-200 hover:text-[#FF4433] sm:px-4 sm:text-base dark:text-[#A1A09A]"
                            >
                                Log in
                            </Link>
                            <Link
                                :href="register()"
                                class="rounded-xl bg-[#FF4433] px-4 py-2 text-sm font-medium text-white shadow-[0_4px_12px_rgba(255,68,51,0.2)] transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#e63222] hover:shadow-[0_6px_20px_rgba(255,68,51,0.3)] active:translate-y-0 sm:px-5 sm:py-2.5 sm:text-base"
                            >
                                Get Started
                                <span class="xs:inline hidden">Free</span>
                            </Link>
                        </template>
                    </nav>
                </header>
            </div>

            <main
                class="mx-auto max-w-6xl px-4 pt-12 pb-24 text-center sm:px-6 sm:pt-20 lg:px-8 lg:pt-28"
            >
                <div
                    class="inline-flex max-w-full items-center gap-2.5 rounded-full border border-[#FF4433]/30 bg-[#FF4433]/10 px-4 py-1.5 text-left text-xs font-medium text-[#ff4433] transition-all duration-300 hover:bg-[#FF4433]/15 sm:text-center sm:text-sm dark:border-[#FF4433]/30 dark:bg-[#FF4433]/10 dark:text-[#FF4433] dark:hover:bg-[#FF4433]/15"
                >
                    <span
                        class="flex h-2 w-2 shrink-0 animate-pulse rounded-full bg-[#FF4433]"
                    ></span>
                    <span class="truncate"
                        >Shorten seamlessly. Free, fast, and secure !</span
                    >
                </div>

                <h1
                    class="mx-auto mt-6 max-w-4xl text-3xl leading-tight font-extrabold tracking-tight sm:mt-8 sm:text-7xl"
                >
                    Shorten links. <br class="sm:hidden" />
                    <span
                        class="bg-gradient-to-r from-[#FF4433] via-[#ff6042] to-[#ff7c5c] bg-clip-text text-transparent"
                    >
                        Track performance.
                    </span>
                </h1>

                <p
                    class="mx-auto mt-4 max-w-2xl text-sm leading-relaxed text-[#52525b] sm:mt-8 sm:text-lg dark:text-[#A1A09A]"
                >
                    Create clean, memorable links in seconds. Optimize your
                    digital reach, protect your assets, and gather detailed
                    behavioral analytics seamlessly.
                </p>

                <div
                    class="mx-auto mt-8 max-w-3xl rounded-2xl border border-black/[0.12] bg-white/80 p-4 shadow-[0_20px_50px_rgba(0,0,0,0.06)] backdrop-blur-xl transition-all duration-300 focus-within:border-[#FF4433]/40 focus-within:ring-4 focus-within:ring-[#FF4433]/5 sm:mt-12 sm:p-5 dark:border-[#3E3E3A]/60 dark:bg-[#111110] dark:shadow-[0_15px_50px_rgba(0,0,0,0.4)] dark:focus-within:border-[#FF4433]/40"
                >
                    <form
                        @submit.prevent="submit"
                        class="flex flex-col gap-3.5 sm:flex-row"
                    >
                        <div class="group relative w-full flex-1">
                            <div
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-base transition-transform duration-200 group-focus-within:scale-110"
                            >
                                🔗
                            </div>

                            <input
                                v-model="longUrl"
                                @input="
                                    result = null;
                                    copied = false;
                                    error = null;
                                "
                                required
                                type="url"
                                placeholder="Paste your long link here..."
                                class="w-full rounded-xl border border-black/[0.14] bg-white/70 py-3.5 pr-4 pl-12 text-base text-[#18181b] placeholder-[#88888d] transition-all duration-200 outline-none focus:border-[#FF4433] focus:bg-white sm:py-4 dark:border-[#3E3E3A] dark:bg-[#161615] dark:text-[#EDEDEC] dark:placeholder-[#706f6c] dark:focus:bg-[#161615]"
                            />
                        </div>

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center rounded-xl bg-[#FF4433] px-8 py-3.5 text-base font-semibold whitespace-nowrap text-white shadow-[0_4px_12px_rgba(255,68,51,0.2)] transition-all duration-200 hover:scale-[1.02] hover:bg-[#e63222] active:scale-[0.98] sm:w-auto sm:py-4"
                        >
                            Shorten URL
                        </button>
                    </form>
                    <p v-if="error" class="mt-2 text-sm text-[#b91c1c]">
                        {{ error }}
                    </p>

                    <div
                        v-if="result"
                        class="mx-auto mt-6 max-w-3xl animate-in duration-500 fade-in slide-in-from-top-4"
                    >
                        <div
                            class="flex items-center gap-3 rounded-xl border border-[#FF4433]/20 bg-[#FF4433]/5 p-4 dark:border-[#FF4433]/30 dark:bg-[#FF4433]/10"
                        >
                            <div
                                class="flex-1 truncate text-sm font-medium text-[#18181b] dark:text-[#EDEDEC]"
                            >
                                <span class="mr-2 text-[#FF4433]">Result:</span>

                                <a
                                    :href="'/' + result.short_code"
                                    target="_blank"
                                    class="hover:underline"
                                >
                                    {{ url }}/{{ result.short_code }}
                                </a>
                            </div>

                            <button
                                type="button"
                                @click="copyLink"
                                class="rounded-lg px-3 py-1.5 text-xs font-semibold transition-all duration-200"
                                :class="
                                    copied
                                        ? 'bg-[#FF4433] text-white shadow-[0_4px_12px_rgba(255,68,51,0.25)]'
                                        : 'bg-white text-[#18181b] ring-1 ring-black/[0.1] hover:bg-neutral-50'
                                "
                            >
                                <span v-if="copied">✓ Copied</span>
                                <span v-else>Copy</span>
                            </button>
                        </div>
                    </div>

                    <div
                        class="mt-4 flex flex-col items-start justify-between gap-4 rounded-xl border border-black/[0.08] bg-black/[0.04] p-4 text-left sm:mt-5 md:flex-row md:items-center dark:border-[#3E3E3A]/30 dark:bg-[#fffaed03]"
                    >
                        <div class="flex items-start gap-3">
                            <span class="shrink-0 text-base">⚠️</span>
                            <p
                                class="text-xs leading-normal text-[#52525b] sm:text-sm dark:text-[#A1A09A]"
                            >
                                Using without logging in? Your links will
                                <strong
                                    class="text-[#b91c1c] dark:text-[#ff6b5c]"
                                    >expire in 24 hours</strong
                                >
                                and link tracking diagnostics will be
                                unavailable.
                            </p>
                        </div>
                        <Link
                            :href="register()"
                            class="self-end text-xs font-semibold whitespace-nowrap text-[#FF4433] transition-all duration-200 hover:text-[#ff7c5c] hover:underline sm:text-sm md:self-auto"
                        >
                            Create Free Account →
                        </Link>
                    </div>
                </div>

                <section
                    class="mt-20 grid grid-cols-1 gap-6 text-left sm:mt-28 sm:gap-8 md:grid-cols-3"
                >
                    <div
                        class="group rounded-xl border border-black/[0.1] bg-white/60 p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] transition-all duration-300 hover:-translate-y-1 hover:border-black/[0.16] hover:bg-white sm:p-8 dark:border-[#3E3E3A]/40 dark:bg-[#161615]/50 dark:shadow-sm dark:hover:border-[#3E3E3A]/80 dark:hover:bg-[#161615]/80"
                    >
                        <div
                            class="mb-4 inline-block text-3xl transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3 sm:mb-5"
                        >
                            📊
                        </div>
                        <h3
                            class="mb-2 text-lg font-semibold text-[#18181b] transition-colors duration-200 group-hover:text-[#FF4433] dark:text-[#EDEDEC]"
                        >
                            Advanced Analytics
                        </h3>
                        <p
                            class="text-sm leading-relaxed text-[#52525b] dark:text-[#A1A09A]"
                        >
                            Track every single click globally. Filter by device
                            types, operating systems, and referrers instantly.
                        </p>
                    </div>

                    <div
                        class="group rounded-xl border border-black/[0.1] bg-white/60 p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] transition-all duration-300 hover:-translate-y-1 hover:border-black/[0.16] hover:bg-white sm:p-8 dark:border-[#3E3E3A]/40 dark:bg-[#161615]/50 dark:shadow-sm dark:hover:border-[#3E3E3A]/80 dark:hover:bg-[#161615]/80"
                    >
                        <div
                            class="mb-4 inline-block text-3xl transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3 sm:mb-5"
                        >
                            🔒
                        </div>
                        <h3
                            class="mb-2 text-lg font-semibold text-[#18181b] transition-colors duration-200 group-hover:text-[#FF4433] dark:text-[#EDEDEC]"
                        >
                            Secure & Encrypted
                        </h3>
                        <p
                            class="text-sm leading-relaxed text-[#52525b] dark:text-[#A1A09A]"
                        >
                            All routing features built-in DDoS monitoring,
                            malware filtering, and automated threat mitigation.
                        </p>
                    </div>

                    <div
                        class="group rounded-xl border border-black/[0.1] bg-white/60 p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] transition-all duration-300 hover:-translate-y-1 hover:border-black/[0.16] hover:bg-white sm:p-8 dark:border-[#3E3E3A]/40 dark:bg-[#161615]/50 dark:shadow-sm dark:hover:border-[#3E3E3A]/80 dark:hover:bg-[#161615]/80"
                    >
                        <div
                            class="mb-4 inline-block text-3xl transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3 sm:mb-5"
                        >
                            🔑
                        </div>
                        <h3
                            class="mb-2 text-lg font-semibold text-[#18181b] transition-colors duration-200 group-hover:text-[#FF4433] dark:text-[#EDEDEC]"
                        >
                            Password Protection
                        </h3>
                        <p
                            class="text-sm leading-relaxed text-[#52525b] dark:text-[#A1A09A]"
                        >
                            Restrict access to sensitive content. Add customized
                            password rules to your shortened links for extra
                            security.
                        </p>
                    </div>
                </section>

                <section
                    class="mt-16 rounded-2xl border border-black/[0.08] bg-white/40 p-6 text-center shadow-[0_8px_30px_rgba(0,0,0,0.02)] transition-all duration-300 hover:bg-white/70 sm:mt-20 sm:p-10 dark:border-[#3E3E3A]/30 dark:bg-[#fffaed01] dark:hover:bg-[#fffaed03]"
                >
                    <h3 class="mb-3 text-xl font-bold">
                        Shorten links on the go
                    </h3>
                    <p
                        class="mx-auto mb-6 max-w-lg text-sm leading-relaxed text-[#52525b] sm:mb-8 dark:text-[#A1A09A]"
                    >
                        Download our official mobile app to generate links,
                        manage your dashboard, and check click tracking
                        performance metrics instantly from your Android device.
                    </p>
                    <div class="flex justify-center">
                        <a
                            href="https://example.com"
                            target="_blank"
                            class="group inline-flex w-full items-center justify-center gap-2.5 rounded-xl bg-[#FF4433] px-6 py-3 text-base font-semibold text-white shadow-[0_4px_12px_rgba(255,68,51,0.2)] transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#e63222] hover:shadow-[0_6px_20px_rgba(255,68,51,0.3)] active:translate-y-0 sm:w-auto sm:px-7 sm:py-3.5"
                        >
                            <span
                                class="transition-transform duration-300 group-hover:rotate-12"
                                >🤖</span
                            >
                            Download for Android
                        </a>
                    </div>
                </section>

                <div
                    class="mt-20 border-t border-black/[0.12] pt-12 sm:mt-28 sm:pt-16 dark:border-[#3E3E3A]"
                >
                    <dl
                        class="grid grid-cols-1 gap-8 sm:grid-cols-2 sm:gap-10 lg:grid-cols-4"
                    >
                        <div
                            class="group flex cursor-default flex-col items-center"
                        >
                            <dt
                                class="text-sm text-[#71717a] transition-colors duration-200 group-hover:text-[#18181b] sm:text-base dark:text-[#A1A09A] dark:group-hover:text-[#EDEDEC]"
                            >
                                Links Created
                            </dt>
                            <dd
                                class="mt-1 text-2xl font-extrabold tracking-tight transition-transform duration-300 group-hover:scale-105 sm:mt-2 sm:text-4xl"
                            >
                                12M+
                            </dd>
                        </div>
                        <div
                            class="group flex cursor-default flex-col items-center"
                        >
                            <dt
                                class="text-sm text-[#71717a] transition-colors duration-200 group-hover:text-[#18181b] sm:text-base dark:text-[#A1A09A] dark:group-hover:text-[#EDEDEC]"
                            >
                                Clicks Tracked
                            </dt>
                            <dd
                                class="mt-1 text-2xl font-extrabold tracking-tight transition-transform duration-300 group-hover:scale-105 sm:mt-2 sm:text-4xl"
                            >
                                840M+
                            </dd>
                        </div>
                        <div
                            class="group flex cursor-default flex-col items-center"
                        >
                            <dt
                                class="text-sm text-[#71717a] transition-colors duration-200 group-hover:text-[#18181b] sm:text-base dark:text-[#A1A09A] dark:group-hover:text-[#EDEDEC]"
                            >
                                Happy Users
                            </dt>
                            <dd
                                class="mt-1 text-2xl font-extrabold tracking-tight transition-transform duration-300 group-hover:scale-105 sm:mt-2 sm:text-4xl"
                            >
                                140K+
                            </dd>
                        </div>
                        <div
                            class="group flex cursor-default flex-col items-center"
                        >
                            <dt
                                class="text-sm text-[#71717a] transition-colors duration-200 group-hover:text-[#18181b] sm:text-base dark:text-[#A1A09A] dark:group-hover:text-[#EDEDEC]"
                            >
                                Uptime Guarantee
                            </dt>
                            <dd
                                class="mt-1 text-2xl font-extrabold tracking-tight text-[#FF4433] transition-transform duration-300 group-hover:scale-105 sm:mt-2 sm:text-4xl"
                            >
                                99.9%
                            </dd>
                        </div>
                    </dl>
                </div>
            </main>

            <footer
                class="mx-auto max-w-7xl border-t border-black/[0.08] px-6 py-12 dark:border-[#3E3E3A]/20"
            >
                <div
                    class="flex flex-col items-center justify-between gap-6 text-sm text-[#71717a] md:flex-row dark:text-[#A1A09A]"
                >
                    <!-- Left Side: Copyright & Brand Ownership -->
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

                    <!-- Right Side: Policy Links -->
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
    </div>
</template>
