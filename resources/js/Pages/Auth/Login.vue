<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

/**
 * @type {Object} ログインで入力された情報
 */
const form = useForm({
    user_id: '',
    staff_password: '',
});

/**
 * ログインコントローラーへ送信
 */
const submit = () => {
    form.post(route('login'), {
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">

            <!-- メールアドレス -->
            <div>
                <InputLabel for="user_id" value="Email Address" />

                <TextInput
                    id="user_id"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.user_id"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- パスワード -->
            <div class="mt-4">
                <InputLabel for="staff_password" value="Password" />

                <TextInput
                    id="staff_password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.staff_password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    ログイン
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
