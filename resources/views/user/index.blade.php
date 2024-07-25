<x-layout>
    <x-slot:title>User</x-slot:title>

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

        .table thead th {
            background-color: #343a40;
            color: #ffffff;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #1f2027;
        }

        .table tbody tr:nth-child(even) {
            background-color: #2b2e38;
        }

        .table tbody td {
            color: #000000; /* Menjadikan teks di dalam tabel hitam */
        }

        .badge {
            font-size: 0.875rem;
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
                <input type="text" class="form-control w-auto" name="search" id="search" placeholder="Cari user"
                       value="{{ request()->search }}">
                <button type="submit" class="btn btn-dark">Cari</button>
            </form>

            <a href="{{ route('users.create') }}" class="btn btn-dark">Tambah</a>
        </div>

        <div class="card overflow-hidden">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Aktif</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->password }}</td>
                            <td>
                                @if ($user->active)
                                    <span class="badge rounded-pill text-bg-primary">Aktif</span>
                                @else
                                    <span class="badge rounded-pill text-bg-danger">Tidak aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
