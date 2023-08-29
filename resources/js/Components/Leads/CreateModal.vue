<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';


// micromodalの閉じるボタン
const isShow = ref(false)
const toggleStatus = () => { isShow.value = !isShow.value}

// 顧客登録フォーム
const form = reactive({
  lead_name: null,
  status: null,
  lead_company: null,
})

// 初期化
const reset = () => {
  MicroModal.init({
  disableScroll: true, 
  })
};

// エラーメッセージ
const validationErrors = ref({});

// 新規登録　確認ダイアログ
const confirmAndCreate = () => {
  const confirmationMessage = "この内容で登録してよろしいですか？";
  if (confirm(confirmationMessage)) {
    createLead();
  } else {
    console.log('キャンセル');
  }
}

const createLead = async () => {
  try {
    const response = await axios.post('/api/leads', form);

    // index画面にリダイレクト
    router.visit('/leads')
    
    reset()

  } catch (error) {
    if (error.response && error.response.status === 422) {
      // バリデーションエラーメッセージをセット
      validationErrors.value = error.response.data.errors;
    } else {
      // その他のエラーハンドリング
      console.log(error);
    }
  }
};


</script>
<template>
    <div v-show="isShow" class="modal" id="modal-1" aria-hidden="true">
    
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-title">
            新規登録
          </h2>
          <button @click="toggleStatus" type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">

          <!-- バリデーションエラーメッセージを表示 -->
          <div v-if="Object.keys(validationErrors).length > 0" class="col-span-12 pl-2 pb-6">
            <div class="flex rounded-md bg-red-50 p-4 text-sm text-red-500" x-cloak x-show="showAlert" x-data="{ showAlert: true }">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-3 h-5 w-5 flex-shrink-0">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
              </svg>
              <div>
                <h4 class="font-bold">Error</h4>
                <div class="mt-1">
                  <ul class="list-inside list-disc">
                    <li v-for="(errors, field) in validationErrors" :key="field">
                      {{ errors[0] }}
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          
          <div class="mx-auto max-w-xl">
            <div class="grid grid-cols-12 gap-5">

              <!-- リード名 -->
              <div class="col-span-12 pl-2">
                <label for="lead_name" class="mb-1 block text-sm font-medium text-gray-700">リード名</label>
                <input type="text" id="lead_name" v-model="form.lead_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="" />
              </div>

              <!-- ステータス -->
              <div class="col-span-6 pl-2">
                <label for="status" class="mb-1 block text-sm font-medium text-gray-700">ステータス</label>
                <input type="number" id="status" v-model="form.status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="" />
              </div>

              <!-- 顧客ID -->
              <div class="col-span-6 pl-2">
                <label for="lead_company" class="mb-1 block text-sm font-medium text-gray-700">顧客ID</label>
                <input type="number" id="lead_company" v-model="form.lead_company" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="" />
              </div>
              
              <div class="col-span-12 pl-2">
                <button @click="confirmAndCreate" class="flex mx-auto mt-16 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded">登録する</button>
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

  <button @click="toggleStatus" type="button" class="flex ml-auto rounded-full border border-primary-500 bg-violet-500 px-5 py-2.5 text-center text-xs font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300" data-micromodal-trigger="modal-1" href='javascript:;'>
    <span class="mr-2" aria-hidden="true">+</span>
    新規登録
  </button>

</template>