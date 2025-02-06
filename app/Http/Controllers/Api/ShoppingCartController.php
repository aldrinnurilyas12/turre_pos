<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\FuncCall;

class ShoppingCartController extends Controller
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
    public function add(Request $request)
    {
        $cart = Session::get('cart', []);

        $cart_product = [
            'id' => $request->id,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'images' => $request->images

        ];

        $found = false;
        foreach ($cart as &$item) {
            if ($item['product_name'] == $cart_product['product_name']) {
                $found = true;
                break;
            }
        }

        // Jika produk belum ada, tambahkan ke cart
        if (!$found) {
            $cart[] = $cart_product;
        }
        // Simpan cart ke session
        Session::put('cart', $cart);

        session()->flash('message_success', 'Produk berhasil ditambahkan!');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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


    public function clear_cart_session(): RedirectResponse
    {

        Session::forget('cart');
        session()->flash('success_empty_cart', 'Keranjang berhasil dikosongkan!');
        return redirect()->route('transaction_create');
    }

    public function delete_cart_product(Request $request): RedirectResponse
    {
        // Retrieve the cart from the session
        $cart = Session::get('cart', []);

        // Get the product ID to delete from the request
        $id = $request->id;

        // Check if the cart is not empty and the product ID exists
        if ($id && !empty($cart)) {
            // Loop through the cart to find the item with the matching ID and remove it
            foreach ($cart as $key => $cartItem) {
                if ($cartItem['id'] == $id) {
                    unset($cart[$key]); // Remove the product from the cart
                    break;
                }
            }

            // Update the session with the new cart data
            Session::put('cart', $cart);

            // Flash success message
            session()->flash('success_empty_cart', 'Berhasil hapus produk!');
        }

        // Redirect to the transaction creation route
        return redirect()->route('transaction_create');
    }
}