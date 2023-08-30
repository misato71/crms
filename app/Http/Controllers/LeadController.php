<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Models\Lead;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LeadController extends Controller
{
    /**
     * すべてのリード情報を取得、又は検索BOXで入力された場合は、データと一致するリード情報を取得
     * リード情報の件数を取得
     * @param　Illuminate\Http\Request $request 検索BOXで入力されたデータ
     * @param Array $leads 取得したリード情報
     * @param Number $leadCount リード情報の件数
     */
    public function index(Request $request)
    {
        $leads = Lead::searchLeads($request->search)
        ->select('lead_id', 'lead_name', 'status', 'lead_company', 'modified_date')->get();
        $leadCount = $leads->count();

        return Inertia::render('Leads/Index', [
            'leads' => $leads,
            'leadCount' => $leadCount,
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
     * リード情報の新規登録機能
     * @param App\Http\Requests\StoreLeadRequest $request　登録するリード情報
     */
    public function store(StoreLeadRequest $request)
    {
        Lead::create([
            'lead_name' => $request->lead_name,
            'status' => $request->status,
            'lead_company' => $request->lead_company,
            'created_id' => Auth::id(),
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * リード情報の編集機能
     * @param App\Models\Lead $lead　データベースに保存されてるリード情報
     * @param App\Http\Requests\UpdateLeadRequest $request 編集したリード情報
     */
    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        $lead->lead_name = $request->lead_name;
        $lead->status = $request->status;
        $lead->lead_company = $request->lead_company;
        $lead->modified_id = Auth::id();
        $lead->save();

    }

    /**
     * リード情報の削除機能
     * @param App\Models\Lead $lead　削除するリード情報
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();

        return to_route('leads.index')
        ->with([
            'message' => 'リード情報を削除しました。',
            'status' => 'danger'
        ]);

    }
}
