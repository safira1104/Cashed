<x-layout>

    <x-slot:title>Edit Users</x-slot:title>

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
            <div class="col-md-4"> <!-- Atur lebar sesuai kebutuhan -->
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="post">
                            @csrf
                            @method('put')

                            <x-text-input label="Nama" name="name" placeholder="Masukkan nama user"
                                value="{{ old('name', $user->name) }}"></x-text-input>

                            <x-text-input label="Email" name="email" placeholder="Masukkan email anda" type="email"
                                value="{{ old('email', $user->email) }}"></x-text-input>

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Password Lama</label>
                                <input class="form-control" type="password" id="current_password" name="current_password" required>
                                @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input class="form-control" type="password" id="password" name="password">
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" role="switch" name="active"
                                 id="active" @checked((!old() && $user->active == 1 )|| old('active') == 'on')>
                                <label class="form-check-label" for="active">Aktif</label>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('users.index') }}" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-dark">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

</x-layout>
