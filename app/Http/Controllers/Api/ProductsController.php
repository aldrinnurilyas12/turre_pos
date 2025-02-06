<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $shop = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->id;
        $products = DB::table('v_products')->where('shop_id', $shop)->get();

        return view('layouts.main_pages.products.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $shop = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->id;
        $product_category = DB::table('product_category')->where('shop_id', $shop)->get();
        return view('layouts.main_pages.products.create.products_create', compact('product_category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'product_type' => 'required',
            'images' => 'image|mimes:jpg,png,jpeg|max:5000'
        ]);

        $shop_id = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->id;

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $folderPath = 'product/' . $shop_id;
            $imagePath = $image->storeAs($folderPath, uniqid() . '.' . $image->getClientOriginalExtension(), 'public');
            ProductsModel::create([
                'shop_id' => $shop_id,
                'product_name' => $request->product_name,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'stock' => $request->stock,
                'product_weight' => $request->product_weight,
                'product_type' => $request->product_type,
                'color' => $request->color,
                'product_size' => $request->product_size,
                'images' => $imagePath,
                'created_by' => app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name . '-' . app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->owner_name
            ]);
        } else {
            ProductsModel::create([
                'shop_id' => app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->id,
                'product_name' => $request->product_name,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'stock' => $request->stock,
                'product_weight' => $request->product_weight,
                'product_type' => $request->product_type,
                'color' => $request->color,
                'product_size' => $request->product_size,
                'created_by' => app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name . '-' . app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->owner_name
            ]);
        }
        session()->flash('message_success', 'Data produk berhasil disimpan!');
        return redirect()->route('master_products.index');
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
    public function product_update_layout(string $id, Request $request)
    {
        $authenticatedUser = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers();
        $shop = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name; // Ganti dengan logika yang sesuai untuk mendapatkan shop_name lainnya

        if ($authenticatedUser->shop_name !== $shop) {
            abort(403, 'Ooops unauthorized shop');
        }
        $products = DB::table('v_products')->where('id', $request->id)->where('shop_name', $shop)->get();
        $product_category = DB::table('product_category')->get();
        return view('layouts.main_pages.products.edit.products_edit', compact('products', 'product_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $request->validate([
            'product_name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'product_type' => 'required',
            'images' => 'image|mimes:jpg,png,jpeg|max:5000'
        ]);

        $productImages = DB::table('products')->where('id', $request->id)->firstOrFail();

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $folderPath = 'product/' . $request->shop_id;
            $imagePath = $image->storeAs($folderPath, uniqid() . '.' . $image->getClientOriginalExtension(), 'public');
            DB::table('products')->where('id', $request->id)->update([
                'shop_id' => app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->id,
                'product_name' => $request->product_name,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'stock' => $request->stock,
                'product_weight' => $request->product_weight,
                'product_type' => $request->product_type,
                'color' => $request->color,
                'product_size' => $request->product_size,
                'images' => $imagePath,
                'updated_at' => now(),
                'updated_by' => app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name . '-' . app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->owner_name
            ]);

            if ($productImages->images) {
                $oldImages = public_path('storage/' . $productImages->images);
                if (file_exists($oldImages)) {
                    unlink($oldImages);
                }
            }
        } else {
            DB::table('products')->where('id', $request->id)->update([
                'shop_id' => app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->id,
                'product_name' => $request->product_name,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'stock' => $request->stock,
                'product_weight' => $request->product_weight,
                'product_type' => $request->product_type,
                'color' => $request->color,
                'product_size' => $request->product_size,
                'updated_at' => now(),
                'updated_by' => app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name . '-' . app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->owner_name
            ]);
        }


        session()->flash('message_success', 'Data produk berhasil disimpan!');
        return redirect()->route('master_products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = ProductsModel::find($id);

        if ($product) {
            $product->delete();
            session()->flash('message_success', 'Data produk berhasil dihapus!');
            return redirect()->route('master_products.index');
        } else {
            abort(403, 'Data produk tidak ditemukan');
        }
    }
}
