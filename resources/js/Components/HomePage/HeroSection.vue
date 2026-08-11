<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue'

defineProps({
    waLink: { type: String, required: true },
})
</script>

<template>
    <section
        class="min-h-screen relative overflow-hidden dark:border-b dark:border-ink/20 bg-white/60 text-ink transition-colors dark:bg-paper/[0.03] dark:text-paper sm:py-10">
        <!-- Background decoration: SVG -->
        <svg class="pointer-events-none absolute inset-0 z-0 h-full w-full text-ink/[0.06] dark:text-paper/[0.06]"
            viewBox="0 0 1440 700" preserveAspectRatio="xMidYMid slice" fill="none" aria-hidden="true">
            <pattern id="dotgrid" width="28" height="28" patternUnits="userSpaceOnUse">
                <circle cx="1.5" cy="1.5" r="1.5" fill="currentColor" />
            </pattern>
            <rect width="1440" height="700" fill="url(#dotgrid)" />

            <circle cx="160" cy="90" r="60" stroke="currentColor" class="text-ink/[0.05] dark:text-paper/[0.06]"
                stroke-width="1" fill="none" />
            <circle cx="160" cy="90" r="110" stroke="currentColor" class="text-ink/[0.04] dark:text-paper/[0.05]"
                stroke-width="1" fill="none" />
            <circle cx="160" cy="90" r="160" stroke="currentColor" class="text-ink/[0.03] dark:text-paper/[0.04]"
                stroke-width="1" fill="none" />

            <circle cx="1280" cy="600" r="100" stroke="currentColor" class="text-ink/[0.05] dark:text-paper/[0.06]"
                stroke-width="1" fill="none" />
            <circle cx="1280" cy="600" r="150" stroke="currentColor" class="text-ink/[0.04] dark:text-paper/[0.05]"
                stroke-width="1" fill="none" />
            <circle cx="1280" cy="600" r="200" stroke="currentColor" class="text-ink/[0.03] dark:text-paper/[0.04]"
                stroke-width="1" fill="none" />
        </svg>

        <div class="relative z-10 mx-auto grid items-center gap-12 px-6 md:px-20 py-16 sm:py-20 md:grid-cols-2">
            <div>
                <p class="mb-4 font-mono text-xs uppercase tracking-[0.2em] text-jade-light">
                    Asisten Ai ·
                    Bot WhatsApp</p>
                <h1 class="font-display text-4xl font-medium leading-[1.1] tracking-tight md:text-5xl">
                    Mencatat Keuangan,<br />secepat ngetik chat.
                </h1>
                <p class="mt-6 max-w-md text-base leading-relaxed text-ink/70 dark:text-paper/70">
                    Lumi adalah asisten pencatat keuangan yang tinggal di WhatsApp kamu. Tidak perlu menginstall
                    aplikasi baru, tinggal chat atau foto struk, sisanya Lumi yang catat.
                </p>
                <div class="mt-8 flex flex-wrap flex-row items-center gap-4 sm:gap-10">
                    <PrimaryButton :href="waLink" tag="a" class="sm:flex hidden">
                        Coba gratis sekarang
                    </PrimaryButton>
                    <a href="#cara-kerja"
                        class="group sm:inline-flex hidden items-center gap-1.5 text-md font-semibold text-ink/70 decoration-ink/30 underline-offset-4 transition hover:text-ink dark:text-paper/70 dark:decoration-paper/30 dark:hover:text-paper">
                        Lihat cara kerjanya
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="h-4 w-4 shrink-0 transition-transform duration-150 ease-out group-hover:translate-x-1">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </a>
                    <PrimaryButton href="#cara-kerja" class="sm:hidden inline-flex">
                        Lihat cara kerjanya
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                            class="h-4 w-6 pt-0.5 shrink-0">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </PrimaryButton>
                </div>
            </div>

            <!-- Signature: chat bubble → ledger entry -->
            <div class="relative">
                <div
                    class="rounded-2xl border border-ink/10 bg-ink/[0.03] p-5 shadow-md backdrop-blur-sm dark:border-paper/10 dark:bg-paper/[0.04]">
                    <div class="mb-4 flex justify-end">
                        <div
                            class="max-w-[80%] rounded-2xl rounded-tr-sm bg-[#dcf8c6] dark:bg-wa-light px-4 py-2.5 text-sm text-ink dark:text-paper">
                            beli kopi 25rb pake gopay
                        </div>
                    </div>
                    <div class="my-4 flex items-center gap-3 text-ink/30 dark:text-paper/30">
                        <span class="h-px flex-1 border-t border-dashed border-ink/20 dark:border-paper/20"></span>
                        <span class="font-mono text-[10px] uppercase tracking-widest">tercatat</span>
                        <span class="h-px flex-1 border-t border-dashed border-ink/20 dark:border-paper/20"></span>
                    </div>
                    <div
                        class="rounded-lg border border-ink/10 bg-ink/[0.04] p-4 font-mono text-sm dark:border-paper/10 dark:bg-paper/[0.05]">
                        <div class="flex items-center justify-between text-ink/60 dark:text-paper/60">
                            <span>Kategori</span>
                            <span class="text-ink dark:text-paper">Makan &amp; Minum</span>
                        </div>
                        <div class="mt-2 flex items-center justify-between text-ink/60 dark:text-paper/60">
                            <span>Metode</span>
                            <span class="text-ink dark:text-paper">GoPay</span>
                        </div>
                        <div
                            class="mt-3 flex items-center justify-between border-t border-dashed border-ink/15 pt-3 dark:border-paper/15">
                            <span class="text-ink/60 dark:text-paper/60">Nominal</span>
                            <span class="text-lg font-medium text-gold">-Rp25.000</span>
                        </div>
                    </div>
                </div>
                <!-- <div class="pointer-events-none absolute -inset-6 -z-10 rounded-[2rem] bg-jade/10 blur-2xl"></div> -->
            </div>
        </div>
    </section>
</template>