<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const langkah = [
    {
        no: '01',
        judul: 'Kirim pesan atau foto struk',
        teks: 'Ketik "beli kopi 25rb pake gopay" atau langsung foto struk belanjaan. Nggak ada form, nggak ada aplikasi baru.',
    },
    {
        no: '02',
        judul: 'Lumi catat otomatis',
        teks: 'Nominal, kategori, dan metode pembayaran langsung kebaca dan tersimpan dalam hitungan detik.',
    },
    {
        no: '03',
        judul: 'Lihat rekap kapan aja',
        teks: 'Minta rekap harian, mingguan, atau bulanan. Bisa unduh langsung sebagai file Excel/PDF.',
    },
]

/* ─── Animasi mockup HP: ketik di composer → bubble terkirim → centang → bot balas ─── */
const fullText = 'beli kopi 25rb pake gopay'
const typedText = ref('')
// idle -> typing -> sent -> delivered -> read -> bot-typing -> done
const phase = ref('idle')

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

    // Jeda sebelum mulai ngetik
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

                    const t1 = 300 // jeda sebelum terkirim
                    const t2 = t1 + 350 // sent -> delivered
                    const t3 = t2 + 400 // delivered -> read (centang biru)
                    const t4 = t3 + 500 // read -> lumi mulai "mengetik"
                    const t5 = t4 + 900 // bot-typing -> done (struk muncul)
                    const t6 = t5 + 4500 // hold, lalu ulangi animasi

                    timers.push(setTimeout(() => (phase.value = 'sent'), t1))
                    timers.push(setTimeout(() => (phase.value = 'delivered'), t2))
                    timers.push(setTimeout(() => (phase.value = 'read'), t3))
                    timers.push(setTimeout(() => (phase.value = 'bot-typing'), t4))
                    timers.push(setTimeout(() => (phase.value = 'done'), t5))
                    timers.push(setTimeout(() => runAnimation(), t6))
                }
            }, 45)
        }, 700),
    )
}

onMounted(() => {
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches
    if (prefersReduced) {
        typedText.value = fullText
        phase.value = 'done'
        return
    }
    runAnimation()
})

onUnmounted(() => clearAllTimers())
</script>

