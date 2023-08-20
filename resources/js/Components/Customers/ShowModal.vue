<script setup>
import { ref } from 'vue'
import { router, Link } from '@inertiajs/vue3';
import MicroModal from 'micromodal';
import dayjs from 'dayjs'


 defineProps({
  customer: Object
})

// micromodalの閉じるボタン
const isShow = ref(false)
const toggleStatus = () => { isShow.value = !isShow.value}


</script>
<template>
    <div v-show="isShow" class="modal" id="modal-1" aria-hidden="true">
    
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-title">
            顧客詳細
            <p>顧客ID: {{ customer.customer_id }}</p>
          </h2>
          <button @click="toggleStatus" type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          
          <div class="mx-auto max-w-xl">
            <div class="grid grid-cols-12 gap-5">

              <!-- 顧客会社名 -->
              <div class="col-span-12 pl-2">
                <label for="customer_company_name" class="mb-1 block text-sm font-medium text-gray-700">顧客会社名</label>
                <div id="customer_company_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                 {{ customer.customer_company_name }}
                </div>
              </div>

              <!-- 顧客担当者名 -->
              <div class="col-span-6 pl-2">
                <label for="customer_manager_name" class="mb-1 block text-sm font-medium text-gray-700">顧客担当者名</label>
                <div id="customer_manager_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                  {{ customer.customer_manager_name }}
                </div>
              </div>

              <!-- 業種 -->
              <div class="col-span-6 pl-2">
                <label for="customer_type" class="mb-1 block text-sm font-medium text-gray-700">業種</label>
                <div id="customer_type" name="customer_type" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50">
                  {{ customer.customer_type }}
                </div>
              </div>
              
              <div class="col-span-12 pl-2">
                <label for="customer_email" class="mb-1 block text-sm font-medium text-gray-700">メールアドレス</label>
                <div id="customer_email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                  {{ customer.customer_email }}
                </div>
              </div>

              <div class="col-span-6 pl-2">
                <label for="customer_phone" class="mb-1 block text-sm font-medium text-gray-700">電話番号</label>
                <div id="customer_phone" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                 {{ customer.customer_phone }}
                </div>
              </div>

              <div class="col-span-12 pl-2">
                <label for="customer_address" class="mb-1 block text-sm font-medium text-gray-700">住所</label>
                <div id="customer_address" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                  {{ customer.customer_address }}
                </div>
              </div>

              <div class="col-span-4 pl-2">
                <label for="our_manager" class="mb-1 block text-sm font-medium text-gray-700">担当者ID</label>
                <div id="our_manager" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                  {{ customer.our_manager }}
                </div>
              </div>

              <div class="col-span-4 pl-2">
                <label for="modified_date" class="mb-1 block text-sm font-medium text-gray-700">更新日時</label>
                <div id="modified_date" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                  {{ dayjs(customer.modified_date).format('YYYY-MM-DD HH:mm:ss') }}
                </div>
              </div>
              
              <div class="col-span-12 pl-2">
                <button class="flex mx-auto mt-16 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded">編集</button>
              </div>
            </div>
          </div>

        </main>
        <footer class="modal__footer">
          <button @click="toggleStatus" type="button" class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Close</button>
        </footer>
      </div>
    </div>
  </div>

  <button @click="toggleStatus" x-data="{ tooltip: 'Edite' }">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
    </svg>
  </button>

</template>