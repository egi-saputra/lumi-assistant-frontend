<script setup>
import { ref, computed } from 'vue'

const testimoni = [
    {
        nama: 'Abdul Jabar',
        peran: 'Pemilik warung kopi',
        avatar: 'AJ',
        teks: 'Dulu nyatet pengeluaran suka lupa, sekarang tinggal chat Lumi tiap abis belanja bahan baku. Rekap bulanan langsung rapi, gampang banget dibawa buat itung untung rugi.',
    },
    {
        nama: 'Muhammad Abi',
        peran: 'Freelancer desain',
        avatar: 'MA',
        teks: 'Paling suka bagian foto struk, jadi nggak perlu ngetik manual satu-satu. Lumi bacanya cepet dan kategorinya udah pas dari awal.',
    },
    {
        nama: 'Hidayatul Fahmi',
        peran: 'Karyawan swasta',
        avatar: 'HF',
        teks: 'Awalnya iseng coba karena penasaran, eh ternyata beneran kepake tiap hari. Sekarang jadi tau kemana aja uang jajan bulanan perginya.',
    },
    {
        nama: 'Cantika Apriliani',
        peran: 'Mahasiswa',
        avatar: 'CA',
        teks: 'Simpel banget, nggak ribet buka aplikasi baru. Tinggal chat kayak biasa, catatan keuangan langsung update.',
    },
    {
        nama: 'Apriyanti',
        peran: 'Ibu rumah tangga',
        avatar: 'AP',
        teks: 'Buat ngatur uang belanja bulanan jadi lebih terkontrol. Tinggal minta rekap mingguan, langsung kelihatan pos mana yang paling boros.',
    },
]

const active = ref(0)

function next() {
    active.value = (active.value + 1) % testimoni.length
}

function prev() {
    active.value = (active.value - 1 + testimoni.length) % testimoni.length
}

function goTo(i) {
    active.value = i
}

const current = computed(() => testimoni[active.value])
</script>

<template>
    <section id="testimoni" class="mx-auto bg-paper dark:bg-ink/80 dark:text-paper">

        <div class="px-6 md:px-20 sm:py-24 py-16">
            <div class="text-center mb-14 reveal">
                <p class="mb-3 font-mono text-xs uppercase tracking-[0.2em] text-jade">apa kata mereka</p>
                <h2 class="font-display text-3xl font-medium tracking-tight text-ink dark:text-paper md:text-4xl">
                    Dipakai dan dipercaya.
                </h2>
                <p class="mt-4 text-sm leading-relaxed text-slate">
                    Cerita langsung dari orang-orang yang udah pakai Lumi buat mencatat keuangan sehari-hari.
                </p>
            </div>

            <div class="mx-auto max-w-6xl reveal">
                <div
                    class="relative overflow-hidden rounded-2xl border-2 border-ink bg-white/80 p-8 text-ink shadow-[6px_6px_0_0_theme(colors.ink)] dark:border-jade-light dark:bg-black/30 dark:text-paper dark:shadow-[6px_6px_0_0_theme(colors.jade)] md:p-10">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-8 w-8 text-ink/25 dark:text-jade/25">
                        <path
                            d="M7.17 6A5.17 5.17 0 002 11.17V18h6.83v-6.83H4.5a2.67 2.67 0 012.67-2.67V6zm10 0A5.17 5.17 0 0012 11.17V18h6.83v-6.83H14.5a2.67 2.67 0 012.67-2.67V6z" />
                    </svg>

                    <transition name="fade" mode="out-in">
                        <div :key="active">
                            <p
                                class="mt-5 min-h-[6.5rem] text-base leading-relaxed text-ink/80 dark:text-paper/80 md:text-lg">
                                {{ current.teks }}
                            </p>

                            <div class="mt-8 flex items-center gap-3">
                                <span
                                    class="grid h-11 w-11 shrink-0 place-items-center rounded-full border-2 border-ink bg-ink/10 font-display text-base font-medium text-ink dark:text-jade dark:border-paper/40 dark:bg-jade/15">
                                    {{ current.avatar }}
                                </span>
                                <div class="min-w-0 leading-tight">
                                    <p class="truncate text-sm font-medium text-ink dark:text-paper">{{ current.nama }}
                                    </p>
                                    <p class="truncate text-xs text-slate">{{ current.peran }}</p>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>

                <!-- Controls -->
                <div class="mt-8 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <button v-for="(item, i) in testimoni" :key="i" type="button" @click="goTo(i)"
                            :aria-label="`Lihat testimoni ${i + 1}`"
                            class="h-1.5 rounded-full transition-all duration-300" :class="active === i
                                ? 'w-6 bg-ink dark:bg-jade'
                                : 'w-1.5 bg-ink/15 hover:bg-ink/25 dark:bg-paper/15 dark:hover:bg-paper/25'">
                        </button>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button" @click="prev" aria-label="Testimoni sebelumnya"
                            class="grid h-9 w-9 place-items-center rounded-full border-2 border-ink bg-paper text-ink shadow-[2px_2px_0_0_theme(colors.ink)] transition-all duration-150 ease-out hover:bg-ink/5 active:translate-x-[2px] active:translate-y-[2px] active:shadow-none dark:border-paper dark:bg-black/30 dark:text-paper dark:shadow-[2px_2px_0_0_theme(colors.paper)] dark:hover:bg-paper/5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="h-4 w-4">
                                <path d="M15 18l-6-6 6-6" />
                            </svg>
                        </button>
                        <button type="button" @click="next" aria-label="Testimoni berikutnya"
                            class="grid h-9 w-9 place-items-center rounded-full border-2 border-ink bg-paper text-ink shadow-[2px_2px_0_0_theme(colors.ink)] transition-all duration-150 ease-out hover:bg-ink/5 active:translate-x-[2px] active:translate-y-[2px] active:shadow-none dark:border-paper dark:bg-black/30 dark:text-paper dark:shadow-[2px_2px_0_0_theme(colors.paper)] dark:hover:bg-paper/5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="h-4 w-4">
                                <path d="M9 18l6-6-6-6" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="dark:block hidden -mt-24">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#1B1B1D" fill-opacity="1"
                    d="M0,192L120,208C240,224,480,256,720,250.7C960,245,1200,203,1320,181.3L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
                </path>
            </svg>
        </div> -->
    </section>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.25s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>