<x-layout>
    <x-slot:title>Orders</x-slot:title>

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

        .alert .btn-close {
            filter: invert(1);
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

        .card {
            background: #1f2027;
            border: none;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.3);
        }

        .table {
            color: #ffffff;
            background-color: #2b2e38;
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
        }

        .table thead {
            background-color: #343a40;
            color: #ffffff;
        }

        .table thead th {
            padding: 0.75rem;
            text-align: center;
            font-weight: bold;
        }

        .table tbody tr {
            background-color: #2b2e38;
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #738596;
        }

        .table tbody td {
            padding: 0.75rem;
            vertical-align: middle;
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004089;
        }

        .text-light {
            color: #e0e0e0;
        }
    </style>

    <div class="container my-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex mb-4 justify-content-between align-items-center">
            <form class="d-flex align-items-center gap-3" method="get">
                <input type="date" class="form-control w-auto" placeholder="Start Date" name="start_date"
                    value="{{ request()->start_date ?? date('Y-m-01') }}" onchange="this.form.submit()">
                <span class="mx-2 text-light">to</span>
                <input type="date" class="form-control w-auto" placeholder="End Date" name="end_date"
                    value="{{ request()->end_date ?? date('Y-m-d') }}" onchange="this.form.submit()">
                <input type="text" class="form-control w-auto" placeholder="Search Orders" name="search"
                    value="{{ request()->search }}">
                <button type="submit" class="btn btn-dark ms-2">Search</button>
            </form>

            <a href="{{ route('orders.create') }}" class="btn btn-dark">Create New Order</a>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <table class="table table-striped table-dark mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Payment</th>
                            <th>Total</th>
                            <th>User</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>Order #{{ $order->id }}</td>
                                <td>{{ $order->customer }}</td>
                                <td>{{ number_format($order->payment, 0, ',', '.') }}</td>
                                <td>{{ number_format($order->total, 0, ',', '.') }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->formatted_created_date }}</td>
                                <td class="text-end">
                                    <a href="{{ route('orders.show', ['order' => $order->id]) }}"
                                        class="btn btn-sm btn-primary">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-light">No orders available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{ $orders->links() }}
    </div>
</x-layout>
