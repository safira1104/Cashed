<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <style>
        * {
            font-family: 'Baskervville SC', serif;
        }

        body {
            background: #0F2027;
            background: -webkit-linear-gradient(to right, #2C5364, #203A43, #0F2027);
            background: linear-gradient(to right, #2C5364, #203A43, #0F2027);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .card-container {
            perspective: 1000px;
        }

        .card {
            width: 360px;
            height: 400px;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.6s;
            background-color: rgb(238, 238, 238);
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.055);
        }

        .card.flip {
            transform: rotateY(180deg);
        }

        .card-front,
        .card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .card-front {
            z-index: 2;
            transform: rotateY(0deg);
        }

        .card-back {
            transform: rotateY(180deg);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h4.fw-bold {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1.25rem;
            border: 1px solid #ced4da;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #495057;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-dark {
            background-color: #343a40;
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.25rem;
            transition: background-color 0.3s ease;
        }

        .btn-dark:hover {
            background-color: #23272b;
        }

        .invalid-feedback {
            font-size: 0.875rem;
            color: #dc3545;
        }

        .link {
            cursor: pointer;
            color: #007bff;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        .login-card {
            max-width: 360px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.3);
        }

        .card-body {
            padding: 2rem;
        }

        .about-us-content {
            text-align: center;
        }

        .social-media {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 1rem 0;
        }

        .social-media .icon {
            background: #ffffff;
            border-radius: 15px;
            padding: 15px;
            width: 50px;
            height: 50px;
            font-size: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .social-media .facebook:hover {
            background-color: #1877F2;
            color: #ffffff;
        }

        .social-media .tiktok:hover {
            background-color: #000000;
            color: #ffffff;
        }

        .social-media .instagram:hover {
            background-color: #7a21b6;
            color: #ffffff;
        }

        .social-media .youtube:hover {
            background-color: #CD201F;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card-container">
            <div class="card">
                <div class="card-front login-card">
                    <div class="card-body">
                        <h4 class="fw-bold">Cashed</h4>
                        <form action="{{ route('login.process') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="Masukkan email anda" name="email" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="Masukkan password anda" name="password" value="{{ old('password') }}">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark">Masuk</button>
                            </div>
                        </form>
                        <p class="mb-0 mt-4 text-center">
                            <button type="button" class="btn btn-link link" onclick="flipCard()">About Us</button>
                        </p>
                    </div>
                </div>
                <div class="card-back about-us-content">
                    <div class="card-body">
                        <h4 class="fw-bold">About Us</h4>
                        <p>We are a team of dedicated professionals committed to providing exceptional service and support. For any inquiries, please contact us through the following channels:</p>
                        <div class="social-media">
                            <a href="https://youtube.com" target="_blank" class="icon youtube"><i class="fab fa-youtube"></i></a>
                            <a href="https://tiktok.com" target="_blank" class="icon tiktok"><i class="fab fa-tiktok"></i></a>
                            <a href="https://instagram.com" target="_blank" class="icon instagram"><i class="fab fa-instagram"></i></a>
                        </div>
                        <p class="mt-3">Phone: +123-456-7890</p>
                        <p class="mt-3">
                            <button type="button" class="btn btn-link link" onclick="flipCard()">Back to Login</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function flipCard() {
            document.querySelector('.card').classList.toggle('flip');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
