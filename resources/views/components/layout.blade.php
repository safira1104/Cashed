<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cashed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css, resources/js/app.js'])
    <style>
        * {
            font-family: 'inter';
        }
        .w-thumbnail {
            width: 100px;
            height: 100px;
        }

        .product-card:hover {
            outline: #000000 solid 2px;
        }

        .navbar-nav .nav-item .dropdown-menu {
            background-color: #1f2027; /* Set background color */
        }

        .navbar-nav .nav-item .dropdown-menu .dropdown-item {
            color: #ffffff; /* Set text color for dropdown items */
        }

        .navbar-nav .nav-item .dropdown-menu .dropdown-item:hover {
            background-color: #343a40; /* Set hover color */
        }

        .navbar-nav .nav-item .nav-link.dropdown-toggle {
            color: #ffffff; /* Set color for dropdown toggle */
        }

        .navbar-nav .nav-item .nav-link.dropdown-toggle.active {
            color: #ffffff; /* Ensure active state is also white */
        }

        /* Styles to align user name and logout button to the right */
        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }



        .user-info .btn {
            margin-left: 0.5rem;
        }
        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Align user name and logout button to the right */
        .user-info {
            display: flex;
            align-items: center;
            margin-left: auto; /* This will push it to the right */
        }

        .user-info .btn {
            margin-left: 0.5rem;
        }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg bg-black navbar-dark">
        <div class="container">
          <a class="navbar-brand fw-bold" href="#">Cashed</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

            <div class="navbar-nav">
              <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" aria-current="page" href="{{route('dashboard')}}">Dashboard</a>

              <!-- Dropdown for Orders -->
              <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->routeIs('orders.index') || request()->routeIs('supplier.orders.index') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Orders
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item {{ request()->routeIs('orders.index') ? 'active' : '' }}" href="{{ route('orders.index') }}">Customer Orders</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('supplier_orders.index') ? 'active' : '' }}" href="{{ route('supplier_orders.index') }}">Supplier Orders</a></li>
                  </ul>
              </div>

              <!-- Dropdown for Categories -->
              <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->routeIs('categories.index') || request()->routeIs('products.index') ? 'active' : '' }}" href="#" id="navbarCategories" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarCategories">
                  <li><a class="dropdown-item {{ request()->routeIs('categories.index') ? 'active' : '' }}" href="{{route('categories.index')}}">Categories</a></li>
                  <li><a class="dropdown-item {{ request()->routeIs('products.index') ? 'active' : '' }}" href="{{route('products.index')}}">Products</a></li>
                  <li><a class="dropdown-item {{ request()->routeIs('suppliers.index') ? 'active' : '' }}" href="{{route('suppliers.index')}}">Suppliers</a></li>
                </ul>
              </div>

              <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{route('users.index')}}">Users</a>
            </div>

            <div class="user-info">
              <div class="text-white me-4">{{ auth()->user()->name }}</div>
              <form action="{{route('logout')}}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
              </form>
            </div>

          </div>
        </div>
      </nav>

      @isset($title)
      <div class="border-bottom mb-3">
        <h4 class="container p-4 fw-bold ">{{$title}}</h4>
      </div>
      @endisset

      {{ $slot }}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
