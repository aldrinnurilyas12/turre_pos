<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Turre POS - Tambah Produk</title>
    <link href="{{ asset('assets/front_end/css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/front_end/css/transaction_create.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body class="sb-nav-fixed">
    @include('layouts.component_admin.navbar.navbar')
    @include('layouts.component_admin.sidebar.sidebar')
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <br>
                <div class="container">
                    <h4><strong>Sale</strong></h4>
                    <hr>

                    @if ($category_data->isEmpty())
                        <div class="main-container-content">
                            <div class="container-content">
                                <div class="tab-content" id="tab-content">
                                    <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel"
                                        aria-labelledby="simple-tab-0">
                                        <div class="card-body">
                                            <div class="content-product-show">
                                                <div class="products-card">
                                                    @if ($all_products->isNotEmpty())
                                                        @foreach ($all_products as $products)
                                                            <div class="card">

                                                                <img class="card-img"
                                                                    src="{{ asset('storage/' . $products->images) }}"
                                                                    alt="">
                                                                <p style="margin-bottom: 10px;">
                                                                    <strong>{{ $products->product_name }}</strong>
                                                                </p>

                                                                <div class="price">
                                                                    <p>{{ 'Rp.' . number_format($products->price) }}</p>
                                                                </div>

                                                                <div class="stok">
                                                                    <p>stok : {{ $products->stock }}</p>
                                                                    <p>Terjual : {{ $products->sold }}</p>
                                                                </div>

                                                                <div class="btn-add-cart">
                                                                    <form action="{{ route('cart_add') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button class="btn-add-to-cart"
                                                                            type="submit">Tambah</button>
                                                                        <input type="text" name="id"
                                                                            value="{{ $products->id }}" hidden>
                                                                        <input type="text" name="images"
                                                                            value="{{ $products->images }}" hidden>
                                                                        <input type="text" name="product_name"
                                                                            value="{{ $products->product_name }}"
                                                                            hidden>
                                                                        <input type="text" name="price"
                                                                            value="{{ $products->price }}" hidden>
                                                                        <input type="hidden" value="1">
                                                                        <!-- Default quantity -->
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <p>Data tidak ada</p>
                                                    @endif
                                                </div>
                                                <div class="pagination">
                                                    {{ $all_products->links() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- transaction-card --}}
                            <div class="transaction-card">
                                <div class="title-action-close">
                                    <h6><strong>Keranjang Belanja</strong></h6>
                                    <a style="color:black;" id="closeBtn" href="#">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                </div>

                                <hr>

                                <!-- Daftar barang di keranjang -->

                                <form action="{{ route('transaction.store') }}" method="POST">
                                    @csrf
                                    <div class="cart-items">
                                        @if ($cart_value)
                                            @foreach ($cart_value as $cart)
                                                <div class="cart-item">
                                                    <div class="container-content-product">

                                                        <!-- Product Image -->
                                                        <div class="image-content">
                                                            <img width="50" height="50"
                                                                src="{{ asset('storage/' . $cart['images']) }}"
                                                                alt="Product Image">
                                                        </div>

                                                        <!-- Product Details -->
                                                        <div class="sub-container-product">
                                                            <p class="item-name">{{ $cart['product_name'] }}</p>
                                                            <input name="product_id[]" type="hidden"
                                                                value="{{ $cart['id'] }}">

                                                            <!-- Product Price and Quantity -->
                                                            <div class="flex-content"
                                                                style="display: flex; justify-content: space-between;">
                                                                <p class="item-price">
                                                                    {{ 'Rp.' . number_format($cart['price']) }}</p>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <!-- Quantity and Delete Section -->
                                                    <div class="btn-delete-product">

                                                        <!-- Quantity Control -->
                                                        <div class="quantity-container">
                                                            <button type="button" class="decrease">-</button>
                                                            <input id="qtyProduct" name="quantity_per_product"
                                                                type="number" class="item-quantity">
                                                            <button type="button" class="increase">+</button>
                                                        </div>


                                                        {{-- <form action=""></form> --}}

                                                        <!-- Delete Button -->
                                                        {{-- <div class="delete-btn">
                                  <form action="{{route('delete_item_cart', $cart['id'])}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$cart['id']}}">
                                    <button type="submit" class="deletebtn">
                                      <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                  </form>
                                </div> --}}

                                                    </div>

                                                    <hr>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-center-cart">
                                                <h6>Keranjang Masih Kosong</h6>
                                            </div>

                                        @endif
                                    </div>

                                    <div class="payment-method">
                                        <label for=""><strong>Metode Bayar</strong></label>
                                        <div class="open-pay-method">
                                            <select class="form-control" name="payment_method" id="">
                                                <option value="">=== Pilih Metode Bayar ===</option>
                                                <option value="cash">Tunai</option>
                                                <option value="transfer bank">Transfer Bank</option>
                                                <option value="qris">QRIS</option>
                                                <option value="gopay">Gopay</option>
                                                <option value="dana">Dana</option>
                                            </select>
                                        </div>

                                    </div>

                                    <hr>
                                    <div class="discount">
                                        <label for=""><strong>Diskon</strong></label>
                                        <div class="open-pay-method">
                                            <select class="form-control" name="payment_method" id="">
                                                <option value="">=== Pilih Diskon ===</option>
                                                @foreach ($discount as $disc)
                                                    <option value="{{ $disc->discount_code }}">
                                                        {{ $disc->discount_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <hr>
                                    <div class="promo-code">
                                        <input class="form-control" name="promo_code" type="text"
                                            placeholder="Masukan kode promo">
                                        <button class="btn btn-primary">Pakai</button>
                                    </div>
                                    <hr>
                                    <div class="title-action-close">
                                        <h6><strong>Lainnya</strong></h6>
                                        <a style="color: black;" id="openCustomerSegment" href="#">
                                            <i class="fa fa-chevron-up" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <hr>
                                    <div class="customer-segment">
                                        <div class="customer-input">
                                            <label for=""><strong>Nama Pelanggan (opsional)</strong></label>
                                            <input class="form-control" type="text" name="customer"
                                                id="" autocomplete="off">
                                        </div>
                                        <br>
                                        <div class="customer-input">
                                            <label for=""><strong>Email Pelanggan (opsional)</strong></label>
                                            <input class="form-control" type="email" name="email"
                                                autocomplete="off">
                                        </div>
                                        <hr>
                                    </div>

                                    <div class="payment-amount">
                                        <div style="margin-bottom: 10px;" class="amount">
                                            <label for=""><strong>Bayar</strong></label>
                                            <input name="amount" id="amount" class="form-control" type="text"
                                                autocomplete="off">
                                        </div>

                                        <div class="payment-changes">
                                            <label for=""><strong>Kembalian</strong></label>
                                            <input id="paychange" name="payment_changes" class="form-control"
                                                type="text" readonly>
                                        </div>
                                    </div>

                                    <hr>
                                    <p><strong>Informasi Pembayaran</strong></p>
                                    <hr>
                                    <!-- Subtotal dan Total -->
                                    <div class="totals">
                                        <div class="content-total">
                                            <span class="title-total">Total barang : </span>
                                            <span id="total-quantity">0</span>
                                        </div>

                                        <div class="content-total">
                                            <span class="title-total">Promo : </span>
                                            <span>-</span>
                                        </div>

                                        <hr>
                                        <div class="content-total">
                                            <span class="title-total">Bayar: </span>
                                            <span id="display-paychange" class="paychange">{{ 'Rp.' }}</span>
                                        </div>
                                        <div class="content-total">
                                            <span class="title-total">Kembalian: </span>
                                            <span id="display-change" class="paychange">{{ 'Rp.' }}</span>
                                        </div>
                                        <hr>

                                        <div class="content-total">
                                            <span class="title-total">Grand Total: </span>
                                            <span id="grandtotal">{{ 'Rp.' . number_format($grand_total) }}</span>
                                            <input id="grandtotal" type="text" value="{{ $grand_total }}"
                                                name="total">
                                        </div>
                                    </div>

                                    <br>

                                    <!-- Button Checkout -->
                                    <button type="submit" class="checkout-button">Checkout</button>
                                </form>


                                <form action="{{ route('clear_cart') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn-clear-cart">Bersihkan Keranjang</button>
                                </form>
                            </div>
                        </div>
                    @else
                        {{-- SCRIPT UNTUK MENAMPILKAN PRODUCT BERDASARKAN KATEGORI --}}
                        <div class="filter-content">
                            <div class="category-title">
                                <h6>Kategori Produk</h6>
                            </div>

                            <div class="category-scroll">
                                <ul class="nav nav-tabs" id="nav-scroll" role="tablist" style="gap: 20px;">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="tab-all-tab" data-bs-toggle="tab"
                                            href="#tab-all" role="tab" aria-controls="tab-all"
                                            aria-selected="true">Semua</a>
                                    </li>
                                    @foreach ($category_data as $ctg)
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tab-{{ $ctg->id }}-tab"
                                                data-bs-toggle="tab" href="#tab-{{ $ctg->id }}" role="tab"
                                                aria-controls="tab-{{ $ctg->id }}" aria-selected="false">
                                                {{ $ctg->category_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>

                        <hr>

                        <div class="main-container-content">
                            <div class="container-content">
                                <div class="tab-content" id="tab-content">
                                    <div class="tab-pane active" id="tab-all" role="tabpanel"
                                        aria-labelledby="tab-all">
                                        <div class="card-body">
                                            <div class="tab-pane fade show active" id="tab-all" role="tabpanel"
                                                aria-labelledby="tab-all-tab">
                                                <div class="card-body">
                                                    <div class="content-product-show">
                                                        <div class="products-card"
                                                            style="display: flex; flex-wrap: wrap; gap: 20px;">
                                                            @foreach ($all_products as $product)
                                                                <div class="card" style="width: 200px;">
                                                                    <img class="card-img"
                                                                        src="{{ asset('storage/' . $product->images) }}"
                                                                        alt="">
                                                                    <p><strong>{{ $product->product_name }}</strong>
                                                                    </p>
                                                                    <div class="price">
                                                                        <p>{{ 'Rp.' . number_format($product->price) }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="stok">
                                                                        <p>Stok: {{ $product->stock }}</p>
                                                                        <p>Terjual: {{ $product->sold }}</p>
                                                                    </div>
                                                                    <div class="btn-add-cart">
                                                                        <form action="{{ route('cart_add') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="id"
                                                                                value="{{ $product->id }}">
                                                                            <input type="hidden" name="images"
                                                                                value="{{ $product->images }}">
                                                                            <input type="hidden" name="product_name"
                                                                                value="{{ $product->product_name }}">
                                                                            <input type="hidden" name="price"
                                                                                value="{{ $product->price }}">
                                                                            <button class="btn-add-to-cart"
                                                                                type="submit">Tambah</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                    </div>

                                    {{-- TAB PER CATEGORY --}}


                                    @if ($all_products->isNotEmpty())
                                        @foreach ($category_data as $ctg)
                                            @php
                                                $filtered_products = $all_products->where('category_id', $ctg->id);
                                            @endphp
                                            <div class="tab-pane fade" id="tab-{{ $ctg->id }}" role="tabpanel"
                                                aria-labelledby="tab-{{ $ctg->id }}-tab">
                                                <div class="card-body">
                                                    <div class="products-card"
                                                        style="display: flex; flex-wrap: wrap; gap: 20px;">
                                                        @if ($filtered_products->isNotEmpty())
                                                            @foreach ($filtered_products as $product)
                                                                <div style="position: left;" class="card"
                                                                    style="width: 200px;">
                                                                    <img class="card-img"
                                                                        src="{{ asset('storage/' . $product->images) }}"
                                                                        alt="">
                                                                    <p><strong>{{ $product->product_name }}</strong>
                                                                    </p>
                                                                    <div class="price">
                                                                        <p>{{ 'Rp.' . number_format($product->price) }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="stok">
                                                                        <p>Stok:
                                                                            {{ $product->stock }}
                                                                        </p>
                                                                        <p>Terjual:
                                                                            {{ $product->sold }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="btn-add-cart">
                                                                        <form action="{{ route('cart_add') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="id"
                                                                                value="{{ $product->id }}">
                                                                            <input type="hidden" name="images"
                                                                                value="{{ $product->images }}">
                                                                            <input type="hidden" name="product_name"
                                                                                value="{{ $product->product_name }}">
                                                                            <input type="hidden" name="price"
                                                                                value="{{ $product->price }}">
                                                                            <button class="btn-add-to-cart"
                                                                                type="submit">Tambah</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <p>Data tidak ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>Data tidak ada</p>
                                    @endif

                                    <div class="pagination">
                                        {{ $all_products->links() }}
                                    </div>


                                </div>
                            </div>

                            {{-- transaction-card --}}
                            <div class="transaction-card">
                                <div class="title-action-close">
                                    <h6><strong>Keranjang Belanja</strong></h6>
                                    <div style="display: flex; gap:30px;" class="btn-action">
                                        <a style="color:black;" id="openDialog" href="#">
                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                        </a>

                                        <a style="color:black;" id="closeBtn" href="#">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>

                                <hr>
                                {{-- opendialogclearcart --}}
                                <div class="open-dialog-clear-cart">
                                    <div style="display:flex; justify-content:space-between;" class="content-action">
                                        <h6><strong>Lainnya</strong></h6>

                                    </div>
                                    <br>
                                    <form action="{{ route('clear_cart') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn-clear-cart">Bersihkan Keranjang</button>
                                    </form>
                                    <div style="display: flex; justify-content:center;" class="close-cart-btn">
                                        <a id="closedDialogBtn" href="#">Tutup</a>
                                    </div>

                                </div>

                                <!-- Daftar barang di keranjang -->
                                <form action="{{ route('transaction.store') }}" method="POST">
                                    @csrf
                                    <div class="cart-items">
                                        @if ($cart_value)
                                            @foreach ($cart_value as $cart)
                                                <div class="cart-item">
                                                    <div class="container-content-product">

                                                        <!-- Product Image -->
                                                        <div class="image-content">
                                                            <img width="50" height="50"
                                                                src="{{ asset('storage/' . $cart['images']) }}"
                                                                alt="Product Image">
                                                        </div>

                                                        <!-- Product Details -->
                                                        <div class="sub-container-product">
                                                            <p class="item-name">{{ $cart['product_name'] }}</p>
                                                            <input name="product_id[]" type="hidden"
                                                                value="{{ $cart['id'] }}">

                                                            <!-- Product Price and Quantity -->
                                                            <div class="flex-content"
                                                                style="display: flex; justify-content: space-between;">
                                                                <p class="item-price">
                                                                    {{ 'Rp.' . number_format($cart['price']) }}</p>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <!-- Quantity and Delete Section -->
                                                    <div class="btn-delete-product">

                                                        <!-- Quantity Control -->
                                                        <div class="quantity-container">
                                                            <button type="button" class="decrease">-</button>
                                                            <input name="quantity_per_product" type="number"
                                                                class="item-quantity">
                                                            <button type="button" class="increase">+</button>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-center-cart">
                                                <h6>Kosong</h6>
                                            </div>

                                        @endif
                                    </div>

                                    <div class="payment-method">
                                        <label for=""><strong>Metode Bayar</strong></label>
                                        <div class="open-pay-method">
                                            <select class="form-control" name="payment_method" id="">
                                                <option value="">=== Pilih Metode Bayar ===</option>
                                                <option value="cash">Tunai</option>
                                                <option value="transfer bank">Transfer Bank</option>
                                                <option value="qris">QRIS</option>
                                                <option value="gopay">Gopay</option>
                                                <option value="dana">Dana</option>
                                            </select>
                                        </div>

                                    </div>

                                    <hr>
                                    <div class="discount">
                                        <label for=""><strong>Diskon</strong></label>
                                        <div class="open-pay-method">
                                            <select class="form-control" name="payment_method" id="">
                                                <option value="">=== Pilih Diskon ===</option>
                                                @foreach ($discount as $disc)
                                                    <option value="{{ $disc->discount_code }}">
                                                        {{ $disc->discount_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <hr>
                                    <div class="promo-code">
                                        <input class="form-control" name="promo_code" type="text"
                                            placeholder="Masukan kode promo">
                                        <button class="btn btn-primary">Pakai</button>
                                    </div>
                                    <hr>
                                    <div class="title-action-close">
                                        <h6><strong>Lainnya</strong></h6>
                                        <a style="color: black;" id="openCustomerSegment" href="#">
                                            <i class="fa fa-chevron-up" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <hr>
                                    <div class="customer-segment">
                                        <div class="customer-input">
                                            <label for=""><strong>Nama Pelanggan (opsional)</strong></label>
                                            <input class="form-control" type="text" name="customer"
                                                id="" autocomplete="off">
                                        </div>
                                        <br>
                                        <div class="customer-input">
                                            <label for=""><strong>Email Pelanggan (opsional)</strong></label>
                                            <input class="form-control" type="email" name="email" id=""
                                                autocomplete="off">
                                        </div>
                                        <hr>
                                    </div>

                                    <div class="payment-amount">
                                        <div style="margin-bottom: 10px;" class="amount">
                                            <label for=""><strong>Bayar</strong></label>
                                            <input name="amount" id="amount" class="form-control" type="text"
                                                autocomplete="off">
                                        </div>

                                        <div class="payment-changes">
                                            <label for=""><strong>Kembalian</strong></label>
                                            <input id="paychange" name="payment_changes" class="form-control"
                                                type="text" readonly>
                                        </div>
                                    </div>

                                    <hr>
                                    <p><strong>Informasi Pembayaran</strong></p>
                                    <hr>
                                    <!-- Subtotal dan Total -->
                                    <div class="totals">
                                        <div class="content-total">
                                            <span class="title-total">Total barang : </span>
                                            <span id="total-quantity">0</span>
                                            <input value="0" type="text" name="quantity"
                                                id="total-quantity-result" hidden>
                                            {{-- <span id="totalItems">{{$qty}}</span>
                            <input id="qtyTotal" type="text" value="{{$qty}}" hidden> --}}
                                        </div>

                                        <div class="content-total">
                                            <span class="title-total">Promo : </span>
                                            <span>-</span>
                                        </div>

                                        <hr>
                                        <div class="content-total">
                                            <span class="title-total">Bayar: </span>
                                            <span id="display-paychange" class="paychange">{{ 'Rp.' }}</span>
                                        </div>
                                        <div class="content-total">
                                            <span class="title-total">Kembalian: </span>
                                            <span id="display-change" class="paychange">{{ 'Rp.' }}</span>
                                        </div>
                                        <hr>
                                        <div class="content-total">
                                            <span class="title-total">Grand Total: </span>
                                            <span class="subtotal" id="grandtotal">
                                            </span>
                                            <input value="0" type="text" name="total" id="total-input"
                                                hidden>
                                        </div>
                                    </div>

                                    <br>

                                    @if ($cart_value)
                                        <button type="submit" class="checkout-button">Checkout</button>
                                    @else
                                        <button style="width: 100%;" type="button"
                                            class="btn btn-secondary">Checkout</button>
                                    @endif
                                </form>
                            </div>

                            {{-- close dialog transaction card --}}
                            <div class="close-dialog">
                                <h6><strong>Keranjang Belanja</strong></h6>
                                <a style="color: black;" id="btnShow" href="#">
                                    <i class="fa fa-chevron-up" aria-hidden="true"></i>
                                </a>
                            </div>


                        </div>
                    @endif
                </div>
            </main>
</body>


@if (Session::has('message_success'))
    <script>
        Swal.fire({
            title: 'Berhasil',
            text: "{{ Session::get('message_success') }}",
            icon: 'success',
            timer: 1000,
            toast: true,
            position: 'bottom-right',
            showConfirmButton: false
        });
    </script>
@endif

@if (Session::has('success_empty_cart'))
    <script>
        Swal.fire({
            title: 'Berhasil',
            text: "{{ Session::get('success_empty_cart') }}",
            icon: 'success',
            timer: 1000,
            toast: true,
            position: 'bottom-right',
            showConfirmButton: false
        });
    </script>
@endif

<script>
    var btnClose = document.getElementById('closeBtn');
    var showClose = document.querySelector('.close-dialog');

    var btnShow = document.getElementById('btnShow');
    var closedTransactionCard = document.querySelector('.transaction-card');


    var openDialogOther = document.getElementById('openDialog');
    var showDialog = document.querySelector('.open-dialog-clear-cart');
    var closedDialog = document.getElementById('closedDialogBtn')

    var btnOpenSegment = document.getElementById('openCustomerSegment');
    var showItemCustomer = document.querySelector('.customer-segment')

    btnClose.addEventListener('click', function() {
        showClose.style.display = 'flex';
        closedTransactionCard.style.display = 'none';
    });

    btnShow.addEventListener('click', function() {
        closedTransactionCard.style.display = 'block';

        showClose.style.display = 'none';
    });

    closedDialog.addEventListener('click', function(event) {
        event.preventDefault();

        showDialog.style.display = 'none';
    })

    btnOpenSegment.addEventListener('click', function(event) {
        event.preventDefault();

        if (showItemCustomer.style.display === 'block') {
            showItemCustomer.style.display = 'none';
        } else {
            showItemCustomer.style.display = 'block';
        }

    });

    openDialogOther.addEventListener('click', function(event) {
        event.preventDefault();
        if (showDialog.style.display === 'block') {
            showDialog.style.display = 'none';
        } else {
            showDialog.style.display = 'block';
        }



    })

    // script for calculation:


    // Fungsi untuk format uang ke format "Rp."
    function formatCurrency(amount) {
        return "Rp. " + amount.toLocaleString('id-ID');
    }

    // Mendapatkan nilai grandTotal dari input total
    const grandTotalInput = parseFloat(document.querySelector('input[name="total"]').value) || 0;
    let grandTotal = grandTotalInput; // Grand total yang dihitung berdasarkan harga dan quantity produk

    // Menghitung kembalian berdasarkan pembayaran
    document.getElementById("amount").addEventListener("input", function() {
        let amountPaid = parseFloat(this.value.replace(/\D/g, '')); // Hapus semua non-digit

        if (isNaN(amountPaid)) {
            amountPaid = 0;
        }

        // Menampilkan jumlah yang dibayar
        document.getElementById("display-paychange").textContent = formatCurrency(amountPaid);

        // Menghitung kembalian
        let change = amountPaid - grandTotal;

        // Menampilkan kembalian
        document.getElementById("display-change").textContent = change >= 0 ? formatCurrency(change) : "Rp. 0";

        // Menampilkan kembalian di input field kembalian
        document.getElementById("paychange").value = change >= 0 ? change : 0;
    });

    // Ambil harga per item untuk setiap produk
    const pricePerItems = []; // Array untuk harga per produk, dapat diisi dengan harga per produk dari server
    document.querySelectorAll('.item-price').forEach((priceElement, index) => {
        pricePerItems[index] = parseFloat(priceElement.textContent.replace(/\D/g, '')) ||
            0; // Ambil harga per produk dari elemen
    });

    // Pilih semua input quantity, tombol increase, decrease, dan elemen subtotal
    const quantityInputs = document.querySelectorAll('.item-quantity');
    const increaseButtons = document.querySelectorAll('.increase');
    const decreaseButtons = document.querySelectorAll('.decrease');
    const subtotalSpans = document.querySelectorAll('.subtotal');
    const grandTotalSpan = document.getElementById('grandtotal');
    const grandTotalSpanNew = document.getElementById('grandtotalnew');
    const totalQuantitySpan = document.getElementById('total-quantity'); // Elemen untuk menampilkan total quantity
    const totalResult = document.getElementById('total-input')
    const qtyResult = document.getElementById('total-quantity-result');
    // Fungsi untuk menghitung jumlah total quantity dari semua produk
    function updateTotalQuantity() {
        let totalQuantity = 0;
        quantityInputs.forEach(input => {
            totalQuantity += parseInt(input.value) || 0; // Tambahkan quantity dari setiap input
        });
        totalQuantitySpan.textContent = totalQuantity;
        qtyResult.value = totalQuantity; // Perbarui tampilan total quantity
    }

    // Event listener untuk tombol increase
    document.querySelectorAll('.increase').forEach((button, index) => {
        button.addEventListener('click', () => {
            const quantityInput = quantityInputs[index];
            quantityInput.value = parseInt(quantityInput.value); // Tambah quantity
            updateTotalQuantity(); // Update total quantity setelah perubahan
        });
    });

    // Event listener untuk tombol decrease
    document.querySelectorAll('.decrease').forEach((button, index) => {
        button.addEventListener('click', () => {
            const quantityInput = quantityInputs[index];
            if (parseInt(quantityInput.value) > 1) { // Pastikan quantity tidak kurang dari 1
                quantityInput.value = parseInt(quantityInput.value) - 1; // Kurangi quantity
                updateTotalQuantity(); // Update total quantity setelah perubahan
            }
        });
    });

    // Event listener untuk input quantity (misalnya saat pengguna mengetik)
    quantityInputs.forEach(input => {
        input.addEventListener('input', () => {
            updateTotalQuantity(); // Update total quantity saat input quantity berubah
        });
    });

    // Inisialisasi total quantity saat halaman dimuat
    updateTotalQuantity();




    // Fungsi untuk menghitung subtotal untuk setiap produk
    function updateTotal(index) {
        if (subtotalSpans[index]) {
            const quantity = parseInt(quantityInputs[index].value) || 0; // Pastikan quantity adalah angka yang valid
            const subtotal = quantity * pricePerItems[index]; // Gunakan harga per produk yang sesuai
            subtotalSpans[index].textContent = "Rp. " + subtotal
                .toLocaleString(); // Perbarui subtotal untuk produk yang sesuai
            updateGrandTotal(); // Update grand total setelah subtotal berubah
        }
    }

    // Fungsi untuk menghitung total keranjang
    function updateGrandTotal() {
        let total = 0;
        quantityInputs.forEach((input, index) => {
            const quantity = parseInt(input.value) || 0; // Pastikan quantity adalah angka yang valid
            total += quantity * pricePerItems[index]; // Tambahkan subtotal produk ke total
        });
        grandTotal = total; // Simpan grand total yang sudah dihitung
        grandTotalSpan.textContent = "Rp. " + total.toLocaleString(); // Perbarui grand total
        // grandTotalSpanNew.textContent = "Rp. " + total.toLocaleString();

        totalResult.value = total; // Perbarui grand total pada elemen baru jika ada
    }

    // Event listener untuk tombol increase
    increaseButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            quantityInputs[index].value = parseInt(quantityInputs[index].value) + 1; // Tambah quantity
            updateTotal(index); // Update subtotal dan grand total
        });
    });

    // Event listener untuk tombol decrease
    decreaseButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            if (parseInt(quantityInputs[index].value) > 1) { // Pastikan quantity tidak kurang dari 1
                quantityInputs[index].value = parseInt(quantityInputs[index].value) -
                    1; // Kurangi quantity
                updateTotal(index); // Update subtotal dan grand total
            }
        });
    });

    // Inisialisasi update untuk setiap produk saat halaman dimuat
    quantityInputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            updateTotal(index); // Update subtotal dan grand total
        });
    });

    // Set initial total untuk setiap produk dan grand total saat halaman pertama dimuat
    quantityInputs.forEach((input, index) => {
        updateTotal(index); // Pastikan subtotal dan grand total sudah sesuai
    });
</script>

</html>
