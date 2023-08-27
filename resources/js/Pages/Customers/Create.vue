<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';



defineProps({ errors: Object })

const form = reactive({
  customer_company_name: null,
  customer_manager_name: null,
  customer_type: null,
  customer_email: null,
  customer_phone: null,
  customer_address: null,
  our_manager: null,
})

function submit() {
  router.post('/customers', form)
}

</script>

<template>
    <Head title="顧客登録" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">顧客登録</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                    
                      <div class="mx-auto max-w-xl">
                        <form @submit.prevent="submit">
                          <div class="grid grid-cols-12 gap-5">

                            <!-- 顧客会社名 -->
                            <div class="col-span-12 pl-2">
                              <label for="customer_company_name" class="mb-1 block text-sm font-medium text-gray-700">顧客会社名</label>
                              <input type="text" id="customer_company_name" v-model="form.customer_company_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="株式会社○○" />
                              <div v-if="errors.customer_company_name" class="text-sm text-red-500">{{ errors.customer_company_name }}</div>
                            </div>

                            <!-- 顧客担当者名 -->
                            <div class="col-span-6 pl-2">
                              <label for="customer_manager_name" class="mb-1 block text-sm font-medium text-gray-700">顧客担当者名</label>
                              <input type="text" id="customer_manager_name" v-model="form.customer_manager_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="" />
                              <div v-if="errors.customer_manager_name" class="text-sm text-red-500">{{ errors.customer_manager_name }}</div>
                            </div>

                            <!-- 業種 -->
                            <div class="col-span-6 pl-2">
                              <label for="customer_type" class="mb-1 block text-sm font-medium text-gray-700">業種</label>
                              <select id="customer_type" name="customer_type" v-model="form.customer_type" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50">
                                <option value="">選択してください</option>
                                <option value="製造業">製造業</option>
                                <option value="情報通信業">情報通信業</option>
                                <option value="工業">工業</option>
                                <option value="医療、福祉">医療、福祉</option>
                                <option value="宿泊業、飲食サービス業">宿泊業、飲食サービス業</option>
                                <option value="教育、学習支援業">教育、学習支援業</option>
                                <option value="サービス業（他に分類されないもの））">サービス業（他に分類されないもの）</option>
                              </select>
                              <div v-if="errors.customer_type" class="text-sm text-red-500">{{ errors.customer_type }}</div>
                            </div>
                            
                            <div class="col-span-12 pl-2">
                              <label for="customer_email" class="mb-1 block text-sm font-medium text-gray-700">メールアドレス</label>
                              <input type="email" id="customer_email" v-model="form.customer_email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="you@email.com" />
                              <div v-if="errors.customer_email" class="text-sm text-red-500">{{ errors.customer_email }}</div>
                            </div>

                            <div class="col-span-6 pl-2">
                              <label for="customer_phone" class="mb-1 block text-sm font-medium text-gray-700">電話番号</label>
                              <input type="text" id="customer_phone" v-model="form.customer_phone" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="" />
                              <div v-if="errors.customer_phone" class="text-sm text-red-500">{{ errors.customer_phone }}</div>
                            </div>

                            <div class="col-span-12 pl-2">
                              <label for="customer_address" class="mb-1 block text-sm font-medium text-gray-700">住所</label>
                              <input type="text" id="customer_address" v-model="form.customer_address" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="" />
                              <div v-if="errors.customer_address" class="text-sm text-red-500">{{ errors.customer_address }}</div>
                            </div>

                            <div class="col-span-4 pl-2">
                              <label for="our_manager" class="mb-1 block text-sm font-medium text-gray-700">担当者ID</label>
                              <input type="number" id="our_manager" v-model="form.our_manager" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="" />
                              <div v-if="errors.our_manager" class="text-sm text-red-500">{{ errors.our_manager }}</div>
                            </div>
                            
                            <div class="col-span-12 pl-2">
                              <button class="flex mx-auto mt-16 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>
                            </div>
                          </div>
                        </form>
                      </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
