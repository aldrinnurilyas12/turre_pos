<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetail;
use App\Models\TransactionDetailInformationModel;
use App\Models\TransactionModel;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $shop = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->id;

        $show_transaction = DB::table('transactions as t')
            ->select('t.id', 't.invoice', 't.quantity', 't.total', 't.created_at', 't.created_by', 'tdi.customer',  DB::raw('GROUP_CONCAT(p.product_name) as product_name'))
            ->leftJoin('transactions_detail_information as tdi', 't.id', '=', 'tdi.transaction_id')
            ->leftJoin('transactions_detail as td', 't.id', '=', 'td.transaction_id')
            ->leftJoin('products as p', 'td.product_id', '=', 'p.id')
            ->where('t.shop_id', $shop)
            ->groupBy('t.id', 't.invoice', 't.created_at', 't.created_by', 'tdi.customer')
            ->orderBy('t.created_at', 'DESC')
            ->get();

        $show_transaction_array_data =  $show_transaction->map(function ($transaction) {
            $product_names = explode(',', $transaction->product_name);
            if (count($product_names) > 2) {
                $transaction->product_name = array_slice($product_names, 0, 2);
                $transaction->product_name[] = 'dan lainnya';
            } else {
                $transaction->product_name = $product_names;
            }

            return $transaction;
        });
        return view('layouts.main_pages.transactions.transaction', compact('show_transaction', 'show_transaction_array_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function transaction_create_layout(Request $request): View
    {
        $shop = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->id;
        $discount = DB::table('discounts')->where('shop_id', $shop)->get();
        $category_data = DB::table('product_category')->where('shop_id', $shop)->get();
        $all_products =  DB::table('v_products')->where('shop_id', $shop)->paginate(8);

        // section cart:
        $cart_value = Session::get('cart', []);

        $qty = 0;

        foreach ($cart_value as $item) {

            $qty += $item['quantity'];
        }

        $total_products = 0;

        foreach ($cart_value as $item) {

            $total_products = $item['quantity'];
        }

        $price_total = 0;

        foreach ($cart_value as $item) {
            $price_total += $item['price'];
        }

        $grand_total = 0;

        foreach ($cart_value as $item) {
            $grand_total += $item['price'];
        }
        return view('layouts.main_pages.transactions.create.transaction_create', compact('total_products', 'grand_total', 'price_total', 'qty', 'cart_value', 'all_products', 'category_data', 'discount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id'
        ]);

        $qtyProduct = $request->input('quantity_per_product');
        $productIds = $request->input('product_id');

        $uuid = bin2hex(random_bytes(16));
        $uuid_transaction = substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 8, 6);

        $shop_code = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_code;
        $unique_code = $uuid_transaction;
        $inv_date = Carbon::now()->format('Ymd');

        $main_transaction = TransactionModel::create([
            'shop_id' => app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->id,
            'invoice' => implode('-', (array) $inv_date) . '-' . implode('', (array) $shop_code)  . '-' . implode('', (array) $unique_code),
            'quantity' => $request->quantity,
            'total' => $request->total,
            'created_by' => app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name . '-' . app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->owner_name
        ]);


        foreach ($productIds as $productId) {
            TransactionDetail::create([
                'transaction_id' => $main_transaction->id,
                'product_id' => $productId,
                'quantity_per_product' => $qtyProduct,
                'created_by' => app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name . '-' . app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->owner_name
            ]);
        }

        TransactionDetailInformationModel::create([
            'transaction_id' => $main_transaction->id,
            'payment_method' => $request->payment_method,
            'promo_code' => $request->promo_code,
            'amount' => $request->amount,
            'payment_changes' => $request->payment_changes,
            'payment_total' => $request->payment_total,
            'customer' => $request->customer,
            'email' => $request->email,
            'created_by' => app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name . '-' . app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->owner_name
        ]);

        Session::forget('cart');
        session()->flash('message_success', 'Transaksi berhasil!');
        return redirect()->route('transaction_create');
    }

    public function invoice(Request $request): View
    {
        $shop = app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->id;
        $invoice = DB::table('transactions as t')
            ->select('t.id', 't.invoice', 't.quantity', 't.total', 't.created_at', 't.created_by', 'tdi.customer', 'tdi.email', 'p.product_name', 'p.price', 'tdi.payment_method', 'td.quantity_per_product')
            ->leftJoin('transactions_detail_information as tdi', 't.id', '=', 'tdi.transaction_id')
            ->leftJoin('transactions_detail as td', 't.id', '=', 'td.transaction_id')
            ->leftJoin('products as p', 'td.product_id', '=', 'p.id')
            ->where('t.shop_id', $shop)
            ->where('t.id', '=', $request->id)
            ->groupBy('t.id', 't.invoice', 't.created_at', 't.created_by', 'tdi.customer', 'tdi.email', 'p.product_name', 'p.price', 'tdi.payment_method', 'td.quantity_per_product')
            ->orderBy('t.created_at', 'DESC')
            ->get();

        return view('layouts.main_pages.invoice.invoice', compact('invoice'));
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}