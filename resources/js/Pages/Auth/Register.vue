<script setup>
import { ref } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    phone: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const verifying = ref(false)
const verified = ref(false)
const verificationMessage = ref('')

const verifyPhone = async () => {
    if (verified.value || verifying.value) return
    verifying.value = true
    verificationMessage.value = ''

    try {
        const tokenMeta = document.querySelector('meta[name="csrf-token"]')
        const csrf = tokenMeta ? tokenMeta.getAttribute('content') : ''
        const res = await fetch(route('phone.verify'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ phone: form.phone }),
        })

        if (res.ok) {
            verifying.value = false
            verified.value = true
            verificationMessage.value = 'Verifikasi berhasil ✅'
        } else {
            const body = await res.json().catch(() => ({}))
            verificationMessage.value = body.detail || 'Verifikasi gagal'
            verifying.value = false
        }
    } catch (err) {
        verificationMessage.value = 'Verifikasi gagal'
        verifying.value = false
    }
}

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="phone" value="Phone" />

                <div class="mt-1 flex items-center gap-2">
                    <TextInput
                        id="phone"
                        type="tel"
                        class="block flex-1"
                        v-model="form.phone"
                        required
                        autocomplete="tel"
                    />

                    <button
                        type="button"
                        class="inline-flex items-center justify-center px-3 py-2 border border-gray-300 rounded-md bg-white hover:bg-gray-50"
                        :disabled="verifying || verified"
                        @click="verifyPhone"
                        aria-label="Verify phone"
                    >
                        <template v-if="verifying">
                            <svg class="animate-spin h-5 w-5 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                        </template>
                        <template v-else-if="verified">
                            <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414-1.414L8 11.172 4.707 7.879a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8z" clip-rule="evenodd" />
                            </svg>
                        </template>
                        <template v-else>
                            <span class="text-sm text-gray-700">Verifikasi</span>
                        </template>
                    </button>
                </div>

                <InputError class="mt-2" :message="form.errors.phone" />
                <p v-if="verificationMessage" class="mt-2 text-sm text-green-600">{{ verificationMessage }}</p>
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    autocomplete="username"
                    :disabled="!verified"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                    :disabled="!verified"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    :disabled="!verified"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
