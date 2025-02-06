<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DiscountModel;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shop = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->id;
        $discounts = DB::table('discounts')->where('shop_id', $shop)->get();

        return view('layouts.main_pages.discount_services.discount', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function discount_create_layout(): View
    {
        return view('layouts.main_pages.discount_services.create.discount_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $shop = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->id;
        $shop_name = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name;

        DiscountModel::create([
            'shop_id' => $shop,
            'discount_name' => $request->discount_name,
            'discount_code' => $request->discount_code,
            'discount_total' => $request->discount_total,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'created_by' => $shop_name
        ]);

        session()->flash('message_success', 'Data discount berhasil disimpan!');
        return redirect()->route('discount.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_layout(string $id)
    {
        $discounts = DiscountModel::where('id', $id)->get();
        return view('layouts.main_pages.discount_services.edit.discount_edit', compact('discounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shop = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->id;
        $shop_name = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name;

        DB::table('discounts')->where('id', $request->id)->update([
            'shop_id' => $shop,
            'discount_name' => $request->discount_name,
            'discount_code' => $request->discount_code,
            'discount_total' => $request->discount_total,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'updated_by' => $shop_name,
            'updated_at' => now()
        ]);

        session()->flash('message_success', 'Data discount berhasil diperbarui!');
        return redirect()->route('discount.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $discountId = DiscountModel::find($id);

        if ($discountId) {
            $discountId->delete();
        }
        session()->flash('message_success', 'Data discount berhasil dihapus!');
        return redirect()->route('discount.index');
    }
}