<template>
    <section id="cara-kerja" class="mx-auto">

        <div class="bg-paper dark:bg-ink grid items-start sm:py-24 py-10 gap-16 px-6 md:px-20 md:grid-cols-2">
            <div class="reveal">
                <div class="mb-14 max-w-lg">
                    <p class="mb-3 font-mono text-xs uppercase tracking-[0.2em] text-jade">Cara kerja</p>
                    <h2 class="font-display text-3xl font-medium tracking-tight text-ink dark:text-paper md:text-4xl">
                        Tiga langkah, selesai.
                    </h2>
                </div>

                <div class="relative border-l border-dashed border-ink/15 pl-8 dark:border-paper/15">
                    <div v-for="(item, i) in langkah" :key="item.no"
                        :class="['relative', i !== langkah.length - 1 ? 'pb-12' : '']">
                        <span
                            class="absolute sm:-left-[41px] -left-[48px] top-0 grid h-8 w-8 place-items-center rounded-full bg-ink font-mono text-xs text-paper dark:bg-paper dark:text-ink md:-left-[49px]">
                            {{ item.no }}
                        </span>
                        <h3 class="font-display text-xl font-medium text-ink dark:text-paper">{{ item.judul }}</h3>
                        <p class="mt-2 max-w-lg text-sm leading-relaxed text-slate">{{ item.teks }}</p>
                    </div>
                </div>
            </div>

            <!-- Phone mockup showing WhatsApp chat -->
            <div class="relative mx-auto w-[260px] md:w-[280px]">
                <div class="relative rounded-[2.25rem] bg-gray-900 p-[10px] shadow-2xl reveal">
                    <!-- Notch -->
                    <div class="absolute left-1/2 top-[20px] z-20 h-4 w-20 -translate-x-1/2 rounded-full bg-gray-900">
                    </div>

                    <!-- Screen -->
                    <div class="relative flex h-[520px] flex-col overflow-hidden rounded-[1.75rem] bg-[#ece5dd]">
                        <!-- Status bar -->
                        <div
                            class="flex shrink-0 items-center justify-between px-5 pb-2 pt-2.5 text-[11px] font-medium text-ink">
                            <span>9:41</span>
                            <div class="flex items-center gap-1.5">
                                <svg width="14" height="10" viewBox="0 0 14 10" fill="currentColor">
                                    <rect x="0" y="6" width="2.5" height="4" rx="0.5" />
                                    <rect x="4" y="4" width="2.5" height="6" rx="0.5" />
                                    <rect x="8" y="2" width="2.5" height="8" rx="0.5" />
                                    <rect x="11.5" y="0" width="2.5" height="10" rx="0.5" opacity="0.4" />
                                </svg>
                                <svg width="16" height="11" viewBox="0 0 16 11" fill="none">
                                    <rect x="0.5" y="0.5" width="13" height="10" rx="2" stroke="currentColor" />
                                    <rect x="1.5" y="1.5" width="11" height="8" rx="1" fill="currentColor" />
                                    <rect x="14" y="3.5" width="1.5" height="4" rx="0.75" fill="currentColor" />
                                </svg>
                            </div>
                        </div>

                        <!-- WA header -->
                        <div class="flex shrink-0 items-center gap-2.5 bg-[#f0f0f0] px-3 py-2.5">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 12H5M12 19l-7-7 7-7" />
                            </svg>
                            <div
                                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-ink/20 text-sm font-medium text-ink">
                                L
                            </div>
                            <div class="min-w-0 leading-tight">
                                <p class="truncate text-sm font-medium text-ink">Lumi Assistant</p>
                                <p class="text-[10px] text-ink/75">
                                    {{ phase === 'bot-typing' ? 'sedang mengetik...' : 'online' }}
                                </p>
                            </div>
                        </div>

                        <!-- Chat body -->
                        <div class="flex flex-1 flex-col justify-end gap-2.5 overflow-y-auto px-3 py-4">
                            <!-- Outgoing: user message -->
                            <Transition name="bubble">
                                <div v-if="phase !== 'idle' && phase !== 'typing'" class="flex justify-end">
                                    <div
                                        class="max-w-[78%] rounded-lg rounded-tr-none bg-[#dcf8c6] px-2.5 py-1.5 shadow-sm">
                                        <p class="text-[12.5px] leading-snug text-ink">{{ fullText }}</p>
                                        <p
                                            class="mt-0.5 flex items-center justify-end gap-1 text-[9px] leading-none text-ink/40">
                                            09:41
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 15"
                                                class="h-3 w-3 shrink-0 transition-colors duration-300" :class="phase === 'read' || phase === 'bot-typing' || phase === 'done'
                                                    ? 'text-sky-500'
                                                    : 'text-ink/40'" fill="currentColor">
                                                <path v-if="phase !== 'sent'"
                                                    d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.365.365 0 0 0-.51.028l-.413.442a.364.364 0 0 0 .028.513l1.415 1.285a.32.32 0 0 0 .484-.032l6.526-8.373a.365.365 0 0 0-.063-.51z" />
                                                <path
                                                    d="M11.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L4.666 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185a.32.32 0 0 0 .484-.033l6.373-8.176a.365.365 0 0 0-.063-.51z" />
                                            </svg>
                                        </p>
                                    </div>
                                </div>
                            </Transition>

                            <!-- Incoming: bot mengetik -->
                            <Transition name="bubble" mode="out-in">
                                <div v-if="phase === 'bot-typing'" key="typing" class="flex justify-start">
                                    <div class="rounded-lg rounded-tl-none bg-white px-3 py-2.5 shadow-sm">
                                        <div class="flex items-center gap-1">
                                            <span class="typing-dot"></span>
                                            <span class="typing-dot" style="animation-delay: 0.15s"></span>
                                            <span class="typing-dot" style="animation-delay: 0.3s"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Incoming: bot confirmation -->
                                <div v-else-if="phase === 'done'" key="receipt" class="flex justify-start">
                                    <div class="max-w-[82%] rounded-lg rounded-tl-none bg-white px-3 py-2 shadow-sm">
                                        <p
                                            class="flex items-center gap-1 text-[12.5px] font-medium leading-snug text-ink">
                                            Sip, tercatat
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                                class="text-wa shrink-0">
                                                <circle cx="12" cy="12" r="10" fill="currentColor" />
                                                <path d="M8 12.5l2.5 2.5L16 9" stroke="white" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </p>
                                        <div
                                            class="mt-1.5 border-t border-dashed border-ink/10 pt-1.5 font-mono text-[10.5px] text-ink/60">
                                            <div class="flex items-center justify-between gap-3 py-0.5">
                                                <span class="shrink-0">Kategori</span>
                                                <span class="truncate text-right text-ink">Makan &amp; Minum</span>
                                            </div>
                                            <div class="flex items-center justify-between gap-3 py-0.5">
                                                <span class="shrink-0">Metode</span>
                                                <span class="truncate text-right text-ink">GoPay</span>
                                            </div>
                                            <div
                                                class="mt-3 flex items-center justify-between gap-3 border-t border-dashed border-ink/10 py-0.5 pt-1.5 font-medium">
                                                <span class="shrink-0 text-ink/60">Nominal</span>
                                                <span class="text-right text-gold">-Rp25.000</span>
                                            </div>
                                        </div>
                                        <p class="mt-1 text-right text-[9px] leading-none text-ink/40">09:41</p>
                                    </div>
                                </div>
                            </Transition>
                        </div>

                        <!-- Input bar -->
                        <div class="flex shrink-0 items-center gap-2 bg-[#f0f0f0] px-3 py-2">
                            <div class="flex-1 rounded-full bg-white px-3 py-1.5 text-[11px] text-ink/40">
                                <span v-if="phase === 'typing'" class="flex items-center text-ink">
                                    {{ typedText }}
                                    <span class="typing-cursor"></span>
                                </span>
                                <span v-else>Ketik pesan</span>
                            </div>
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-wa">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="white">
                                    <path d="M2 21l21-9L2 3v7l15 2-15 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pointer-events-none absolute -inset-8 -z-10 rounded-[3rem] bg-jade/10 blur-2xl"></div>
            </div>
        </div>
    </section>
</template>

<style scoped>
/* ─── Typing dots (bot "sedang mengetik") ─── */
.typing-dot {
    width: 6px;
    height: 6px;
    border-radius: 9999px;
    background: currentColor;
    color: #94a3b8;
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

/* ─── Blinking cursor saat mengetik di composer ─── */
.typing-cursor {
    display: inline-block;
    width: 2px;
    height: 12px;
    margin-left: 1px;
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

/* ─── Transisi bubble muncul ─── */
.bubble-enter-active {
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
}

.bubble-leave-active {
    transition: all 0.2s ease;
}

.bubble-enter-from {
    opacity: 0;
    transform: translateY(10px);
}

.bubble-leave-to {
    opacity: 0;
    transform: translateY(-6px);
}

@media (prefers-reduced-motion: reduce) {

    .typing-dot,
    .typing-cursor {
        animation: none !important;
    }
}
</style>