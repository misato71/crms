<script setup>
import { ref } from 'vue'
import { router, Link } from '@inertiajs/vue3';
import dayjs from 'dayjs'
import { reactive } from 'vue';



const props = defineProps({
  customer: Object
})

/**
 * 初期状態は詳細画面を表示
 * @type {String} デフォルトは詳細画面
 */
const currentModal = ref('show');

/**
 * @param {String} switchToEditModal 編集画面へ遷移
 */
const switchToEditModal = () => {
  currentModal.value = 'edit';
};

/**
 * モーダルの初期値を設定
 * @type {Boolean}　デフォルトはfalse
 */
const isShow = ref(false)

/**
 * @param {Boolean} toggleStatus モーダルを開くか閉じるか切り替え
 */
const toggleStatus = () => { isShow.value = !isShow.value}

/**
 * @type {Object} 顧客編集情報
 */
const form = reactive({
  customer_company_name: props.customer.customer_company_name,
  customer_manager_name:  props.customer.customer_manager_name,
  customer_type:  props.customer.customer_type,
  customer_email:  props.customer.customer_email,
  customer_phone:  props.customer.customer_phone,
  customer_address:  props.customer.customer_address,
  our_manager:  props.customer.our_manager,
})

/**
 * @type {Object} エラーメッセージ
 */
const validationErrors = ref({});

/**
 * 編集の確認ダイアログ表示
 */
const confirmAndUpdate = () => {
  const confirmationMessage = "この内容で編集してよろしいですか？";
  if (confirm(confirmationMessage)) {
    updateCustomer(props.customer.customer_id);
  }
}

/**
 * 顧客情報編集コントローラーへ送信
 */
const updateCustomer = async (id) => {
  try {
    await axios.put('/api/customers/'+ id, form);
    // 顧客一覧画面に遷移
    router.visit('/customers')
    // 初期化
    reset()

  } catch (error) {
    if (error.response && error.response.status === 422) {
      // バリデーションエラーメッセージをセット
      validationErrors.value = error.response.data.errors;
    } else {
      // 顧客一覧画面に遷移
      router.visit('/customers')
      // 初期化
      reset()
      }
  }
};

</script>

<template>
  <!-- モーダルを表示 -->
    <div v-show="isShow" class="modal" id="modal-1" aria-hidden="true">
    
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">

        <!-- 詳細画面 -->
        <div v-if="currentModal === 'show'">

        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-title">
            顧客詳細
            <p>顧客ID: {{ customer.customer_id }}</p>
          </h2>
          <!-- 閉じるボタン -->
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
              
              <!-- メールアドレス -->
              <div class="col-span-12 pl-2">
                <label for="customer_email" class="mb-1 block text-sm font-medium text-gray-700">メールアドレス</label>
                <div id="customer_email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                  {{ customer.customer_email }}
                </div>
              </div>

              <!-- 電話番号 -->
              <div class="col-span-6 pl-2">
                <label for="customer_phone" class="mb-1 block text-sm font-medium text-gray-700">電話番号</label>
                <div id="customer_phone" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                 {{ customer.customer_phone }}
                </div>
              </div>

              <!-- 住所 -->
              <div class="col-span-12 pl-2">
                <label for="customer_address" class="mb-1 block text-sm font-medium text-gray-700">住所</label>
                <div id="customer_address" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                  {{ customer.customer_address }}
                </div>
              </div>

              <!-- 担当者ID -->
              <div class="col-span-4 pl-2">
                <label for="our_manager" class="mb-1 block text-sm font-medium text-gray-700">担当者ID</label>
                <div id="our_manager" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                  {{ customer.our_manager }}
                </div>
              </div>

              <!-- 更新日時 -->
              <div class="col-span-4 pl-2">
                <label for="modified_date" class="mb-1 block text-sm font-medium text-gray-700">更新日時</label>
                <div id="modified_date" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                  {{ dayjs(customer.modified_date).format('YYYY-MM-DD HH:mm:ss') }}
                </div>
              </div>
              
              <!-- 編集画面に切り替え -->
              <div class="col-span-12 pl-2">
                <button @click="switchToEditModal" class="flex mx-auto mt-16 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded">更新</button>
              </div>
            </div>
          </div>

        </main>
        </div>

        <!-- 編集画面 -->
        <div v-if="currentModal === 'edit'">

          <header class="modal__header">
            <h2 class="modal__title" id="modal-1-title">
              編集
              <p>顧客ID: {{ customer.customer_id }}</p>
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

              <!-- 顧客会社名 -->
              <div class="col-span-12 pl-2">
                <label for="customer_company_name" class="mb-1 block text-sm font-medium text-gray-700">顧客会社名</label>
                <input type="text" id="customer_company_name" v-model="form.customer_company_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="株式会社○○" />
              </div>

              <!-- 顧客担当者名 -->
              <div class="col-span-6 pl-2">
                <label for="customer_manager_name" class="mb-1 block text-sm font-medium text-gray-700">顧客担当者名</label>
                <input type="text" id="customer_manager_name" v-model="form.customer_manager_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="" />
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
                <p>選択された業種: {{ form.customer_type }}</p>
              </div>
              
              <!-- メールアドレス -->
              <div class="col-span-12 pl-2">
                <label for="customer_email" class="mb-1 block text-sm font-medium text-gray-700">メールアドレス</label>
                <input type="email" id="customer_email" v-model="form.customer_email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="you@email.com" />
              </div>

              <!-- 電話番号 -->
              <div class="col-span-6 pl-2">
                <label for="customer_phone" class="mb-1 block text-sm font-medium text-gray-700">電話番号</label>
                <input type="text" id="customer_phone" v-model="form.customer_phone" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="" />
              </div>

              <!-- 住所 -->
              <div class="col-span-12 pl-2">
                <label for="customer_address" class="mb-1 block text-sm font-medium text-gray-700">住所</label>
                <input type="text" id="customer_address" v-model="form.customer_address" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="" />
              </div>

              <!-- 担当者ID -->
              <div class="col-span-4 pl-2">
                <label for="our_manager" class="mb-1 block text-sm font-medium text-gray-700">担当者ID</label>
                <input type="number" id="our_manager" v-model="form.our_manager" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="" />
              </div>
              
              <!-- 編集する -->
              <div class="col-span-12 pl-2">
                <button @click="confirmAndUpdate" class="flex mx-auto mt-16 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded">更新する</button>
              </div>
              </div>
            </div>

          </main>
        </div>

        <!-- キャンセルする -->
        <footer class="modal__footer">
          <button @click="toggleStatus" type="button" class="modal__btn" data-micromodal-close aria-label="Close this dialog window">キャンセル</button>
        </footer>
      </div>
    </div>
  </div>

  <!-- 詳細モーダルを開く -->
  <button @click="toggleStatus" x-data="{ tooltip: 'Edite' }">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
    </svg>
  </button>

</template>