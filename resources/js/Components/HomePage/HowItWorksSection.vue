<script setup>
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
</script>

<template>
    <section id="cara-kerja" class="mx-auto">
        <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="0.8"
                d="M0,288L60,282.7C120,277,240,267,360,234.7C480,203,600,149,720,112C840,75,960,53,1080,74.7C1200,96,1320,160,1380,192L1440,224L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
            </path>
        </svg> -->
        <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="0.8"
                d="M0,320L60,277.3C120,235,240,149,360,112C480,75,600,85,720,96C840,107,960,117,1080,122.7C1200,128,1320,128,1380,128L1440,128L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
            </path>
        </svg> -->

        <div class="grid items-start sm:py-24 py-10 gap-16 px-6 md:px-20 md:grid-cols-2">
            <div>
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
                            class="absolute -left-[41px] top-0 grid h-8 w-8 place-items-center rounded-full bg-ink font-mono text-xs text-paper dark:bg-paper dark:text-ink md:-left-[49px]">
                            {{ item.no }}
                        </span>
                        <h3 class="font-display text-xl font-medium text-ink dark:text-paper">{{ item.judul }}</h3>
                        <p class="mt-2 max-w-lg text-sm leading-relaxed text-slate">{{ item.teks }}</p>
                    </div>
                </div>
            </div>

            <!-- Phone mockup showing WhatsApp chat -->
            <div class="relative mx-auto w-[260px] md:w-[280px]">
                <div class="relative rounded-[2.25rem] bg-gray-900 p-[10px] shadow-2xl">
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
                                <p class="text-[10px] text-ink/75">online</p>
                            </div>
                        </div>

                        <!-- Chat body -->
                        <div class="flex flex-1 flex-col gap-2.5 overflow-y-auto px-3 py-4">
                            <!-- Outgoing: user message -->
                            <div class="flex justify-end">
                                <div
                                    class="max-w-[78%] rounded-lg rounded-tr-none bg-[#dcf8c6] px-2.5 py-1.5 shadow-sm">
                                    <p class="text-[12.5px] leading-snug text-ink">beli kopi 25rb pake gopay</p>
                                    <p class="mt-0.5 text-right text-[9px] leading-none text-ink/40">09:41
                                        &#10003;&#10003;</p>
                                </div>
                            </div>

                            <!-- Incoming: bot confirmation -->
                            <div class="flex justify-start">
                                <div class="max-w-[82%] rounded-lg rounded-tl-none bg-white px-3 py-2 shadow-sm">
                                    <p class="flex items-center gap-1 text-[12.5px] font-medium leading-snug text-ink">
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
                                            class="flex items-center justify-between gap-3 border-t border-dashed border-ink/10 py-0.5 pt-1.5 font-medium">
                                            <span class="shrink-0 text-ink/60">Nominal</span>
                                            <span class="text-right text-gold">-Rp25.000</span>
                                        </div>
                                    </div>
                                    <p class="mt-1 text-right text-[9px] leading-none text-ink/40">09:41</p>
                                </div>
                            </div>
                        </div>

                        <!-- Input bar -->
                        <div class="flex shrink-0 items-center gap-2 bg-[#f0f0f0] px-3 py-2">
                            <div class="flex-1 rounded-full bg-white px-3 py-1.5 text-[11px] text-ink/40">
                                Ketik pesan
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

        <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="0.8"
                d="M0,288L120,256C240,224,480,160,720,160C960,160,1200,224,1320,256L1440,288L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
            </path>
        </svg> -->
        <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="0.8"
                d="M0,288L60,282.7C120,277,240,267,360,234.7C480,203,600,149,720,112C840,75,960,53,1080,74.7C1200,96,1320,160,1380,192L1440,224L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
            </path>
        </svg> -->
    </section>
</template>