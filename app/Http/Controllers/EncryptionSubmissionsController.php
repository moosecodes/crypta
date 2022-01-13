<?php

namespace App\Http\Controllers;

use App\Models\EncryptionSubmissions;
use Illuminate\Http\Request;

class EncryptionSubmissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->EncryptionSubmissions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EncryptionSubmissions  $encryptionSubmissions
     * @return \Illuminate\Http\Response
     */
    public function show(EncryptionSubmissions $encryptionSubmissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EncryptionSubmissions  $encryptionSubmissions
     * @return \Illuminate\Http\Response
     */
    public function edit(EncryptionSubmissions $encryptionSubmissions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EncryptionSubmissions  $encryptionSubmissions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EncryptionSubmissions $encryptionSubmissions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EncryptionSubmissions  $encryptionSubmissions
     * @return \Illuminate\Http\Response
     */
    public function destroy(EncryptionSubmissions $encryptionSubmissions)
    {
        //
    }
}
