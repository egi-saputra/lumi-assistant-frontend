<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

defineProps({
    waLink: { type: String, required: true },
})

/* ─── Animasi mockup: ketik → kirim → proses → struk muncul ─── */
const fullText = 'beli kopi 25rb pake gopay'
const typedText = ref('')
const phase = ref('idle') // idle -> typing -> sent -> processing -> done

let typingInterval = null
let timers = []

function clearAllTimers() {
    timers.forEach((t) => clearTimeout(t))
    timers = []
    if (typingInterval) {
        clearInterval(typingInterval)
        typingInterval = null
    }
}

function runAnimation() {
    clearAllTimers()
    typedText.value = ''
    phase.value = 'idle'

    // Jeda sebelum mulai ngetik (biar terasa natural)
    timers.push(
        setTimeout(() => {
            phase.value = 'typing'
            let i = 0
            typingInterval = setInterval(() => {
                i++
                typedText.value = fullText.slice(0, i)
                if (i >= fullText.length) {
                    clearInterval(typingInterval)
                    typingInterval = null

                    timers.push(setTimeout(() => (phase.value = 'sent'), 350))
                    timers.push(setTimeout(() => (phase.value = 'processing'), 350 + 550))
                    timers.push(setTimeout(() => (phase.value = 'done'), 350 + 550 + 700))
                    // Restart loop setelah struk sempat tampil beberapa detik
                    timers.push(setTimeout(() => runAnimation(), 350 + 550 + 700 + 4500))
                }
            }, 45)
        }, 700),
    )
}

onMounted(() => {
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches
    if (prefersReduced) {
        // Hormati preferensi user, langsung tampilkan hasil akhir tanpa animasi
        typedText.value = fullText
        phase.value = 'done'
        return
    }
    runAnimation()
})

onUnmounted(() => clearAllTimers())
</script>

<template>
    <section
        class="min-h-screen relative overflow-hidden dark:border-b dark:border-ink/20 bg-white/40 text-ink transition-colors dark:bg-paper/[0.03] dark:text-paper sm:py-10">
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

        <div class="relative z-10 mx-auto grid items-center gap-12 px-6 md:px-20 py-12 sm:py-20 md:grid-cols-2 reveal">
            <div>
                <p class="mb-4 font-mono text-xs uppercase tracking-[0.2em] text-jade-light">
                    Asisten Ai · Bot WhatsApp
                </p>
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

            <!-- Signature: chat bubble → ledger entry (animated) -->
            <div class="relative">
                <div
                    class="rounded-2xl border border-ink/10 bg-ink/[0.03] p-5 shadow-md backdrop-blur-sm dark:border-paper/10 dark:bg-paper/[0.04]">

                    <!-- Chat bubble: dots typing -> teks -> centang -->
                    <div class="mb-4 flex min-h-[46px] justify-end">
                        <div v-if="phase !== 'idle'"
                            class="max-w-[80%] rounded-2xl rounded-tr-sm bg-[#dcf8c6] px-4 py-2.5 text-sm text-ink transition-all duration-200 dark:bg-wa-light dark:text-paper">
                            <div v-if="phase === 'typing' && typedText.length === 0"
                                class="flex items-center gap-1 py-1">
                                <span class="typing-dot"></span>
                                <span class="typing-dot" style="animation-delay: 0.15s"></span>
                                <span class="typing-dot" style="animation-delay: 0.3s"></span>
                            </div>
                            <div v-else class="flex items-end gap-1.5">
                                <span>{{ typedText }}</span>
                                <span v-if="phase === 'typing'" class="typing-cursor"></span>
                                <svg v-if="phase !== 'typing'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 15"
                                    class="mb-0.5 h-3.5 w-3.5 shrink-0 transition-colors duration-300"
                                    :class="phase === 'sent' || phase === 'processing' || phase === 'done' ? 'text-sky-500' : 'text-ink/30'"
                                    fill="currentColor">
                                    <path
                                        d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.365.365 0 0 0-.51.028l-.413.442a.364.364 0 0 0 .028.513l1.415 1.285a.32.32 0 0 0 .484-.032l6.526-8.373a.365.365 0 0 0-.063-.51z" />
                                    <path
                                        d="M11.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L4.666 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185a.32.32 0 0 0 .484-.033l6.373-8.176a.365.365 0 0 0-.063-.51z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Divider + struk: fade-slide in setelah pesan "diproses" -->
                    <Transition name="receipt">
                        <div v-if="phase === 'processing' || phase === 'done'">
                            <div class="my-4 flex items-center gap-3 text-ink/30 dark:text-paper/30">
                                <span
                                    class="h-px flex-1 border-t border-dashed border-ink/20 dark:border-paper/20"></span>
                                <span class="font-mono text-[10px] uppercase tracking-widest">tercatat</span>
                                <span
                                    class="h-px flex-1 border-t border-dashed border-ink/20 dark:border-paper/20"></span>
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
                    </Transition>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
/* ─── Typing dots ─── */
.typing-dot {
    width: 6px;
    height: 6px;
    border-radius: 9999px;
    background: currentColor;
    opacity: 0.5;
    animation: typingBounce 1s infinite ease-in-out;
}

@keyframes typingBounce {

    0%,
    60%,
    100% {
        transform: translateY(0);
        opacity: 0.4;
    }

    30% {
        transform: translateY(-3px);
        opacity: 0.9;
    }
}

/* ─── Blinking cursor saat mengetik ─── */
.typing-cursor {
    display: inline-block;
    width: 2px;
    height: 14px;
    background: currentColor;
    opacity: 0.6;
    animation: cursorBlink 0.9s step-end infinite;
}

@keyframes cursorBlink {

    0%,
    100% {
        opacity: 0.6;
    }

    50% {
        opacity: 0;
    }
}

/* ─── Transisi struk muncul ─── */
.receipt-enter-active {
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}

.receipt-leave-active {
    transition: all 0.3s ease;
}

.receipt-enter-from {
    opacity: 0;
    transform: translateY(12px);
}

.receipt-leave-to {
    opacity: 0;
    transform: translateY(-8px);
}

@media (prefers-reduced-motion: reduce) {

    .typing-dot,
    .typing-cursor {
        animation: none !important;
    }
}
</style>