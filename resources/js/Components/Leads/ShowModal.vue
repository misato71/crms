<script setup>
import { ref } from 'vue'
import { router, Link } from '@inertiajs/vue3';
import dayjs from 'dayjs'
import { reactive } from 'vue';



const props = defineProps({
  lead: Object
})

// 初期状態は詳細画面を表示
const currentModal = ref('show');

// 編集画面へ遷移
const switchToEditModal = () => {
  currentModal.value = 'edit';
};


// micromodalの閉じるボタン
const isShow = ref(false)
const toggleStatus = () => { isShow.value = !isShow.value}

// 顧客編集フォーム
const form = reactive({
  lead_name: props.lead.lead_name,
  status:  props.lead.status,
  lead_company:  props.lead.lead_company,
})

// エラーメッセージ
const validationErrors = ref({});


// 編集　確認ダイアログ
const confirmAndUpdate = () => {
  const confirmationMessage = "この内容で編集してよろしいですか？";
  if (confirm(confirmationMessage)) {
  updateLead(props.lead.lead_id);
  } else {
    console.log('キャンセル');
  }
}

const updateLead = async (id) => {
  try {
    await axios.put('/api/leads/'+ id, form);
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

        <div v-if="currentModal === 'show'">

        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-title">
            リード詳細
            <p>リードID: {{ lead.lead_id }}</p>
          </h2>
          <button @click="toggleStatus" type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>

        <main class="modal__content" id="modal-1-content">
          
          <div class="mx-auto max-w-xl">
            <div class="grid grid-cols-12 gap-5">

              <!-- リード名 -->
              <div class="col-span-12 pl-2">
                <label for="lead_name" class="mb-1 block text-sm font-medium text-gray-700">リード名</label>
                <div id="lead_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                 {{ lead.lead_name }}
                </div>
              </div>

              <!-- ステータス -->
              <div class="col-span-6 pl-2">
                <label for="status" class="mb-1 block text-sm font-medium text-gray-700">ステータス</label>
                <div id="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                  {{ lead.status }}
                </div>
              </div>

              <!-- 顧客ID -->
              <div class="col-span-6 pl-2">
                <label for="lead_company" class="mb-1 block text-sm font-medium text-gray-700">顧客ID</label>
                <div id="lead_company" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50">
                  {{ lead.lead_company }}
                </div>
              </div>
              
              <!-- 更新日時 -->
              <div class="col-span-4 pl-2">
                <label for="modified_date" class="mb-1 block text-sm font-medium text-gray-700">更新日時</label>
                <div id="modified_date" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                  {{ dayjs(lead.modified_date).format('YYYY-MM-DD HH:mm:ss') }}
                </div>
              </div>
              
              <div class="col-span-12 pl-2">
                <button @click="switchToEditModal" class="flex mx-auto mt-16 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded">更新</button>
              </div>
            </div>
          </div>

        </main>
        </div>

        <div v-if="currentModal === 'edit'">

          <header class="modal__header">
            <h2 class="modal__title" id="modal-1-title">
              編集
              <p>リードID: {{ lead.lead_id }}</p>
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
                <input type="text" id="lead_name" v-model="form.lead_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="株式会社○○" />
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
                <button @click="confirmAndUpdate" class="flex mx-auto mt-16 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded">更新する</button>
              </div>
              </div>
            </div>

          </main>
        </div>

        <footer class="modal__footer">
          <button @click="toggleStatus" type="button" class="modal__btn" data-micromodal-close aria-label="Close this dialog window">キャンセル</button>
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