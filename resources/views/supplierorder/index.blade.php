<x-layout>
    <x-slot:title>Supplier Orders</x-slot:title>

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

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
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

        .container {
            margin-top: 20px;
        }

        .alert-success {
            background-color: #28a745;
            color: #ffffff;
            border: 1px solid #28a745;
            border-radius: 8px;
            padding: 10px;
        }

        .table thead th {
            background-color: #343a40;
            color: #ffffff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #2b2e38;
        }

        .table tbody tr:hover {
            background-color: #1f2027;
        }

        .table .text-end {
            text-align: end;
        }
    </style>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex mb-2 justify-content-between">
            <form class="d-flex gap-2" method="get">
                <input type="text" class="form-control" name="search" placeholder="Cari supplier order"
                       value="{{ request()->search }}">
                <button type="submit" class="btn btn-dark">Cari</button>
            </form>

            <a href="{{ route('supplier_orders.create') }}" class="btn btn-dark">Tambah</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kode Transaksi</th>
                            <th>Nama</th>
                            <th>Tanggal Masuk</th>
                            <th>Stok</th>
                            <th>Supplier</th>
                            <th class="text-end"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($supplierOrders as $order)
                            <tr>
                                <td>{{ $order->transaction_code }}</td>
                                <td>{{ $order->product_name }}</td>
                                <td>{{ $order->entry_date->format('d-m-Y') }}</td>
                                <td>{{ $order->stock_in }}</td>
                                <td>{{ $order->supplier->name }}</td>
                                <td class="text-end">
                                    <a href="{{ route('supplier_orders.edit', $order->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('supplier_orders.destroy', $order->id) }}" method="post" style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Supplier order belum ditambahkan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
