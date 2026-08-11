<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex min-h-screen flex-col items-center pt-6 sm:justify-center sm:pt-0">
        <!-- <div
            class="flex items-center font-display sm:text-3xl pt-1 text-2xl font-semibold tracking-tight text-ink dark:text-paper">
            <Link href="/">
                <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
            </Link>
            <span class="ms-2 text-lg font-semibold text-gray-800">Lumi Assistant</span>
        </div> -->

        <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 sm:shadow-md sm:max-w-md sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
