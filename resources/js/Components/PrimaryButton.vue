<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    tag: { type: String, default: 'button' },
    href: { type: String, default: null },
    variant: { type: String, default: 'primary' },
    // Inertia prefetch: false | true | 'hover' | 'mount' | 'click' | array event.
    // Cuma relevan kalau href mengarah ke halaman internal (lihat isExternal di bawah).
    prefetch: { type: [Boolean, String, Array], default: false },
})

// Deteksi otomatis: href ke domain lain (mis. wa.me) -> <a> biasa (full navigation).
// href ke domain sendiri (mis. hasil route()) -> Inertia <Link> (SPA + prefetch).
// Jadi pemanggilan PrimaryButton yang sudah ada (WA link dll) tidak perlu diubah sama sekali.
const isExternal = computed(() => {
    if (!props.href || typeof window === 'undefined') return false
    try {
        const url = new URL(props.href, window.location.origin)
        return url.origin !== window.location.origin
    } catch {
        return false
    }
})

const classes = computed(() => [
    'inline-flex items-center justify-center rounded-xl border-2 sm:px-6 px-4 sm:py-3 py-2 text-sm font-semibold transition-all duration-150 ease-out active:translate-x-[3px] active:translate-y-[3px] active:shadow-none focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2',
    props.variant === 'primary'
        ? 'border-ink bg-jade dark:bg-ink text-paper shadow-[3px_3px_0_0_theme(colors.ink)] hover:bg-jade-light dark:hover:bg-ink/70 focus-visible:ring-jade focus-visible:ring-offset-paper dark:border-jade-light dark:shadow-[3px_3px_0_0_theme(colors.jade)] dark:focus-visible:ring-offset-ink'
        : 'border-ink bg-paper text-ink shadow-[3px_3px_0_0_theme(colors.ink)] hover:bg-ink/5 focus-visible:ring-ink focus-visible:ring-offset-paper dark:border-paper dark:bg-ink dark:text-paper dark:shadow-[3px_3px_0_0_theme(colors.paper)] dark:hover:bg-paper/5 dark:focus-visible:ring-offset-ink',
])
</script>

<template>
    <Link v-if="href && !isExternal" :href="href" :prefetch="prefetch" :class="classes">
        <slot />
    </Link>
    <a v-else-if="href && isExternal" :href="href" :class="classes">
        <slot />
    </a>
    <component v-else :is="tag" :class="classes">
        <slot />
    </component>
</template>