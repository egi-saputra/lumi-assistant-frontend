<script setup>
import { useDarkMode } from '@/Composables/useDarkMode'

const { isDark, toggle } = useDarkMode()
</script>

<template>
    <button type="button" @click="toggle"
        class="sm:grid hidden sm:h-11 h-9 sm:mr-0 mr-3 sm:w-11 w-9 place-items-center rounded-xl border-2 border-ink bg-jade text-paper shadow-[3px_3px_0_0_theme(colors.ink)] transition-all duration-150 ease-out hover:bg-jade/80 focus:outline-none focus-visible:ring-2 focus-visible:ring-ink focus-visible:ring-offset-2 focus-visible:ring-offset-paper active:translate-x-[3px] active:translate-y-[3px] active:shadow-none dark:border-jade dark:bg-ink dark:text-paper dark:shadow-[3px_3px_0_0_theme(colors.jade)] dark:hover:bg-ink/70 dark:focus-visible:ring-paper dark:focus-visible:ring-offset-zinc-900"
        :aria-label="isDark ? 'Aktifkan mode terang' : 'Aktifkan mode gelap'">
        <svg v-if="!isDark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 3v1.5M12 19.5V21M4.22 4.22l1.06 1.06M18.72 18.72l1.06 1.06M3 12h1.5M19.5 12H21M4.22 19.78l1.06-1.06M18.72 5.28l1.06-1.06M12 7.5a4.5 4.5 0 100 9 4.5 4.5 0 000-9z" />
        </svg>
        <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
            <path
                d="M21.64 13a1 1 0 00-1.05-.14 8.05 8.05 0 01-3.37.73 8.15 8.15 0 01-8.14-8.14c0-1.18.25-2.34.73-3.37a1 1 0 00-1.24-1.37A10.14 10.14 0 1022.5 14.24a1 1 0 00-.86-1.24z" />
        </svg>
    </button>
</template>