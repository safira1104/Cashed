<x-layout>

    <x-slot:title>Tambah User</x-slot:title>

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

        .form-check-input {
            border-color: #343a40;
        }

        .form-check-label {
            color: #ffffff;
        }

        .alert {
            border-radius: 8px;
            background-color: #dc3545;
            color: #ffffff;
            border: 1px solid #bd2130;
        }

        .alert ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .alert li {
            padding: 0.5rem 1rem;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- Display Validation Errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <x-text-input label="Nama" name="name" placeholder="Masukkan nama user"
                            value="{{ old('name') }}"></x-text-input>

                            <x-text-input label="Email" name="email" placeholder="Masukkan email anda" type="email"
                                value="{{ old('email') }}"></x-text-input>

                            <x-text-input label="Password" name="password" placeholder="Masukkan password anda" type="password"
                                value="{{ old('password') }}"></x-text-input>

                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" role="switch" name="active"
                                id="active" @checked(!old() || old('active') == 'on')>
                                <label class="form-check-label" for="active">Aktif</label>
                            </div>

                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('users.index') }}" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-dark">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
