<x-layout>
    <x-slot:title>Tambah Supplier Order</x-slot:title>

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
        }

        .card-body {
            padding: 1.5rem;
            color: #ffffff;
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

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
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

        .form-label {
            color: #ffffff;
        }

        .form-container {
            max-width: 500px; /* Atur lebar maksimal form */
            margin-left: 20px; /* Pindahkan form ke kiri */
            padding: 20px; /* Tambahkan padding jika diperlukan */
        }

        .form-control {
            margin-bottom: 15px; /* Tambahkan jarak antara elemen form */
        }

        .container {
            margin-top: 20px; /* Jarak atas untuk container */
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card form-container">
                    <div class="card-body">
                        <form action="{{ route('supplier_orders.store') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="transaction_code" class="form-label">Kode Transaksi</label>
                                <input type="text" class="form-control" id="transaction_code" name="transaction_code"
                                       value="{{ old('transaction_code') }}" placeholder="Masukkan kode transaksi">
                            </div>

                            <div class="mb-3">
                                <label for="product_name" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                       value="{{ old('product_name') }}" placeholder="Masukkan nama produk">
                            </div>

                            <div class="mb-3">
                                <label for="entry_date" class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="entry_date" name="entry_date"
                                       value="{{ old('entry_date') }}">
                            </div>

                            <div class="mb-3">
                                <label for="stock_in" class="form-label">Stok Masuk</label>
                                <input type="number" class="form-control" id="stock_in" name="stock_in"
                                       value="{{ old('stock_in') }}" placeholder="Masukkan jumlah stok">
                            </div>

                            <div class="mb-3">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="form-control">
                                    @forelse ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @empty
                                        <option>Belum ada supplier</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('supplier_orders.index') }}" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-dark">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
