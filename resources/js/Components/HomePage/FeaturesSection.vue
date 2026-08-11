<script setup>
const fitur = [
    { judul: 'Catat via chat', teks: 'Tulis transaksi dengan bahasa sehari-hari, Lumi yang urus detailnya.' },
    { judul: 'Catat via foto struk', teks: 'Foto struk belanja, Lumi baca nominal dan kategorinya otomatis.' },
    { judul: 'Rekap periodik', teks: 'Ringkasan pemasukan-pengeluaran per hari, minggu, atau bulan.' },
    { judul: 'Ekspor Excel & PDF', teks: 'Unduh rekap rapi buat laporan pribadi atau arsip keuangan.' },
    { judul: 'Kategori custom', teks: 'Bikin kategori sendiri sesuai cara kamu ngatur keuangan.' },
    { judul: 'Room bersama', teks: 'Catat keuangan bareng pasangan atau tim dalam satu room.' },
]
</script>

<template>
    <section class="bg-white/70 border-y border-ink/10 dark:border-paper/10 transition-colors dark:bg-paper/[0.02]">
        <div class="mx-auto max-w-6xl px-6 sm:py-24 py-10">
            <div class="mb-14 reveal">
                <p class="mb-3 font-mono text-xs text-center uppercase tracking-[0.2em] text-jade">Fitur</p>
                <h2
                    class="font-display text-3xl text-center font-medium tracking-tight text-ink dark:text-paper md:text-4xl">
                    Semua yang kamu butuh, nggak lebih.
                </h2>
            </div>

            <div
                class="reveal grid gap-px overflow-hidden rounded-2xl border border-ink/10 bg-ink/10 dark:border-paper/10 dark:bg-paper/10 sm:grid-cols-2 lg:grid-cols-3">
                <div v-for="f in fitur" :key="f.judul" class="bg-paper p-6 dark:bg-ink">
                    <h3 class="font-display text-base font-semibold text-ink dark:text-paper">{{ f.judul }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate">{{ f.teks }}</p>
                </div>
            </div>
        </div>
    </section>
</template>