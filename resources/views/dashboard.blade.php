<x-layout>
    <x-slot:title>Dashboard</x-slot:title>

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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-body {
            padding: 2rem;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.3);
        }

        .card .card-body div {
            font-size: 1.25rem;
            font-weight: 500;
            color: #ffeba7;
            margin-bottom: 0.5rem;
        }

        .card .card-body h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #ffeba7;
        }

        .card .separator {
            border-bottom: 2px solid #ffeba7;
            margin: 1rem 0;
        }

        .table-recent {
            color: #ffffff;
            background-color: #2b2e38;
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
        }

        .table-recent thead {
            background-color: #343a40;
            color: #ffffff;
        }

        .table-recent thead th {
            padding: 0.75rem;
            text-align: center;
            font-weight: bold;
        }

        .table-recent tbody tr {
            background-color: #2b2e38;
            transition: background-color 0.3s ease;
        }

        .table-recent tbody tr:nth-child(even) {
            background-color: #2b2e38;
        }

        .table-recent tbody tr:nth-child(odd) {
            background-color: #3c4a57;
        }

        .table-recent tbody tr:hover {
            background-color: #4a5a67;
        }

        .table-recent tbody td {
            padding: 0.75rem;
            vertical-align: middle;
            text-align: center;
            color: #ffffff;
        }

        .dashboard-container {
            display: flex;
            justify-content: space-between;
            height: 500px; /* Set height for the container */
        }

        .chart-container {
            width: 50%;
            background: #1f2027;
            border-radius: 15px;
            padding: 1rem;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            height: 100%; /* Ensure it fills the container height */
            margin-left: 1rem; /* Add left margin to create space */
        }

        .recent-orders-container {
            width: 50%;
            height: 100%; /* Adjust height to match the chart container */
            padding-right: 1rem; /* Add right padding to create space */
        }

        .recent-orders-container .card {
            height: 100%;
        }

        .chart-container canvas {
            width: 100% !important; /* Ensure canvas fills the width */
            height: 100% !important; /* Ensure canvas fills the height */
        }
        .dashboard-container {
            display: flex;
            justify-content: space-between;
            height: calc(100vh - 6rem); /* Set height for the container */
            overflow: auto; /* Add scrolling if content overflows */
        }

        .chart-container {
            width: 50%;
            background: #1f2027;
            border-radius: 15px;
            padding: 1rem;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            height: 100%;
            margin-left: 1rem;
        }

        .recent-orders-container {
            width: 50%;
            height: 100%;
            padding-right: 1rem;
            overflow: auto; /* Add scrolling if content overflows */
        }

        .table-recent {
            color: #ffffff;
            background-color: #2b2e38;
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
            height: 100%;
        }

        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card-body {
            flex: 1; /* Allow card-body to grow and fill available space */
            overflow: auto; /* Add scrolling if content overflows */
        }

    </style>

    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div>Product Terjual</div>
                        <div class="separator"></div>
                        <h1 class="fw-bold">{{ number_format($productsSold) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div>Pendapatan</div>
                        <div class="separator"></div>
                        <h1 class="fw-bold">{{ number_format($revenue) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div>Order</div>
                        <div class="separator"></div>
                        <h1 class="fw-bold">{{ number_format($ordersCount) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div>Products</div>
                        <div class="separator"></div>
                        <h1 class="fw-bold">{{ number_format($productsCount) }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-container">
            <div class="recent-orders-container">
                <h6>{{ count($recentOrders) }} Order Terkini</h6>
                <div class="card mb-2 overflow-hidden">
                    <table class="table-recent m-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentOrders as $order)
                                <tr>
                                    <td>Order #{{ $order->id }}</td>
                                    <td>{{ $order->customer }}</td>
                                    <td>{{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td>{{ $order->formatted_created_date }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('orders.show', ['order' => $order->id]) }}" class="btn btn-sm btn-primary">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada order</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($months), // Array of month names or labels
                datasets: [{
                    label: 'Pendapatan',
                    data: @json($revenueData), // Array of revenue values
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Background color below the line
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#ffffff' // Set legend text color
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1f2027', // Tooltip background color
                        titleColor: '#ffffff', // Tooltip title text color
                        bodyColor: '#ffffff', // Tooltip body text color
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            color: '#ffffff' // X-axis labels color
                        },
                        grid: {
                            color: '#343a40' // X-axis grid lines color
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#ffffff' // Y-axis labels color
                        },
                        grid: {
                            color: '#343a40' // Y-axis grid lines color
                        }
                    }
                }
            }
        });
    </script>
</x-layout>
