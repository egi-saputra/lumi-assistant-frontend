<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue'

defineProps({
    waLink: { type: String, required: true },
})
</script>

<template>
    <section class="relative bg-white border-y border-ink/10 dark:border-paper/10 dark:bg-paper/[0.03] dark:text-paper">
        <div class="max-w-7xl mx-auto sm:px-20 px-6 sm:py-24">
            <div
                class="reveal mx-auto flex flex-col py-16 sm:bg-ink/[0.03] items-center gap-6 rounded-2xl text-center text-ink sm:border sm:border-jade/20 sm:dark:border sm:dark:border-paper/10 sm:dark:bg-ink/80 sm:  dark:text-paper">
                <h2 class="sm:inline-flex hidden font-display text-3xl font-medium tracking-tight md:text-4xl">
                    Mulai catat transaksi pertama kamu
                </h2>
                <h2 class="inline-flex sm:hidden font-display text-3xl font-medium tracking-tight md:text-4xl">
                    Say Hey For Lumi Now
                </h2>
                <p class="hidden sm:inline-flex max-w-md text-sm text-ink/70 dark:text-paper/70">
                    Gratis buat mulai. Cukup chat, sisanya biar Lumi yang urus.
                </p>
                <p class="sm:hidden inline-flex max-w-md text-sm text-ink/70 dark:text-paper/70">
                    Daftar gratis. Tinggal chat, Langsung tercatat.
                </p>
                <PrimaryButton :href="waLink" tag="a">
                    Start on WhatsApp
                </PrimaryButton>
            </div>
        </div>
    </section>
</template>