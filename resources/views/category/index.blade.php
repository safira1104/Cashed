<x-layout>
    <x-slot:title>Category</x-slot:title>

    <style>
        body {
            background: linear-gradient(to right, #2C5364, #203A43, #0F2027);
            color: #ffffff;
            font-family: 'Baskervville SC', serif;
        }

        .alert {
            border-radius: 10px;
            background-color: #1f2027;
            color: #ffeba7;
        }

        .alert-success {
            background-color: #343a40;
            color: #d4edda;
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

        .card {
            background: #1f2027;
            border: none;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }

        .card-body {
            padding: 1.5rem;
            color: #ffffff;
        }

        .table thead th {
            background-color: #343a40;
            color: #ffffff;
            border-bottom: 1px solid #495057;
        }

        .table tbody tr:nth-child(even) {
            background-color: #2b2e38;
        }

        .table tbody tr:hover {
            background-color: #343a40;
        }

        .badge {
            font-size: 0.875rem;
            border-radius: 0.375rem;
        }

        .badge.text-bg-primary {
            background-color: #007bff;
            color: #ffffff;
        }

        .badge.text-bg-danger {
            background-color: #dc3545;
            color: #ffffff;
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
                <input type="text" class="form-control w-auto" name="search" id="search" placeholder="Cari category"
                    value="{{ request()->search }}">
                <button type="submit" class="btn btn-dark">Cari</button>
            </form>

            <a href="{{ route('categories.create') }}" class="btn btn-dark">Tambah</a>
        </div>

        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Aktif</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if ($category->active)
                                        <span class="badge text-bg-primary">Aktif</span>
                                    @else
                                        <span class="badge text-bg-danger">Tidak aktif</span>
                                    @endif
                                </td>
                                <td class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Belum terdapat category</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
