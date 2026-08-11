<script setup>
import { Head } from '@inertiajs/vue3'
import Navbar from '@/Components/HomePage/Navbar.vue'
import HeroSection from '@/Components/HomePage/HeroSection.vue'
import HowItWorksSection from '@/Components/HomePage/HowItWorksSection.vue'
import FeaturesSection from '@/Components/HomePage/FeaturesSection.vue'
import SecuritySection from '@/Components/HomePage/SecuritySection.vue'
import ReviewSection from '@/Components/HomePage/ReviewSection.vue'
import CtaSection from '@/Components/HomePage/CtaSection.vue'
import FaqSection from '@/Components/HomePage/FaqSection.vue'
import SiteFooter from '@/Components/HomePage/SiteFooter.vue'

// Ganti dengan nomor WhatsApp bot kamu (format internasional, tanpa "+" atau "0" di depan)
const WA_NUMBER = '6285185590158'
const waLink = `https://wa.me/${WA_NUMBER}?text=${encodeURIComponent('Halo Lumi!')}`

const title = 'Lumi Assistant — Catat Uang Secepat Chat di WhatsApp'
const description =
    'Lumi Assistant adalah asisten pencatat keuangan pribadi lewat WhatsApp. Chat atau foto struk, Lumi catat nominal, kategori, dan metode pembayaran otomatis — lengkap dengan rekap dan ekspor Excel/PDF.'
const canonical = 'https://assistant.lumiverse.co.id'

const structuredData = {
    '@context': 'https://schema.org',
    '@type': 'SoftwareApplication',
    name: 'Lumi Assistant',
    applicationCategory: 'FinanceApplication',
    operatingSystem: 'WhatsApp',
    description,
    url: canonical,
    offers: {
        '@type': 'Offer',
        price: '0',
        priceCurrency: 'IDR',
    },
}
</script>

<template>

    <Head>
        <title>{{ title }}</title>
        <meta name="description" :content="description" />
        <link rel="canonical" :href="canonical" />

        <meta property="og:type" content="website" />
        <meta property="og:title" :content="title" />
        <meta property="og:description" :content="description" />
        <meta property="og:url" :content="canonical" />
        <meta property="og:locale" content="id_ID" />

        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" :content="title" />
        <meta name="twitter:description" :content="description" />

        <component is="script" type="application/ld+json" v-html="JSON.stringify(structuredData)"></component>
    </Head>

    <div class="min-h-screen bg-paper font-sans text-ink antialiased transition-colors dark:bg-ink dark:text-paper">
        <Navbar :wa-link="waLink" />
        <HeroSection :wa-link="waLink" />
        <HowItWorksSection />
        <FeaturesSection />
        <SecuritySection />
        <CtaSection :wa-link="waLink" />
        <ReviewSection />
        <FaqSection />
        <SiteFooter />
    </div>
</template>