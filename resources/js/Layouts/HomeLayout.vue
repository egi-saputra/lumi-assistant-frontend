<script setup>
import { Head } from '@inertiajs/vue3'
import { onMounted, onUnmounted, ref, provide, nextTick } from 'vue'
import Navbar from '@/Components/HomePage/Navbar.vue'

const scrollRoot = ref(null)
provide('scrollRoot', scrollRoot) // dipakai Navbar buat scroll & deteksi posisi

onMounted(() => {
    document.documentElement.classList.add('lock-scroll')
    document.body.classList.add('lock-scroll')

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible')
                    observer.unobserve(entry.target)
                }
            })
        },
        {
            root: scrollRoot.value, // penting: root sekarang container, bukan viewport document
            threshold: 0.1,
            rootMargin: '0px 0px -40px 0px',
        },
    )

    scrollRoot.value?.querySelectorAll('.reveal').forEach((el) => observer.observe(el))

    nextTick(() => {
        const target = window.location.hash
            ? document.querySelector(window.location.hash)
            : null

        target?.scrollIntoView({ behavior: 'smooth', block: 'start' })
    })
})

onUnmounted(() => {
    document.documentElement.classList.remove('lock-scroll')
    document.body.classList.remove('lock-scroll')
})
</script>

<template>

    <Head>
        <meta name="theme-color" content="#0b1120" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    </Head>

    <div ref="scrollRoot" class="scroll-viewport no-scrollbar" id="scroll-root">
        <Navbar />
        <main>
            <slot />
        </main>
    </div>
</template>