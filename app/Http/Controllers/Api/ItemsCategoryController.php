<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\ItemsCategoryModel;

class ItemsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shop = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->id;

        $category_data = DB::table('product_category')->where('shop_id', $shop)->get();

        return view('layouts.main_pages.category.category', compact('category_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function category_create(): View
    {

        return view('layouts.main_pages.category.create.category_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $shop = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->id;

        ItemsCategoryModel::create([
            'shop_id' => $shop,
            'category_name' => $request->category_name,
            'created_by' => app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name
        ]);

        session()->flash('message_success', 'Data kategori berhasil disimpan!');
        return redirect()->route('master_category.index');
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
    public function category_update(string $id, Request $request): View
    {
        $ctgid = $request->id;
        $category_data = ItemsCategoryModel::where('id', $ctgid)->get();

        return view('layouts.main_pages.category.edit.category_edit', compact('category_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $update_data = DB::table('product_category')->where('id', $id)->update([
            'category_name' => $request->category_name,
            'updated_at' => now(),
            'updated_by' => app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name
        ]);

        if ($update_data) {
            session()->flash('message_success', 'Data kategori berhasil diperbarui!');
            return redirect()->route('master_category.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoryId = ItemsCategoryModel::find($id);

        if ($categoryId) {
            $categoryId->delete();
        }

        session()->flash('message_success', 'Data kategori berhasil dihapus!');
        return redirect()->route('master_category.index');
    }
}