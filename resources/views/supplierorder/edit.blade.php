<x-layout>
    <x-slot:title>Edit Supplier Order</x-slot:title>

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

        .form-check-input {
            background-color: #2b2e38;
            border: 1px solid #343a40;
        }

        .form-check-label {
            color: #ffffff;
        }

        .img-thumbnail {
            border: 1px solid #343a40;
            border-radius: 8px;
        }

        .form-text {
            color: #888;
        }

        .container {
            margin-top: 20px;
            padding-left: 15px; /* Atur padding kiri jika diperlukan */
        }

        .form-container {
            max-width: 500px; /* Mengurangi lebar form */
            margin-left: 0; /* Memindahkan form ke kiri */
            padding: 20px;
        }

        .row {
            display: flex;
            justify-content: flex-start; /* Memindahkan form ke kiri */
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card form-container">
                    <div class="card-body">
                        <form action="{{ route('supplier_orders.update', $supplierOrder->id) }}" method="post">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="transaction_code" class="form-label">Kode Transaksi</label>
                                <input type="text" class="form-control" id="transaction_code" name="transaction_code"
                                       placeholder="Masukkan kode transaksi" value="{{ old('transaction_code', $supplierOrder->transaction_code) }}">
                            </div>

                            <div class="mb-3">
                                <label for="product_name" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                       placeholder="Masukkan nama produk" value="{{ old('product_name', $supplierOrder->product_name) }}">
                            </div>

                            <div class="mb-3">
                                <label for="entry_date" class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="entry_date" name="entry_date"
                                       value="{{ old('entry_date', $supplierOrder->entry_date->format('Y-m-d')) }}">
                            </div>

                            <div class="mb-3">
                                <label for="stock_in" class="form-label">Stok Masuk</label>
                                <input type="number" class="form-control" id="stock_in" name="stock_in"
                                       placeholder="Masukkan jumlah stok" value="{{ old('stock_in', $supplierOrder->stock_in) }}">
                            </div>

                            <div class="mb-3">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="form-control">
                                    @forelse ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" @if ($supplier->id == $supplierOrder->supplier_id) selected @endif>
                                            {{ $supplier->name }}
                                        </option>
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
