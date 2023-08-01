<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginInfoRequest;
use App\Http\Requests\UpdateLoginInfoRequest;
use App\Models\LoginInfo;

class LoginInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoginInfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LoginInfo $loginInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoginInfo $loginInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoginInfoRequest $request, LoginInfo $loginInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoginInfo $loginInfo)
    {
        //
    }
}
