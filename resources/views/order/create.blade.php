<x-layout title="Orders">
    <style>
        body {
            background: linear-gradient(to right, #2C5364, #203A43, #0F2027);
            color: #ffffff;
            font-family: 'Baskervville SC', serif;
        }

        .card {
            background: #1f2027;
            border: none;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-body {
            padding: 1.5rem;
            color: #ffffff; /* Menetapkan warna teks putih untuk seluruh card-body */
        }

        .card.white-bg {
            background: #ffffff;
            color: #000000; /* Teks hitam untuk card dengan latar belakang putih */
        }

        .card.white-bg .card-body {
            color: #000000; /* Teks hitam untuk card dengan latar belakang putih */
        }

        .card.white-bg .text-center {
            color: #000000; /* Teks hitam untuk elemen dengan background putih */
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.3);
        }

        .form-control {
            border-radius: 8px;
            background-color: #2b2e38;
            color: #ffffff;
            border: 1px solid #343a40;
        }

        .form-control::placeholder {
            color: #888;
        }

        .btn-dark {
            background-color: #343a40;
            border-color: #343a40;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-dark:hover {
            background-color: #495057;
            border-color: #495057;
        }

        .btn-light {
            background-color: #ffffff;
            border-color: #ced4da;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            color: #1f2027;
        }

        .btn-light:hover {
            background-color: #e9ecef;
            border-color: #adb5bd;
        }

        .input-group {
            background-color: #1f2027;
            border-radius: 8px;
        }

        .product-card {
            background-color: #1f2027;
            border: none;
            border-radius: 15px;
        }

        .product-card img {
            border-bottom: 2px solid #343a40;
        }

        .product-card .card-body {
            color: #ffffff;
        }

        .alert {
            border-radius: 10px;
            background-color: #1f2027;
            color: #ffeba7;
        }

        .alert .btn-close {
            filter: invert(1);
        }

        .vstack {
            gap: 1rem;
        }

        .d-grid {
            gap: 1rem;
        }

        .summary-card .card-body {
            color: #ffffff; /* Pastikan teks di dalam card summary berwarna putih */
        }
         .card.white-bg .text-center {
        color: #000000 !important; /* Menggunakan !important untuk memastikan gaya diterapkan */
    }

    .text-center {
        color: #000000; /* Setel default warna teks */
    }

    /* Jika masih tidak berfungsi, gunakan gaya lebih spesifik */
    .col.text-center {
        color: #000000; /* Setel warna khusus untuk elemen ini */
    }
    </style>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="d-grid gap-4">
                    <form class="hstack gap-2" method="get">
                        <select name="category_id" id="category_id" class="form-control w-auto"
                            onchange="this.form.submit()">
                            <option value="">Semua kategori</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request()->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <div class="input-group">
                            <input type="text" placeholder="Cari product" class="form-control" name="search"
                                value="{{ request()->search }}" autofocus>
                        </div>

                        <button type="submit" class="btn btn-dark">Cari</button>
                    </form>

                    <div class="row g-4">
                        @forelse ($products as $product)
                            <div class="col-3">
                                <a href="{{ route('orders.create.detail', ['product' => $product->id]) }}"
                                    class="text-decoration-none">
                                    <div class="card product-card">
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                            class="card-img-top">
                                        <div class="card-body">
                                            <div class="fw-bold">{{ $product->name }}</div>
                                            <div class="hstack">
                                                <small>{{ $product->category->name }}</small>
                                                <small class="ms-auto">
                                                    Rp{{ number_format($product->price) }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col text-center">Belum ada products</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <form class="card summary-card" method="post" action="{{ route('orders.checkout') }}">
                    @csrf

                    <div class="card-body border-bottom fw-bold">Summary</div>

                    <div class="card-body border-bottom">
                        <x-text-input name="customer" label="Customer"
                            value="{{ session('order')->customer }}"></x-text-input>
                    </div>

                    <div class="card-body bg-body-tertiary border-bottom">
                        <div class="vstack gap-2">
                            @php
                                $total = 0;
                            @endphp

                            @forelse (session('order')->details as $detail)
                                @php
                                    $total += $detail->qty * $detail->price;
                                @endphp

                                <a href="{{ route('orders.create.detail', ['product' => $detail->product_id]) }}"
                                    class="text-decoration-none">
                                    <div class="card product-card white-bg">
                                        <div class="card-body">
                                            <div>{{ $detail->product->name }}</div>
                                            <div class="d-flex justify-content-between">
                                                <div class="form-text">{{ $detail->qty }} x
                                                    {{ number_format($detail->price) }}</div>
                                                <div class="ms-auto form-text">
                                                    Rp{{ number_format($detail->qty * $detail->price) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center">Belum ada product</div>
                            @endforelse
                        </div>
                    </div>

                    <div class="card-body border-bottom d-grid gap-2">
                        <div class="d-flex justify-content-between">
                            <div>Total</div>
                            <h4 class="ms-auto mb-0 fw-bold">Rp{{ number_format($total) }}</h4>
                        </div>
                        <div>
                            <x-text-input name="payment" label="Payment" type="number"></x-text-input>
                        </div>
                    </div>

                    <div class="card-body d-flex flex-row-reverse justify-content-between">
                        <button class="ms-auto btn btn-dark">Checkout</button>
                        <button name="cancel" class="btn btn-light">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
