<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    user_id: '',
    staff_password: '',
    staff_password_confirmation: '',
});

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

            <div class="mt-4">
                <InputLabel for="user_id" value="メールアドレス" />

                <TextInput
                    id="user_id"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.user_id"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="staff_password" value="パスワード" />

                <TextInput
                    id="staff_password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.staff_password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="staff_password_confirmation" value="パスワード確認" />

                <TextInput
                    id="staff_password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.staff_password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    登録
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
