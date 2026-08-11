<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { ref } from 'vue'

defineProps({
    waLink: { type: String, required: true },
})

const faqs = [
    {
        q: 'Apakah Lumi aman untuk data keuangan saya?',
        a: 'Tentu saja. Semua data dienkripsi dan cuma bisa diakses oleh kamu sendiri. Kami tidak pernah membagikan data transaksi kamu kepada pihak ketiga mana pun dan juga tidak berurusan dengan politik atau kepentingan negara lainnya.',
    },
    {
        q: 'Apakah saya harus install aplikasi tambahan?',
        a: 'Nggak perlu. Lumi jalan sepenuhnya lewat WhatsApp yang udah ada di HP kamu. Tinggal chat atau foto struk, nggak ada aplikasi baru yang harus di-download.',
    },
    {
        q: 'Format transaksi seperti apa yang bisa dikenali Lumi?',
        a: 'Lumi bisa mengenali chat natural kayak "beli kopi 25rb pake gopay" atau "makan siang 35000 cash", sampai foto struk belanja. Nggak perlu format kaku, tinggal ngetik kayak ngobrol biasa.',
    },
    {
        q: 'Bagaimana cara melihat rekap pengeluaran saya?',
        a: 'Tinggal minta lewat chat, misalnya "rekap bulan ini" atau "total pengeluaran minggu lalu". Lumi juga bisa kirim rekap dalam bentuk file Excel atau PDF kalau kamu butuh buat disimpan.',
    },
    {
        q: 'Apakah Lumi berbayar?',
        a: 'Lumi bisa dicoba gratis buat kamu yang baru mulai. Untuk fitur lanjutan seperti rekap otomatis dan integrasi multi-akun, ada paket berbayar dengan harga yang terjangkau.',
    },
]

const openIndex = ref(0)

function toggle(i) {
    openIndex.value = openIndex.value === i ? -1 : i
}
</script>

<template>
    <section id="faq" class="mx-auto pt-10 bg-white/70 dark:bg-paper/[0.03]">
        <div class="dark:hidden -mt-24">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#EEF3EF" fill-opacity="1"
                    d="M0,224L60,208C120,192,240,160,360,154.7C480,149,600,171,720,186.7C840,203,960,213,1080,229.3C1200,245,1320,267,1380,277.3L1440,288L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
                </path>
            </svg>
        </div>

        <div class="dark:block hidden -mt-24">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#1B1B1D" fill-opacity="1"
                    d="M0,224L60,208C120,192,240,160,360,154.7C480,149,600,171,720,186.7C840,203,960,213,1080,229.3C1200,245,1320,267,1380,277.3L1440,288L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
                </path>
            </svg>
        </div>

        <div class="grid gap-12 px-6 md:px-20 md:grid-cols-[0.85fr_1.15fr] md:gap-16">
            <!-- Left: intro + contact -->
            <div class="reveal">
                <p class="mb-3 font-mono text-xs uppercase tracking-[0.2em] text-jade">Pertanyaan umum
                </p>
                <h2
                    class="font-display text-3xl font-medium leading-tight tracking-tight text-ink dark:text-paper md:text-4xl">
                    Masih ada yang<br />
                    <span class="text-jade-light">ingin ditanyakan?</span>
                </h2>
                <p class="mt-4 max-w-sm text-sm leading-relaxed text-slate">
                    Temukan jawaban atas pertanyaan yang paling sering diajukan sebelum menggunakan Lumi Assistant.
                </p>

                <div
                    class="hidden sm:block mt-9 rounded-2xl border border-ink/10 bg-ink/[0.03] p-6 dark:border-paper/10 dark:bg-paper/[0.04]">
                    <p class="font-display text-lg font-medium text-ink dark:text-paper">
                        Selalu ada untuk membantu Anda
                    </p>
                    <p class="mt-2 text-sm leading-relaxed text-slate">
                        Apabila Anda ingin mengetahui lebih lanjut mengenai fitur produk,
                        harga layanan, atau solusi atas kendala yang dialami, kami selalu siap membantu Anda.
                        Hubungi kami melaui email atau media sosial. Anda juga dapat
                        mengunjungi Pusat Bantuan kami.
                    </p>
                    <PrimaryButton :href="waLink" tag="a" class="mt-5 !px-5 !py-2.5 text-sm">
                        Hubungi kami
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="ml-1.5 h-4 w-4">
                            <path d="M4 12h16M14 6l6 6-6 6" />
                        </svg>
                    </PrimaryButton>
                </div>
            </div>

            <!-- Right: accordion -->
            <div class="flex flex-col gap-3 reveal">
                <div v-for="(item, i) in faqs" :key="item.q"
                    class="overflow-hidden rounded-2xl border transition-colors" :class="openIndex === i
                        ? 'border-jade/40'
                        : 'border-ink/10 dark:border-paper/10'">
                    <button type="button" @click="toggle(i)" :aria-expanded="openIndex === i"
                        class="flex w-full items-center gap-4 px-5 py-4 text-left focus:outline-none md:px-6">
                        <span class="hidden shrink-0 pt-0.5 font-mono text-xs font-semibold text-jade-light sm:inline">
                            {{ String(i + 1).padStart(2, '0') }}
                        </span>
                        <span class="flex-1 font-display text-base font-medium text-ink dark:text-paper">
                            {{ item.q }}
                        </span>
                        <span class="grid h-7 w-7 shrink-0 place-items-center rounded-full transition-all duration-300"
                            :class="openIndex === i
                                ? 'rotate-135 bg-jade/10 text-jade'
                                : 'bg-ink/5 text-ink/50 dark:text-paper/50'">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.2" stroke-linecap="round" class="h-3.5 w-3.5">
                                <path d="M12 5v14M5 12h14" />
                            </svg>
                        </span>
                    </button>

                    <div class="grid transition-all duration-300 ease-out"
                        :class="openIndex === i ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'">
                        <div class="overflow-hidden">
                            <p class="px-5 pb-5 text-sm leading-relaxed text-slate sm:px-6 sm:pl-[3.25rem]">
                                {{ item.a }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="reveal sm:hidden block rounded-2xl border border-ink/10 bg-ink/[0.03] p-6 dark:border-paper/10 dark:bg-paper/[0.04]">
                <p class="font-display text-lg font-medium text-ink dark:text-paper">
                    Kami selalu ada,<br>untuk membantu Anda
                </p>
                <p class="mt-2 text-sm leading-relaxed text-slate">
                    Apabila Anda ingin mengetahui lebih lanjut mengenai fitur produk,
                    harga layanan, atau solusi atas kendala yang dialami, kami selalu siap membantu Anda.
                    Hubungi kami melaui email atau media sosial. Anda juga dapat
                    mengunjungi Pusat Bantuan kami.
                </p>
                <PrimaryButton :href="waLink" tag="a" class="mt-5 !px-5 !py-2.5 text-sm">
                    Hubungi kami
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="ml-1.5 h-4 w-4">
                        <path d="M4 12h16M14 6l6 6-6 6" />
                    </svg>
                </PrimaryButton>
            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#FF6B00" fill-opacity="1"
                d="M0,256L120,250.7C240,245,480,235,720,234.7C960,235,1200,245,1320,250.7L1440,256L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
            </path>
        </svg>
    </section>
</template>

<style scoped>
.rotate-135 {
    transform: rotate(135deg);
}
</style>