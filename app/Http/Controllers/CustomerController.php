<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * すべての顧客情報を取得、又は検索BOXで入力された場合は、データと一致する顧客情報を取得
     * 顧客情報の件数を取得
     * @param　Illuminate\Http\Request $request 検索BOXで入力されたデータ
     * @param Array $customers 取得した顧客情報
     * @param Number $customerCount 顧客情報の件数
     */
    public function index(Request $request)
    {

        $customers = Customer::searchCustomers($request->search)
        ->select('customer_id', 'customer_company_name', 'customer_manager_name', 'customer_email', 'customer_phone', 'customer_address', 'customer_type', 'our_manager', 'modified_date')->get();

        $customerCount = $customers->count();

        return Inertia::render('Customers/Index', [
            'customers' => $customers,
            'customerCount' => $customerCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * 顧客情報の新規登録機能
     * @param App\Http\Requests\StoreCustomerRequest $request　登録する顧客情報
     */
    public function store(StoreCustomerRequest $request)
    {

        Customer::create([
            'customer_company_name' => $request->customer_company_name,
            'customer_manager_name' => $request->customer_manager_name,
            'customer_type' => $request->customer_type,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'our_manager' => $request->our_manager,
            'created_id' => Auth::id(),
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * 顧客情報の編集機能
     * @param App\Models\Customer $customer　データベースに保存されてる顧客情報
     * @param App\Http\Requests\UpdateCustomerRequest $request 編集した顧客情報
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        
        $customer->customer_company_name = $request->customer_company_name;
        $customer->customer_manager_name = $request->customer_manager_name;
        $customer->customer_type = $request->customer_type;
        $customer->customer_email = $request->customer_email;
        $customer->customer_phone = $request->customer_phone;
        $customer->customer_address = $request->customer_address;
        $customer->our_manager = $request->our_manager;
        $customer->modified_id = Auth::id();
        $customer->save();
    }

    /**
     * 顧客情報の削除機能
     * @param App\Models\Customer $customer　削除する顧客情報
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return to_route('customers.index')
        ->with([
            'message' => '顧客会社を削除しました。',
            'status' => 'danger'
        ]);

    }
}
