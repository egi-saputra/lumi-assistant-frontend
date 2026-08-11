<script setup>
import DarkModeToggle from '@/Components/HomePage/DarkModeToggle.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'

defineProps({
    waLink: { type: String, required: true },
})
</script>

<template>
    <header
        class="sticky top-0 z-50 border-b border-ink/10 bg-paper/95 backdrop-blur transition-colors dark:border-paper/10 dark:bg-ink/95"
        style="padding-top: env(safe-area-inset-top);">
        <div class="mx-auto flex items-center justify-between px-6 md:px-16 py-4">
            <div class="flex items-center gap-2">
                <ApplicationLogo />
                <span
                    class="font-display sm:text-3xl pt-1 text-xl font-semibold tracking-tight text-ink dark:text-paper">Lumi
                    Assistant</span>
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