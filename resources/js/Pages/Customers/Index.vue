<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { ref,computed } from 'vue'
import CreateModal from '@/Components/Customers/CreateModal.vue'
import ShowModal from '@/Components/Customers/ShowModal.vue'
import FlashMessage from '@/Components/FlashMessage.vue'


const props = defineProps({
	customers: Array,
	customerCount: Number,
})

/**
 * @type {String} 検索で入力された値をいれる変数
 */
const search = ref('')

/**
 * ソート方向のための変数
 * @type {String} デフォルトは昇順
 */
const sortDirection = ref('asc')

/**
 * @type {String} デフォルトか、ソートか切り替えの変数
 */
const sort = ref('')

/**
 * @type {String} ソートの指定されたキーをいれる変数
 */
const sortKey = ref('')

/**
 * 顧客の検索をする
 */
const searchCustomers = () => {
  router.get(route('customers.index', { search: search.value }))
} 

/**
 * ソート方向を切り替え
 * クリックされたキーに応じてソート処理を行う
 */
const toggleSortDirection = (key) => {
	if (key === sortKey.value) {
		sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc';
	} else {
		sortDirection.value = 'asc';
		sortKey.value = key;
	}  

	sort.value = 'sort'
};

/**
 * ソートの処理
 * @return sorted ソートした顧客情報
 */
const sortedCustomers = computed(() => {
	const sorted = [...props.customers];
	console.log(sorted)

	sorted.sort((a, b) => {
		const keyA = a[sortKey.value];
		const keyB = b[sortKey.value];

		// nullの場合は無視してソート
		if (keyA === null && keyB === null) return 0; 
		if (keyA === null) return 1; 
		if (keyB === null) return -1;

		if (sortDirection.value === 'asc') {
			return keyA.localeCompare(keyB);
		} else {
			return keyB.localeCompare(keyA);
		}
	});

	return sorted;
});

/**
 * 削除ダイアログ
 * @return confirmationMessage ダイアログのメッセージ
 */
const deleteCustomer = (customer) => {
	router.delete(route('customers.destroy', { customer: customer }), {
		onBefore: () => {
			const confirmationMessage = 'リード情報も削除されます。本当に削除しますか？';

			return confirm(confirmationMessage);
		}
	})
}

</script>

<template>
	<Head title="顧客一覧" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">顧客一覧</h2>
		</template>


		<div class="py-4">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 max-h-[calc(100vh-150px)] overflow-y-auto">
				<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
					<div class="p-6 text-gray-900">
						<section class="text-gray-600 body-font">
							<FlashMessage />

							<div class="container px-5 py-22 mx-auto">
								<div class="flex">

									<!-- 表示件数 -->
									<div class="flex pl-4 my-2 lg:mr-32 w-full mx-auto items-center">
										<p class="text-gray-500">
											<span class="px-2 py-1 text-xs">表示件数
												<span class="text-sm bg-white border border-gray-400 rounded-full px-2 py-1">{{ customerCount }}</span> 件
											</span>
										</p>   
									</div>

									<!-- 検索機能 -->
									<div class="flex pl-4 my-2 w-full mx-auto items-center">
										<div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
											<div class="absolute my-2 flex items-center pl-2">
												<svg
													class="w-4 h-4"
													aria-hidden="true"
													fill="currentColor"
													viewBox="0 0 20 20"
												>
													<path
														fill-rule="evenodd"
														d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
														clip-rule="evenodd"
													></path>
												</svg>
											</div>
											<input
												class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
												v-model="search"
												@keydown.enter="searchCustomers"
												type="text"
												placeholder="Search here"
												aria-label="Search"
											/>
										</div>
									</div>

									<!-- 顧客登録 -->
									<div class="flex pl-4 my-4 lg:w-2/3 mx-auto">
										<CreateModal />
									</div>
								</div>
														
								<div class="">
									<table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
										<thead class="bg-gray-50">
											<tr>
												<th scope="col" @click="toggleSortDirection('customer_company_name')" class="px-6 py-4 font-medium text-gray-900">
													顧客会社名
													<span v-if="sortDirection === 'asc'">▲</span>
													<span v-else>▼</span>
												</th>
												<th scope="col" @click="toggleSortDirection('customer_phone')" class="px-6 py-4 font-medium text-gray-900">
													電話番号
													<span v-if="sortDirection === 'asc'">▲</span>
													<span v-else>▼</span>
												</th>
												<th scope="col" @click="toggleSortDirection('customer_address')" class="px-6 py-4 font-medium text-gray-900">
													住所
													<span v-if="sortDirection === 'asc'">▲</span>
													<span v-else>▼</span>
												</th>
												<th scope="col" @click="toggleSortDirection('customer_type')" class="px-6 py-4 font-medium text-gray-900">
													業種
													<span v-if="sortDirection === 'asc'">▲</span>
													<span v-else>▼</span>
												</th>
												<th scope="col" class="px-6 py-4 font-medium text-gray-900">Actions</th>
											</tr>
										</thead>

										<!-- ソートされた顧客情報 -->
										<tbody v-if="sort === 'sort'">
											<tr v-for="customer in sortedCustomers" :key="customer.id">
												<td class="px-6 py-4 font-medium">
													{{ customer.customer_company_name }}
												</td>
												<td class="px-6 py-4">{{ customer.customer_phone }}</td>
												<td class="px-6 py-4">{{ customer.customer_address }}</td>
												<td class="px-6 py-4">
													<span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
														{{ customer.customer_type }}
													</span>
												</td>
												<td class="px-6 py-4">
													<div class="flex justify-end gap-4">
														<!-- 削除機能 -->
														<button @click="deleteCustomer(customer.customer_id)" x-data="{ tooltip: 'Delete' }">
														<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
															<path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
														</svg>
														</button>
														<!-- 詳細画面遷移 -->
														<ShowModal :customer="customer" />
													</div>
												</td>
											</tr>
										</tbody>

										<!-- 顧客情報 -->
										<tbody v-else class="divide-y divide-gray-100 border-t border-gray-100">
										<tr v-for="customer in customers" :key="customer.id">
												<td class="px-6 py-4 font-medium">
													{{ customer.customer_company_name }}
												</td>
												<td class="px-6 py-4">{{ customer.customer_phone }}</td>
												<td class="px-6 py-4">{{ customer.customer_address }}</td>
												<td class="px-6 py-4">
													<span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
														{{ customer.customer_type }}
													</span>
												</td>
												<td class="px-6 py-4">
													<div class="flex justify-end gap-4">
														<!-- 削除機能 -->
														<button @click="deleteCustomer(customer.customer_id)" x-data="{ tooltip: 'Delete' }">
														<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
															<path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
														</svg>
														</button>
														<!-- 詳細画面遷移 -->
														<ShowModal :customer="customer" />
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div> 
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>
