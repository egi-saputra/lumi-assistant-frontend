<script setup>
import { ref, onMounted, onUnmounted, inject } from 'vue'
import DarkModeToggle from '@/Components/HomePage/DarkModeToggle.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'

const isScrolled = ref(false)
const scrollRoot = inject('scrollRoot')

function handleScroll() {
    isScrolled.value = (scrollRoot?.value?.scrollTop ?? 0) > 20
}

onMounted(() => {
    scrollRoot?.value?.addEventListener('scroll', handleScroll, { passive: true })
})

onUnmounted(() => {
    scrollRoot?.value?.removeEventListener('scroll', handleScroll)
})
</script>

<template>
    <header class="navbar-fixed border-b transition-all duration-300" :class="isScrolled
        ? 'border-ink/10 bg-paper/40 backdrop-blur-md dark:border-paper/10 dark:bg-ink/40'
        : 'border-transparent bg-transparent'" style="padding-top: env(safe-area-inset-top);">
        <div class="mx-auto flex items-center justify-between px-4 md:px-16 py-4">
            <div class="flex items-center gap-2">
                <ApplicationLogo />
                <span
                    class="font-display sm:text-3xl pt-1 text-xl font-semibold tracking-tight text-ink dark:text-paper">
                    Lumi Assistant
                </span>
            </div>
            <div class="flex items-center gap-3">
                <DarkModeToggle />
                <PrimaryButton :href="route('register')" prefetch="hover" tag="a">
                    Get Started
                </PrimaryButton>
            </div>
        </div>
    </header>
</template>

<style scoped>
.navbar-fixed {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 50;
}
</style>